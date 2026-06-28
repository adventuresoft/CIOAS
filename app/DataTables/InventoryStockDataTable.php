<?php

namespace App\DataTables;

use App\Models\Inventory\InventoryWorkOrderItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class InventoryStockDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('stock_status', function ($row) {
                return '<span class="badge bg-success text-white px-2 py-1"><i class="fas fa-check-circle mr-1"></i> In Stock</span>';
            })
            ->addColumn('quantity_badge', function ($row) {
                return '<span class="badge bg-secondary text-dark px-2 py-1">' . $row->quantity . '</span>';
            })
            ->addIndexColumn()
            ->rawColumns(['stock_status', 'quantity_badge'])
            ->setRowId('item_name');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(InventoryWorkOrderItem $model): QueryBuilder
    {
        return $model->newQuery()
            ->select([
                'inventory_work_order_items.category',
                'inventory_work_order_items.item_name',
                'inventory_work_order_items.unit',
                DB::raw("GROUP_CONCAT(DISTINCT inventory_work_orders.work_order_no SEPARATOR ', ') AS work_order_nos"),
                DB::raw("SUM(inventory_work_order_items.receive_quantity) AS quantity"),
            ])
            ->join('inventory_work_orders', 'inventory_work_order_items.inventory_work_order_id', '=', 'inventory_work_orders.id')
            ->where('inventory_work_orders.workflow_status', 'received')
            ->where('inventory_work_order_items.receive_quantity', '>', 0)
            ->groupBy('inventory_work_order_items.category', 'inventory_work_order_items.item_name', 'inventory_work_order_items.unit');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('inventorystock-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->addTableClass('table table-custom table-hover w-100')
            ->parameters([
                'initComplete' => "function() {
                    $('.dataTables_filter input').attr('placeholder', 'অনুসন্ধান করুন...');
                }",
                'language' => [
                    'search' => '',
                    'searchPlaceholder' => 'অনুসন্ধান করুন...',
                    'lengthMenu' => '_MENU_ রেকর্ড প্রতি পৃষ্ঠায়',
                    'zeroRecords' => 'কোনো রেকর্ড পাওয়া যায়নি',
                    'info' => '_TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ পর্যন্ত দেখানো হচ্ছে',
                    'infoEmpty' => 'কোনো রেকর্ড উপলব্ধ নেই',
                    'infoFiltered' => '(মোট _MAX_ রেকর্ড থেকে ফিল্টার করা হয়েছে)',
                    'paginate' => [
                        'first' => 'প্রথম',
                        'last' => 'শেষ',
                        'next' => 'পরবর্তী',
                        'previous' => 'পূর্ববর্তী'
                    ]
                ]
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL')->searchable(false)->orderable(false)->width(50)->addClass('text-center'),
            Column::make('work_order_nos')->title('Work Order No'),
            Column::make('category')->title('Category'),
            Column::make('item_name')->title('Item Name'),
            Column::make('unit')->title('Unit'),
            Column::make('quantity_badge')->title('Quantity')->name('quantity')->addClass('text-center'),
            Column::make('stock_status')->title('Stock Status')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InventoryStock_' . date('YmdHis');
    }
}

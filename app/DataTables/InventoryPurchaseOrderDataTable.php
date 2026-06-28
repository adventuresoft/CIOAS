<?php

namespace App\DataTables;

use App\Models\Inventory\InventoryWorkOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class InventoryPurchaseOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.inventory.purchase_order.action')
            ->addColumn('work_order_info', function ($row) {
                $dateStr = $row->application_date ? Carbon::parse($row->application_date)->format('d-m-Y') : '';
                return $row->work_order_no . ($dateStr ? '<br><small class="text-muted"><i class="far fa-calendar-alt"></i> ' . $dateStr . '</small>' : '');
            })
            ->addColumn('vendor_name', function ($row) {
                return $row->vendor->name ?? 'N/A';
            })
            ->addColumn('vendor_contact', function ($row) {
                return $row->vendor->contact_number ?? 'N/A';
            })
            ->addColumn('status', function ($row) {
                if ($row->purchaseOrder) {
                    return '<span class="badge badge-success">Received</span>';
                } else {
                    return '<span class="badge badge-warning">Pending Receive</span>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['work_order_info', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(InventoryWorkOrder $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['vendor', 'purchaseOrder'])
            ->whereNotNull('inventory_vendor_id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('inventorypurchaseorder-table')
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
            Column::make('work_order_info')->title('Work Order Info'),
            Column::make('vendor_name')->title('Assigned Vendor'),
            Column::make('vendor_contact')->title('Vendor Contact'),
            Column::make('chalan_no')->title('Chalan Number'),
            Column::make('invoice_no')->title('Invoice Number'),
            Column::make('status')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InventoryPurchaseOrder_' . date('YmdHis');
    }
}

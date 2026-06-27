<?php

namespace App\DataTables;

use App\Models\Inventory\InventoryWorkOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InventoryWorkOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('workflow_status', function ($row) {
                $badge = $row->workflow_status === 'approved' ? 'success' : ($row->workflow_status === 'draft' ? 'secondary' : 'warning');
                $label = ucfirst(str_replace('_', ' ', $row->workflow_status));
                return '<span class="badge badge-' . $badge . '">' . e($label) . '</span>';
            })
            ->addColumn('included_requisitions', function ($row) {
                return $row->requisitions_count;
            })
            ->editColumn('application_date', function ($row) {
                return $row->application_date ? $row->application_date->format('d M Y') : '—';
            })
            ->editColumn('validity_date', function ($row) {
                return $row->validity_date ? $row->validity_date->format('d M Y') : '—';
            })
            ->editColumn('delivery_date', function ($row) {
                return $row->delivery_date ? $row->delivery_date->format('d M Y') : '—';
            })
            ->addColumn('action', function ($row) {
                $showButton = '<a href="' . route('inventory.work-order.show', $row->id) . '" class="btn btn-info btn-sm workOrder-action-btn" title="Show" data-toggle="tooltip"><i class="fas fa-eye"></i></a>';
                return '<div class="workOrder-action-group d-flex align-items-center justify-content-center">' . $showButton . '</div>';
            })
            ->rawColumns(['workflow_status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(InventoryWorkOrder $model): QueryBuilder
    {
        return $model->newQuery()
            ->withCount(['items', 'requisitions'])
            ->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('inventory-work-order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->addTableClass('table table-bordered table-striped')
            ->parameters([
                'language' => [
                    'search' => 'খুঁজুন:',
                    'lengthMenu' => 'প্রদর্শন করুন _MENU_ টি রেকর্ড',
                    'info' => 'মোট _TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে',
                    'infoEmpty' => 'কোনো রেকর্ড নেই',
                    'infoFiltered' => '(মোট _MAX_ টি রেকর্ড থেকে ফিল্টার করা হয়েছে)',
                    'zeroRecords' => 'কোনো মেলানো রেকর্ড পাওয়া যায়নি',
                    'paginate' => [
                        'first' => 'প্রথম',
                        'previous' => 'পূর্ববর্তী',
                        'next' => 'পরবর্তী',
                        'last' => 'শেষ'
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
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(30)->addClass('text-center'),
            Column::make('work_order_no')->title('Work Order No'),
            Column::make('workflow_status')->title('Workflow Status'),
            Column::make('included_requisitions')->title('Included Requisitions')->searchable(false)->orderable(false),
            Column::make('items_count')->title('Items Count')->searchable(false)->orderable(false),
            Column::make('application_date')->title('Applied Date'),
            Column::make('validity_date')->title('Validity Date'),
            Column::make('delivery_date')->title('Delivery Date'),
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InventoryWorkOrder_' . date('YmdHis');
    }
}

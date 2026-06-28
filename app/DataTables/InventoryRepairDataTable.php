<?php

namespace App\DataTables;

use App\Models\Inventory\InventoryRepairApplication;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class InventoryRepairDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.inventory.repair.action')
            ->addColumn('application_date', function ($row) {
                return $row->application_date ? $row->application_date->format('d M, Y') : '—';
            })
            ->addColumn('applicant', function ($row) {
                return $row->applicant_name . '<br><small class="text-muted">' . $row->department_name . '</small>';
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'pending') {
                    return '<span class="badge badge-warning">Pending</span>';
                } elseif ($row->status == 'approved') {
                    return '<span class="badge badge-success">Approved</span>';
                } elseif ($row->status == 'rejected') {
                    return '<span class="badge badge-danger">Rejected</span>';
                } elseif ($row->status == 'repaired') {
                    return '<span class="badge badge-info">Repaired</span>';
                }
                return ucfirst($row->status ?? '');
            })
            ->addIndexColumn()
            ->rawColumns(['applicant', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(InventoryRepairApplication $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('inventoryrepair-table')
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
            Column::make('repair_no')->title('Repair No'),
            Column::make('application_date')->title('Date'),
            Column::make('applicant')->title('Applicant'),
            Column::make('item_name')->title('Item'),
            Column::make('quantity')->title('Qty')->addClass('text-center'),
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
        return 'InventoryRepair_' . date('YmdHis');
    }
}

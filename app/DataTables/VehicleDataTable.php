<?php

namespace App\DataTables;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VehicleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.vehicle.action')
            ->addColumn('model', function ($row) {
                return ($row->make_company ?? '') . ($row->make_year ? ' (' . $row->make_year . ')' : '');
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vehicle $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vehicle-table')
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
            Column::make('registration_no')->title('Registration No'),
            Column::make('vehicle_model')->title('Vehicle Name'),
            Column::make('vehicle_type')->title('Type'),
            Column::make('vehicle_category')->title('Category'),
            Column::make('model')->title('Model')->orderable(false)->searchable(false),
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
        return 'Vehicle_' . date('YmdHis');
    }
}

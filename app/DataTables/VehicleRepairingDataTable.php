<?php

namespace App\DataTables;

use App\Models\VehicleRepairing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class VehicleRepairingDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.vehicle_repairing.action')
            ->addColumn('registration_no', function ($row) {
                return $row->vehicle->registration_no ?? 'N/A';
            })
            ->addColumn('repair_date', function ($row) {
                return $row->repair_date ? Carbon::parse($row->repair_date)->format('d M, Y') : 'N/A';
            })
            ->addColumn('cost', function ($row) {
                return number_format($row->cost, 2);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VehicleRepairing $model): QueryBuilder
    {
        return $model->newQuery()->with('vehicle');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vehiclerepairing-table')
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
            Column::make('registration_no')->title('Registration No.'),
            Column::make('repair_date')->title('Repair Date'),
            Column::make('workshop_name')->title('Workshop Name'),
            Column::make('cost')->title('Cost'),
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
        return 'VehicleRepairing_' . date('YmdHis');
    }
}

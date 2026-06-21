<?php

namespace App\DataTables;

use App\Models\Land;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LandDataTable extends DataTable
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
            ->addColumn('district_name', function ($row) {
                return $row->district->name ?? '—';
            })
            ->addColumn('upazila_name', function ($row) {
                return $row->upazila->name ?? '—';
            })
            ->addColumn('mouza_name', function ($row) {
                return $row->mouza->name ?? '—';
            })
            ->addColumn('total_land_amount', function ($row) {
                $total = $row->details->sum('land_amount');
                return number_format($total, 4) . ' একর';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">অনুমোদিত</span>';
                } else {
                    return '<span class="badge badge-warning">অপেক্ষমান</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $showButton = '<a href="' . route('land.show', $row->id) . '" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
                    <i class="fa fa-eye"></i>
                </a>';

                $editButton = '';
                if ($row->status == 0) {
                    $editButton = '<a href="' . route('land.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-edit"></i>
                    </a>';
                }

                $approveButton = '';
                if ($row->status == 0) {
                    $approveButton = '<button type="button" class="btn btn-sm btn-success approve-btn mr-1" data-id="' . $row->id . '" title="Approve" data-toggle="tooltip">
                        <i class="fa fa-check"></i>
                    </button>';
                }

                $deleteForm = '<form class="deleteData" method="post" style="display:inline-block; margin:0;">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="id" name="id" value="' . $row->id . '">
                                    <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('land.destroy', $row->id) . '">
                                    <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('land.index') . '">
                                    <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                               </form>';

                return '<div class="table-action" style="display:flex; align-items:center;">' . $showButton . $editButton . $approveButton . $deleteForm . '</div>';
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Land $model): QueryBuilder
    {
        return $model->with(['district', 'upazila', 'mouza', 'details'])->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('land-table')
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
            Column::make('land_type')->title('জমির ধরণ'),
            Column::make('record_type')->title('রেকর্ড'),
            Column::make('district_name')->title('জেলা')->name('district.name'),
            Column::make('upazila_name')->title('উপজেলা')->name('upazila.name'),
            Column::make('mouza_name')->title('মৌজা')->name('mouza.name'),
            Column::make('total_land_amount')->title('মোট জমির পরিমাণ')->searchable(false)->orderable(false),
            Column::make('status')->title('স্ট্যাটাস')->addClass('text-center'),
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
        return 'Land_' . date('YmdHis');
    }
}

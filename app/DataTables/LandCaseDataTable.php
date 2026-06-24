<?php

namespace App\DataTables;

use App\Models\LandCase;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LandCaseDataTable extends DataTable
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
            ->editColumn('has_case', function ($row) {
                return $row->has_case == 1 
                    ? '<span class="badge badge-danger">হ্যাঁ</span>' 
                    : '<span class="badge badge-success">না</span>';
            })
            ->addColumn('action', function ($row) {
                $showButton = '<a href="' . route('land-cases.show', $row->id) . '" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
                    <i class="fa fa-eye"></i>
                </a>';

                $editButton = '<a href="' . route('land-cases.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
                    <i class="fa fa-edit"></i>
                </a>';

                $deleteForm = '<form class="deleteData" method="post" style="display:inline-block; margin:0;">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="id" name="id" value="' . $row->id . '">
                                    <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('land-cases.destroy', $row->id) . '">
                                    <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('land-cases.index') . '">
                                    <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>';

                return '<div class="table-action" style="display:flex; align-items:center; justify-content:center;">' . $showButton . $editButton . $deleteForm . '</div>';
            })
            ->rawColumns(['has_case', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(LandCase $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('land-cases-table')
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
            Column::make('land_no')->title('জমির নাম্বার'),
            Column::make('has_case')->title('মামলা আছে কিনা')->addClass('text-center'),
            Column::make('case_no')->title('মামলা নম্বর'),
            Column::make('court_name')->title('আদালতের নাম'),
            Column::make('case_status')->title('মামলার সর্বশেষ অবস্থা'),
            Column::computed('action')->title('অ্যাকশন')
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
        return 'LandCases_' . date('YmdHis');
    }
}

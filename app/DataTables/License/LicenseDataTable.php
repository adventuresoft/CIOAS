<?php

namespace App\DataTables\License;

use App\Models\License\License;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LicenseDataTable extends DataTable
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
            ->editColumn('license_category_id', function ($row) {
                return $row->category ? $row->category->en_name : '';
            })
            ->editColumn('license_subcategory_id', function ($row) {
                return $row->subcategory ? $row->subcategory->en_name : '';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? date('d-m-Y', strtotime($row->created_at)) : '—';
            })
            ->addColumn('action', function ($row) {
                $editButton = '';
                $showButton = '';
                $deleteForm = '';

                if (auth()->user()?->can('license.update') || update_permission('license')) {
                    $editButton = '<a href="' . route('license.edit', $row->id) . '" title="Edit" data-toggle="tooltip" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i></a>';
                }
                if (auth()->user()?->can('license.read') || view_permission('license')) {
                    $showButton = '<a href="' . route('license.show', $row->id) . '" title="View" data-toggle="tooltip" class="btn btn-info btn-sm mx-1"><i class="fa fa-eye"></i></a>';
                }
                if (auth()->user()?->can('license.delete') || delete_permission('license')) {
                    $deleteForm = '<form class="deleteData" method="post" style="display:inline-block; margin:0;">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" class="id" name="id" value="' . $row->id . '">
                                        <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('license.destroy', $row->id) . '">
                                        <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('license.index') . '">
                                        <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-danger btn-sm mx-1"><i class="fa fa-trash"></i></button>
                                   </form>';
                }

                return '<div class="table-action d-flex align-items-center justify-content-center">' . $editButton . $showButton . $deleteForm . '</div>';
            })
            ->filterColumn('license_category_id', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                    $q->where('en_name', 'like', "%{$keyword}%")
                        ->orWhere('bn_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('license_subcategory_id', function ($query, $keyword) {
                $query->whereHas('subcategory', function ($q) use ($keyword) {
                    $q->where('en_name', 'like', "%{$keyword}%")
                        ->orWhere('bn_name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(License $model): QueryBuilder
    {
        return $model->newQuery()->with(['category', 'subcategory'])->latest();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('license-table')
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
            Column::make('application_id')->title('Application ID'),
            Column::make('name')->title('License Name'),
            Column::make('license_category_id')->title('Category'),
            Column::make('license_subcategory_id')->title('Subcategory'),
            Column::make('license_no')->title('License No.'),
            Column::make('created_at')->title('Applied Date'),
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(140)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'License_' . date('YmdHis');
    }
}


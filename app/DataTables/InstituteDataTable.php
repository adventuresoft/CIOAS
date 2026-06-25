<?php

namespace App\DataTables;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteDataTable extends DataTable
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
            ->addColumn('institute_name', function ($row) {
                if ($row->institute_type_id == 1 && $row->union) {
                    return $row->union->name;
                } elseif ($row->institute_type_id == 2 && $row->pourashava) {
                    return $row->pourashava->name;
                } elseif ($row->institute_type_id == 3 && $row->cityCorporation) {
                    return $row->cityCorporation->name;
                } elseif ($row->institute_type_id == 4 && $row->district) {
                    return $row->district->name;
                }
                return '—';
            })
            ->addColumn('institute_type', function ($row) {
                return $row->type ? $row->type->name : '—';
            })
            ->addColumn('institute_category', function ($row) {
                return $row->category ? $row->category->name : '—';
            })
            ->editColumn('activation_time', function ($row) {
                return $row->activation_time ? date("d M, Y", strtotime($row->activation_time)) : '—';
            })
            ->addColumn('action', function($row) {
                return '
                <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                    <a href="' . route('institute.edit', $row->id) . '" class="btn btn-primary btn-sm" title="Edit" style="border-radius:4px;"><i class="fas fa-edit"></i></a>
                    <a href="' . route('institute.show', $row->id) . '" class="btn btn-info btn-sm" title="Show" style="border-radius:4px;"><i class="fas fa-eye"></i></a>
                    <form action="' . route('institute.destroy', $row->id) . '" method="POST" class="deleteData d-inline">
                        ' . csrf_field() . ' ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" style="border-radius:4px;"><i class="fas fa-trash"></i></button>
                    </form>
                </div>';
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Institute $model): QueryBuilder
    {
        return $model->newQuery()->with(['type', 'category', 'union', 'pourashava', 'cityCorporation', 'district'])->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('institute-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->parameters([
                        'language' => [
                            'search' => 'খুঁজুন:',
                            'searchPlaceholder' => '',
                            'lengthMenu' => 'প্রদর্শন করুন _MENU_ টি রেকর্ড',
                            'zeroRecords' => 'কোনো রেকর্ড পাওয়া যায়নি',
                            'info' => '_TOTAL_ টি রেকর্ডের মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে',
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
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(60)->addClass('text-center text-muted font-weight-bold'),
            Column::make('institute_name')->title('Institute Name')->addClass('font-weight-bold text-secondary')->searchable(false)->orderable(false),
            Column::make('institute_type')->title('Institute Type')->addClass('text-secondary')->searchable(false)->orderable(false),
            Column::make('institute_category')->title('Institute Category')->addClass('text-secondary')->searchable(false)->orderable(false),
            Column::make('activation_time')->title('Activation Time')->addClass('text-secondary'),
            Column::computed('action')
                  ->title('Action')
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
        return 'Institute_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\InstituteCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InstituteCategoryDataTable extends DataTable
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
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at ? $row->updated_at->format('d M, Y') : '—';
            })
            ->addColumn('action', function($row) {
                return '
                <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                    <a href="' . route('institute-category.edit', $row->id) . '" class="btn btn-primary btn-sm" title="Edit" style="border-radius:4px;"><i class="fas fa-edit"></i></a>
                    <form action="' . route('institute-category.destroy', $row->id) . '" method="POST" class="deleteData d-inline">
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
    public function query(InstituteCategory $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('institutecategory-table')
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
            Column::make('name')->title('Name')->addClass('font-weight-bold text-secondary'),
            Column::make('description')->title('Description')->addClass('text-secondary'),
            Column::make('updated_at')->title('Updated at')->addClass('text-secondary'),
            Column::computed('action')
                  ->title('Action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'InstituteCategory_' . date('YmdHis');
    }
}

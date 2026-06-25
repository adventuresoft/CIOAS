<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class InstitutionalAdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('department', function ($user) {
                return $user->department ? $user->department->name : '';
            })
            ->addColumn('section', function ($user) {
                return $user->section ? $user->section->name : '';
            })
            ->editColumn('created_at', function ($user) {
                return date("d M, Y", strtotime($user->created_at));
            })
            ->addColumn('action', function ($user) {
                $editUrl = route('institutional-admin.edit', $user->id);
                $showUrl = route('institutional-admin.show', $user->id);
                $deleteUrl = route('institutional-admin.destroy', $user->id);

                return '
                    <div class="table-action d-flex align-items-center justify-content-center" style="gap: 6px;">
                        <a href="" class="btn-action btn-list" title="List"><i class="fas fa-list"></i></a>
                        <a href="' . $showUrl . '" class="btn-action btn-view" title="View"><i class="fas fa-eye"></i></a>
                        <a href="' . $editUrl . '" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                        <form class="deleteData" style="display:inline;" action="' . $deleteUrl . '" method="POST">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn-action btn-delete" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['department', 'section'])
            ->where('institute_id', Auth::user()->institute_id)
            ->where('user_type', 'admin');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('institutional-admin-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => '<"row align-items-center justify-content-between"<"col-md-auto"l><"col-md-auto"f>>rt<"row align-items-center justify-content-between"<"col-md-auto"i><"col-md-auto"p>>',
                'language' => [
                    'lengthMenu' => 'প্রদর্শন করুন _MENU_ টি রেকর্ড',
                    'search' => 'খুঁজুন:',
                    'info' => '_TOTAL_ অর্ডারের মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে',
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(50),
            Column::make('name')->title('Name'),
            Column::make('email')->title('Email'),
            Column::make('mobile')->title('Mobile'),
            Column::make('department')->title('Department')->orderable(false)->searchable(false),
            Column::make('section')->title('Designation')->orderable(false)->searchable(false),
            Column::make('created_at')->title('Created at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'InstitutionalAdmin_' . date('YmdHis');
    }
}

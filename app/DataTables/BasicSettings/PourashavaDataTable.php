<?php

namespace App\DataTables\BasicSettings;

use App\Models\Pourashava;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PourashavaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('district', function ($row) {
                return $row->district->name ?? '';
            })
            ->editColumn('name', function ($row) {
                return $row->name ?? '';
            })
            ->editColumn('bn_name', function ($row) {
                return $row->bn_name ?? '';
            })
            ->editColumn('category', function ($row) {
                return $row->category ?? '';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('basic-settings.pourashava.edit', $row->id);
                // No show route for pourashava currently, just edit and delete
                $deleteUrl = route('basic-settings.pourashava.destroy', $row->id);
                $redirectUrl = route('basic-settings.pourashava.index');
                $csrf = csrf_field();
                $method = method_field('DELETE');

                return '
                <div class="table-action">
                    <a class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip" href="'.$editUrl.'"><i class="fa fa-edit"></i></a>
                    <form class="deleteData d-inline" method="post">
                        '.$csrf.'
                        '.$method.'
                        <input type="hidden" class="id" name="id" value="'.$row->id.'">
                        <input type="hidden" class="deleteUrl" name="deleteUrl" value="'.$deleteUrl.'">
                        <input type="hidden" class="redirect-url" name="redirectUrl" value="'.$redirectUrl.'">
                        <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>';
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    public function query(Pourashava $model): QueryBuilder
    {
        return $model->with(['district'])->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pourashava-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2)
            ->addTableClass('table table-bordered table-striped');
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false),
            Column::make('district')->title('District Name')->name('district.name')->orderable(false)->searchable(false),
            Column::make('name')->title('Pourashava Name'),
            Column::make('bn_name')->title('Bangla Name'),
            Column::make('category')->title('Category'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Pourashava_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Union;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UnionDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('thana', function ($row) {
                return $row->thana->name ?? '';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $editButton = '<a class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip" href="' . route('basic-settings.union.edit', $row->id) . '"><i class="fa fa-edit"></i></a>';
                // Union controller doesn't have show implemented right now, so skipping it
                $deleteForm = '<form class="deleteData" method="post" style="display:inline-block;">                          
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="id" name="id" value="' . $row->id . '">
                                    <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('basic-settings.union.destroy', $row->id) . '">
                                    <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('basic-settings.union.index') . '">
                                    <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                               </form>';
                return '<div class="table-action">' . $editButton . $deleteForm . '</div>';
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    public function query(Union $model): QueryBuilder
    {
        return $model->with(['thana'])->newQuery()->select('unions.*')->orderBy('unions.created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('union-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL')->searchable(false)->orderable(false)->width(30)->addClass('text-center'),
            Column::make('thana')->title('Thana Name')->name('thana.name'),
            Column::make('name')->title('Union Name'),
            Column::make('bn_name')->title('Bangla Name'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }
}

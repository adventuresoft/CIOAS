<?php

namespace App\DataTables;

use App\Models\Upazila;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UpazilaDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('district', function ($row) {
                return $row->district->name ?? '';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->editColumn('record', function ($row) {
                $recordNames = [
                    '1' => 'CS',
                    '2' => 'SA',
                    '3' => 'RS',
                    '4' => 'City/BRS'
                ];
                return $recordNames[$row->record] ?? $row->record;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="table-action d-flex align-items-center justify-content-center">
                    <a href="' . route('basic-settings.upazila.show', $row->id) . '" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . route('basic-settings.upazila.edit', $row->id) . '" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="' . route('basic-settings.upazila.destroy', $row->id) . '" method="POST" class="deleteData" style="display:inline-block; margin:0;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" data-toggle="tooltip">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
                ';
                return $actionBtn;
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    public function query(Upazila $model): QueryBuilder
    {
        return $model->with('district')->newQuery()->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('upazila-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(30)->addClass('text-center'),
            Column::make('name')->title('Upazila Name'),
            Column::make('bn_name')->title('Bengali Name'),
            Column::make('district')->title('District')->name('district.name'),
            Column::make('record')->title('Record'),
            Column::make('code')->title('Code'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }
}

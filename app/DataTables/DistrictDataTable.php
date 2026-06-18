<?php

namespace App\DataTables;

use App\Models\District;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DistrictDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('division', function ($row) {
                return $row->Division->name ?? '';
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $editButton = '<a class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip" href="' . route('basic-settings.district.edit', $row->id) . '"><i class="fa fa-edit"></i></a>';
                $showButton = '<a class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip" href="' . route('basic-settings.district.show', $row->id) . '"><i class="fa fa-eye"></i></a>';
                $deleteForm = '<form class="deleteData" method="post" style="display:inline-block;">                          
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="id" name="id" value="' . $row->id . '">
                                    <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('basic-settings.district.destroy', $row->id) . '">
                                    <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('basic-settings.district.index') . '">
                                    <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                               </form>';
                return '<div class="table-action">' . $editButton . $showButton . $deleteForm . '</div>';
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    public function query(District $model): QueryBuilder
    {
        return $model->with('Division')->newQuery()->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('district-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('Sl.')->searchable(false)->orderable(false)->width(30)->addClass('text-center'),
            Column::make('name')->title('District Name'),
            Column::make('bn_name')->title('Bengali Name'),
            Column::make('division')->title('Division')->name('Division.name'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }
}

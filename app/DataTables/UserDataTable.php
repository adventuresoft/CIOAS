<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('profile', function($row) {
                $firstLetter = strtoupper(substr($row->name, 0, 1));
                $imageHtml = '';
                if (!empty($row->image) && file_exists(public_path('upload/users/images/' . $row->image))) {
                    $imageHtml = '<img src="' . asset('upload/users/images/' . $row->image) . '" class="rounded-circle" width="44" height="44" style="object-fit: cover; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">';
                } else {
                    $imageHtml = '<div class="avatar-circle" style="width: 44px; height: 44px; background-color: #e2e8f0; color: #475569; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 1.2rem;">' . $firstLetter . '</div>';
                }

                return '
                <div class="d-flex align-items-center" style="gap: 12px;">
                    ' . $imageHtml . '
                    <div>
                        <div class="font-weight-bold text-dark">' . $row->name . '</div>
                        <div class="text-muted" style="font-size: 0.82rem;">' . $row->email . '</div>
                        <div class="text-secondary" style="font-size: 0.8rem;"><i class="fas fa-id-card mr-1"></i> ' . $row->system_id . '</div>
                    </div>
                </div>';
            })
            ->addColumn('contact', function($row) {
                $areaName = 'No Area';
                if ($row->institute) {
                    if ($row->institute->institute_type_id == 1) {
                        $areaName = ($row->institute->union->name ?? '') . ' (' . ($row->institute->type->name ?? 'Union') . ')';
                    } elseif ($row->institute->institute_type_id == 2) {
                        $areaName = ($row->institute->pourashava->name ?? '') . ' (' . ($row->institute->type->name ?? 'Pourashava') . ')';
                    } elseif ($row->institute->institute_type_id == 3) {
                        $areaName = ($row->institute->cityCorporation->name ?? '') . ' (' . ($row->institute->type->name ?? 'City Corp') . ')';
                    } elseif ($row->institute->institute_type_id == 4) {
                        $areaName = ($row->institute->district->name ?? '') . ' (' . ($row->institute->type->name ?? 'District') . ')';
                    } else {
                        $areaName = 'Area ID: ' . $row->institute->id;
                    }
                    if (!empty($row->institute->district->name)) {
                        $areaName .= ' - District: ' . $row->institute->district->name;
                    }
                }

                return '
                <div>
                    <div class="text-dark"><i class="fas fa-phone-alt text-secondary mr-2" style="font-size: 0.85rem;"></i>' . ($row->mobile ?? 'N/A') . '</div>
                    <div class="text-secondary" style="font-size: 0.85rem;"><i class="fas fa-map-marker-alt text-danger mr-2" style="font-size: 0.85rem;"></i>' . $areaName . '</div>
                </div>';
            })
            ->addColumn('department_section', function($row) {
                $dept = $row->department ? $row->department->name : 'N/A';
                $sec = $row->section ? $row->section->name : 'N/A';
                return '
                <div>
                    <div class="text-dark font-weight-bold" style="font-size: 0.85rem;"><i class="fas fa-building text-primary mr-1"></i> ' . $dept . '</div>
                    <div class="text-secondary mt-1" style="font-size: 0.8rem;"><i class="fas fa-layer-group text-info mr-1"></i> ' . $sec . '</div>
                </div>';
            })
            ->addColumn('roles_list', function($row) {
                if ($row->role) {
                    return '<span class="badge text-white px-2 py-1 mr-1" style="background-color: #0ea5e9; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;"><i class="fas fa-user-shield" style="font-size: 0.8rem;"></i> ' . $row->role->name . '</span>';
                }
                return '<span class="text-muted font-italic" style="font-size: 0.85rem;">No role</span>';
            })
            ->editColumn('status', function($row) {
                if ($row->status == 1) {
                    return '<span class="badge-verified" style="background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; font-weight: 600; padding: 4px 10px; border-radius: 9999px; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 4px;"><i class="fas fa-check-circle"></i> Verified</span>';
                }
                return '<span class="badge-pending" style="background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; font-weight: 600; padding: 4px 10px; border-radius: 9999px; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 4px;"><i class="fas fa-clock"></i> Pending</span>';
            })
            ->addColumn('action', function($row) {
                return '
                <div class="d-flex justify-content-center align-items-center" style="gap: 8px;">
                    <a href="' . route('user.show', $row->id) . '" class="btn btn-operation btn-operation-view" title="View Employee Profile" style="color:#0ea5e9; background:#e0f2fe; padding:6px 12px; border-radius:6px; font-size:0.85rem; transition:all 0.2s;"><i class="fas fa-eye"></i></a>
                    <a href="' . route('user.edit', $row->id) . '" class="btn btn-operation btn-operation-edit" title="Modify Employee Profile" style="color:#f59e0b; background:#fef3c7; padding:6px 12px; border-radius:6px; font-size:0.85rem; transition:all 0.2s;"><i class="fas fa-edit"></i></a>
                    <form action="' . route('user.destroy', $row->id) . '" method="POST" class="d-inline delete-form-confirm">
                        ' . csrf_field() . ' ' . method_field("DELETE") . '
                        <button type="submit" class="btn btn-operation btn-operation-delete" title="Delete Employee" style="color:#ef4444; background:#fee2e2; padding:6px 12px; border-radius:6px; border:none; font-size:0.85rem; transition:all 0.2s;"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </div>';
            })
            ->rawColumns(['profile', 'contact', 'department_section', 'roles_list', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery()->with(['department', 'section', 'role', 'institute.union', 'institute.pourashava', 'institute.cityCorporation', 'institute.district', 'institute.type'])->orderBy('id', 'desc');

        if (request()->has('department_id') && request('department_id') != '') {
            $query->where('department_id', request('department_id'));
        }

        if (request()->has('section_id') && request('section_id') != '') {
            $query->where('section_id', request('section_id'));
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        'data' => 'function(d) {
                            d.department_id = $("#filter_department").val();
                            d.section_id = $("#filter_section").val();
                        }'
                    ])
                    ->orderBy(1)
                    ->parameters([
                        'language' => [
                            'search' => '',
                            'searchPlaceholder' => 'Search users...',
                        ]
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('#')->searchable(false)->orderable(false)->width(60)->addClass('text-center'),
            Column::make('profile')->title('Employee Profile')->name('name'),
            Column::make('contact')->title('Contact & Area')->name('mobile'),
            Column::make('department_section')->title('Dept. & Section')->searchable(false)->orderable(false),
            Column::make('roles_list')->title('Roles')->searchable(false)->orderable(false),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(160)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}

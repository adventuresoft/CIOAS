<?php

namespace App\DataTables;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InquiryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $viewButton = '<a href="' . route('inquiry.show', $query->id) . '" class="btn btn-sm btn-primary mr-1"><i class="fas fa-eye"></i></a>';

                $deleteForm = '<form class="deleteData" method="post" style="display:inline-block;">                          
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" class="id" name="id" value="' . $query->id . '">
                                    <input type="hidden" class="deleteUrl" name="deleteUrl" value="' . route('inquiry.destroy', $query->id) . '">
                                    <input type="hidden" class="redirect-url" name="redirectUrl" value="' . route('inquiry.formlist') . '">
                                    <button type="submit" title="Delete" data-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                               </form>';

                return '<div class="d-flex">' . $viewButton . $deleteForm . '</div>';
            })
            ->editColumn('date', function ($query) {
                return $query->created_at->format('d-m-Y');
            })
            ->editColumn('status', function ($query) {

                switch ($query->status) {
                    case 'pending':
                        return '<span class="badge badge-secondary">Pending</span>';
                    case 'assigned':
                        return '<span class="badge badge-primary">Assigned</span>';
                    case 'received':
                        return '<span class="badge badge-info">Received</span>';
                    case 'processing':
                        return '<span class="badge badge-warning">Processing</span>';
                    case 'approved':
                        return '<span class="badge badge-success">Approved</span>';
                    case 'rejected':
                        return '<span class="badge badge-danger">Rejected</span>';
                    default:
                        return '<span class="badge badge-secondary">' . ucfirst($query->status) . '</span>';
                }
            })
            ->rawColumns(['action', 'date', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Inquiry $model): QueryBuilder
    {
        $user = auth()->user();
        $query = $model->newQuery();

        if ($user && !in_array($user->user_type, ['superadmin', 'developer'])) {
            if ($user->department_id) {
                $query->where('current_department_id', $user->department_id);
                if ($user->section_id) {
                    $query->where(function ($q) use ($user) {
                        $q->whereNull('current_section_id')
                          ->orWhere('current_section_id', $user->section_id);
                    });
                }
            } else {
                // If the user has no read permission and no department, they shouldn't see anything.
                $query->whereRaw('1 = 0');
            }
        }

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('inquiry-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->addClass('text-center'),
            Column::make('subject')->title('Subject'),
            Column::make('applicant_name')->title('Applicant Name'),
            Column::make('mobile_number')->title('Mobile Number')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
            Column::make('nid_number')->title('NID Number')->addClass('text-center'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Inquiry_' . date('YmdHis');
    }
}

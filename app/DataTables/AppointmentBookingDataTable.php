<?php

namespace App\DataTables;

use App\Models\AppointmentBooking;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class AppointmentBookingDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('officer_id', function ($row) {
                return $row->officer->name ?? 'N/A';
            })
            ->addColumn('slot_date', function ($row) {
                return $row->slot->slot_date ?? 'N/A';
            })
            ->addColumn('start_time', function ($row) {
                if ($row->booking_type == 'emergency')
                    return '<span class="badge badge-danger">Emergency</span>';
                return $row->slot->start_time ?? 'N/A';
            })
            ->editColumn('booking_type', function ($row) {
                return ucfirst($row->booking_type);
            })
            ->editColumn('status', function ($row) {
                $badges = [
                    'Pending' => 'warning',
                    'Approved' => 'primary',
                    'Rejected' => 'danger',
                    'Completed' => 'success',
                    'Cancelled' => 'secondary',
                    'Expired' => 'dark',
                ];
                $color = $badges[$row->status] ?? 'info';
                return '<span class="badge badge-' . $color . '">' . $row->status . '</span>';
            })
            ->addColumn('action', function ($row) {
                $view = '<a href="javascript:void(0)" class="btn btn-sm btn-info view-booking"  data-id="' . $row->id . '"><i class="fas fa-eye"></i></a>';

                $approve = '';
                if ($row->status == 'Pending') {
                    $view = '<a href="javascript:void(0)" class="btn btn-sm btn-info view-booking" data-url="' . route('appointment.booking.updateStatus', $row->id) . '" data-status="Approved" data-id="' . $row->id . '"><i class="fas fa-eye"></i></a>';
                    $approve = '<a href="javascript:void(0)" class="btn btn-sm btn-success update-status app_btn ml-1" data-url="' . route('appointment.booking.updateStatus', $row->id) . '" data-status="Approved" title="Approve"><i class="fas fa-check"></i></a>';
                    $approve .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger update-status ml-1" data-url="' . route('appointment.booking.updateStatus', $row->id) . '" data-status="Rejected" title="Reject"><i class="fas fa-times"></i></a>';
                }

                if ($row->status == 'Approved') {
                    $view = '<a href="javascript:void(0)" class="btn btn-sm btn-info view-booking" data-url="' . route('appointment.booking.updateStatus', $row->id) . '" data-status="Completed" data-id="' . $row->id . '"><i class="fas fa-eye"></i></a>';
                    $approve = '<a href="javascript:void(0)" class="btn btn-sm btn-primary update-status ml-1" data-url="' . route('appointment.booking.updateStatus', $row->id) . '" data-status="Completed" title="Mark Completed"><i class="fas fa-check-double"></i></a>';
                }

                return '<div class="d-flex justify-content-center">' . $view . $approve . '</div>';
            })
            ->rawColumns(['start_time', 'status', 'action'])
            ->setRowId('id');
    }

    public function query(AppointmentBooking $model): QueryBuilder
    {
        $query = $model->with(['slot', 'officer'])->newQuery();

        // Admins see all, officers see their own
        if (!Auth::user()->hasRole('superadmin|admin')) {
            $query->where('officer_id', Auth::id());
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('appointmentbooking-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL')->searchable(false)->orderable(false)->width(30)->addClass('text-center'),
            Column::make('officer_id')->title('Officer'),
            Column::make('name')->title('Applicant'),
            Column::make('phone')->title('Phone'),
            Column::make('slot_date')->title('Date')->name('slot.slot_date'),
            Column::make('start_time')->title('Time')->name('slot.start_time'),
            Column::make('booking_type')->title('Type'),
            Column::make('status')->title('Status')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }
}

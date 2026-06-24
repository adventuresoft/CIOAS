@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' =>'LeaveApplication'])
@section('title', 'Leave Applications')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Leave Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leave Applications</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">All Leave Applications</h3>
                            <a href="{{ route('leave-application.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> Apply for Leave</a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Staff ID</th>
                                        <th>Name</th>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Total Days</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->staff_id }}</td>
                                        <td>{{ $leave->staff->user->name ?? 'N/A' }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d-M-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d-M-Y') }}</td>
                                        <td>{{ $leave->total_days }}</td>
                                        <td>
                                            @if($leave->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($leave->status == 'Approved')
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('leave-application.show', $leave->id) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                { "orderable": false, "targets": 8 }
            ]
        });
    });
</script>
@endpush

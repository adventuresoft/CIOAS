@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryRepairApproval'])

@section('title', 'Repairing Approvals')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Repairing Approvals</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Inventory</li>
                    <li class="breadcrumb-item active">Repairing Approvals</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Repair Applications List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped custom-data-table">
                        <thead class="bg-light">
                            <tr>
                                <th>SL</th>
                                <th>Repair No</th>
                                <th>Date</th>
                                <th>Applicant</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($repairs as $index => $repair)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $repair->repair_no }}</td>
                                    <td>{{ $repair->application_date ? $repair->application_date->format('d M, Y') : '—' }}</td>
                                    <td>{{ $repair->applicant_name }}<br><small class="text-muted">{{ $repair->department_name }}</small></td>
                                    <td>{{ $repair->item_name }}</td>
                                    <td>{{ $repair->quantity }}</td>
                                    <td>
                                        @if($repair->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($repair->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($repair->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @elseif($repair->status == 'repaired')
                                            <span class="badge badge-info">Repaired</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('inventory.maintenance.repair.show', $repair->id) }}" class="btn btn-sm btn-info" title="Show Details">
                                            <i class="fas fa-eye"></i> Show
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.custom-data-table').DataTable();
    });
</script>
@endpush

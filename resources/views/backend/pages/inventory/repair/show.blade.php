@extends('backend.master', ['mainMenu' => 'Inventory', 'subMenu' => 'InventoryRepairApproval'])

@section('title', 'Repair Application Details')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Repair Application Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.maintenance.repair.approvals') }}">Repairing Approvals</a></li>
                    <li class="breadcrumb-item active">Details</li>
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
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Application Info: {{ $repair->repair_no }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">Application Date:</th>
                                <td>{{ $repair->application_date->format('d M, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Applicant:</th>
                                <td>{{ $repair->applicant_name }} ({{ $repair->department_name }})</td>
                            </tr>
                            <tr>
                                <th>Item to Repair:</th>
                                <td><strong>{{ $repair->item_name }}</strong></td>
                            </tr>
                            <tr>
                                <th>Category / Type:</th>
                                <td>{{ $repair->category ?? 'N/A' }} / {{ $repair->product_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Quantity:</th>
                                <td>{{ $repair->quantity }} {{ $repair->unit }}</td>
                            </tr>
                            <tr>
                                <th>Problem Description:</th>
                                <td>{{ $repair->problem_description }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
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
                            </tr>
                            @if($repair->admin_remarks)
                            <tr>
                                <th>Admin Remarks:</th>
                                <td>{{ $repair->admin_remarks }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Action</h3>
                    </div>
                    <div class="card-body">
                        @if($repair->status == 'pending')
                            <form action="{{ route('inventory.maintenance.repair.update_status', $repair->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Action <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Action</option>
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                        <option value="repaired">Mark as Repaired Directly</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <textarea class="form-control" name="admin_remarks" rows="3" placeholder="Enter remarks if any"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit Action</button>
                            </form>
                        @elseif($repair->status == 'approved')
                            <div class="alert alert-info">
                                This application is currently approved. Once repaired, you can mark it as repaired.
                            </div>
                            <form action="{{ route('inventory.maintenance.repair.update_status', $repair->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="repaired">
                                <div class="form-group">
                                    <label>Update Remarks (Optional)</label>
                                    <textarea class="form-control" name="admin_remarks" rows="3">{{ $repair->admin_remarks }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Mark as Repaired</button>
                            </form>
                        @else
                            <div class="alert alert-secondary text-center">
                                No further actions available.<br>
                                Current Status: <strong>{{ ucfirst($repair->status) }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

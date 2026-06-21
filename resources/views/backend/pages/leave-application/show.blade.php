@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' =>'LeaveApplication'])
@section('title', 'Leave Application Details')

@push('style')
<style>
    .info-box-custom {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .info-label {
        font-weight: bold;
        color: #555;
    }
    .info-value {
        color: #333;
        margin-bottom: 10px;
        border-bottom: 1px dashed #eee;
        padding-bottom: 5px;
    }
    @media print {
        .no-print { display: none !important; }
        .main-footer { display: none !important; }
    }
</style>
@endpush

@section('content')
<section class="content-header no-print">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave Application Details</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('leave-application.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                <button onclick="window.print()" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header no-print">
                        <h3 class="card-title">Application Info</h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                            <h5>ছুটির আবেদন পত্র</h5>
                        </div>

                        <div class="row info-box-custom">
                            <div class="col-md-6">
                                <div class="info-label">Applicant Name</div>
                                <div class="info-value">{{ $leave->staff->user->name ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Staff ID</div>
                                <div class="info-value">{{ $leave->staff_id }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Phone Number</div>
                                <div class="info-value">{{ $leave->staff->user->mobile ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Department/Designation</div>
                                <div class="info-value">{{ $leave->staff->user->role->name ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="row info-box-custom">
                            <div class="col-md-4">
                                <div class="info-label">Leave Type</div>
                                <div class="info-value">{{ $leave->leave_type }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Start Date</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($leave->start_date)->format('d F, Y') }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">End Date</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($leave->end_date)->format('d F, Y') }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-label">Total Days</div>
                                <div class="info-value">{{ $leave->total_days }} Day(s)</div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="info-label">Reason for Leave</div>
                                <div class="info-value">{{ $leave->reason }}</div>
                            </div>
                        </div>

                        <div class="row info-box-custom">
                            <div class="col-md-6">
                                <div class="info-label">Emergency Contact</div>
                                <div class="info-value">{{ $leave->emergency_contact ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Address During Leave</div>
                                <div class="info-value">{{ $leave->address_during_leave ?: 'N/A' }}</div>
                            </div>
                            <div class="col-md-12">
                                <div class="info-label">Relieving Officer/Staff</div>
                                <div class="info-value">
                                    @if($leave->relievingStaff)
                                        {{ $leave->relievingStaff->user->name ?? '' }} (ID: {{ $leave->relieving_staff_id }})
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 mt-2 no-print">
                                <div class="info-label">Attachment</div>
                                <div class="info-value">
                                    @if($leave->attachment)
                                        <a href="{{ asset('storage/' . $leave->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-paperclip"></i> View Attachment</a>
                                    @else
                                        No attachment provided
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Admin Action Box -->
            <div class="col-md-4 no-print">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Leave Status & Action</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <strong>Current Status: </strong> 
                            @if($leave->status == 'Pending')
                                <span class="badge badge-warning" style="font-size:14px;">Pending</span>
                            @elseif($leave->status == 'Approved')
                                <span class="badge badge-success" style="font-size:14px;">Approved</span>
                            @else
                                <span class="badge badge-danger" style="font-size:14px;">Rejected</span>
                            @endif
                        </div>

                        <form action="{{ route('leave-application.update-status', $leave->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Change Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Pending" {{ $leave->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Approved" {{ $leave->status == 'Approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="Rejected" {{ $leave->status == 'Rejected' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Admin Remarks / Comments</label>
                                <textarea name="admin_remarks" class="form-control" rows="3">{{ $leave->admin_remarks }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> Save Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

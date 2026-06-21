@extends('backend.master', ['mainMenu' => 'Staff', 'subMenu' =>'LeaveApplication'])
@section('title', 'Apply for Leave')

@push('style')
<style>
    .leave-panel {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f8f9fc;
    }
    .leave-panel-title {
        font-weight: 600;
        color: #4e73df;
        margin-bottom: 15px;
        border-bottom: 2px solid #e3e6f0;
        padding-bottom: 10px;
    }
    .auto-fill-box {
        background-color: #eaecf4;
        padding: 10px;
        border-radius: 5px;
        font-weight: 500;
        min-height: 40px;
    }
</style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave Application Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('leave-application.index') }}">Leave Applications</a></li>
                    <li class="breadcrumb-item active">Apply</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">New Leave Request</h3>
                    </div>
                    
                    <form action="{{ route('leave-application.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            <!-- Applicant Info -->
                            <div class="leave-panel">
                                <h5 class="leave-panel-title"><i class="fas fa-user"></i> Applicant Information</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Staff ID <span class="text-danger">*</span></label>
                                            <input type="text" name="staff_id" id="staff_id" class="form-control" placeholder="Enter Staff ID" required>
                                            <small id="staff_error" class="text-danger" style="display:none;"><i class="fas fa-times-circle"></i> Staff not found!</small>
                                            <small id="staff_success" class="text-success" style="display:none;"><i class="fas fa-check-circle"></i> Staff verified!</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="auto-fill-box" id="staff_name_display">--</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <div class="auto-fill-box" id="staff_phone_display">--</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Leave Details -->
                            <div class="leave-panel">
                                <h5 class="leave-panel-title"><i class="fas fa-calendar-alt"></i> Leave Details</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Leave Type <span class="text-danger">*</span></label>
                                            <select name="leave_type" class="form-control select2" required>
                                                <option value="">Select Leave Type</option>
                                                <option value="Casual Leave">Casual Leave (নৈমিত্তিক ছুটি)</option>
                                                <option value="Sick Leave">Sick Leave (অসুস্থতা জনিত ছুটি)</option>
                                                <option value="Earned Leave">Earned Leave (অর্জিত ছুটি)</option>
                                                <option value="Maternity Leave">Maternity Leave (মাতৃত্বকালীন ছুটি)</option>
                                                <option value="Paternity Leave">Paternity Leave (পিতৃত্বকালীন ছুটি)</option>
                                                <option value="Unpaid Leave">Unpaid Leave (বিনা বেতনে ছুটি)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Date <span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>End Date <span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Total Days <span class="text-danger">*</span></label>
                                            <input type="number" name="total_days" id="total_days" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Reason for Leave <span class="text-danger">*</span></label>
                                            <textarea name="reason" class="form-control" rows="3" placeholder="Briefly describe the reason for taking leave" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact & Handover -->
                            <div class="leave-panel">
                                <h5 class="leave-panel-title"><i class="fas fa-address-book"></i> Contact & Handover During Leave</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Emergency Contact No.</label>
                                            <input type="text" name="emergency_contact" class="form-control" placeholder="Contact number during leave">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Relieving Officer/Staff ID (Optional)</label>
                                            <input type="text" name="relieving_staff_id" id="relieving_staff_id" class="form-control" placeholder="ID of staff covering duties">
                                            <small id="rel_staff_display" class="text-primary mt-1 d-block"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Attachment (Medical Certificate, etc.)</label>
                                            <input type="file" name="attachment" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address During Leave</label>
                                            <textarea name="address_during_leave" class="form-control" rows="2" placeholder="Where will you be staying during the leave?"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('leave-application.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
$(document).ready(function() {
    $('.select2').select2();

    // Auto calculate Total Days
    $('#start_date, #end_date').on('change', function() {
        let start = $('#start_date').val();
        let end = $('#end_date').val();
        
        if(start && end) {
            let startDate = new Date(start);
            let endDate = new Date(end);
            let timeDiff = endDate.getTime() - startDate.getTime();
            let daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
            
            if(daysDiff > 0) {
                $('#total_days').val(daysDiff);
            } else {
                $('#total_days').val('');
                alert("End date cannot be before Start date");
            }
        }
    });

    // Auto fetch Staff Info
    let fetchStaffInfo = function(inputId, nameDisplayId, phoneDisplayId, errorId, successId) {
        let staffId = $(inputId).val();
        if(staffId.length > 0) {
            $.ajax({
                url: "{{ route('leave-application.api.staff_info') }}",
                type: "GET",
                data: { staff_id: staffId },
                success: function(res) {
                    if(res.status) {
                        $(nameDisplayId).text(res.name);
                        if(phoneDisplayId) $(phoneDisplayId).text(res.phone || 'N/A');
                        if(errorId) $(errorId).hide();
                        if(successId) $(successId).show();
                    } else {
                        $(nameDisplayId).text('--');
                        if(phoneDisplayId) $(phoneDisplayId).text('--');
                        if(errorId) $(errorId).show();
                        if(successId) $(successId).hide();
                    }
                }
            });
        } else {
            $(nameDisplayId).text('--');
            if(phoneDisplayId) $(phoneDisplayId).text('--');
            if(errorId) $(errorId).hide();
            if(successId) $(successId).hide();
        }
    };

    $('#staff_id').on('input', function() {
        clearTimeout(window.staffTimeout);
        window.staffTimeout = setTimeout(() => {
            fetchStaffInfo('#staff_id', '#staff_name_display', '#staff_phone_display', '#staff_error', '#staff_success');
        }, 500);
    });

    $('#relieving_staff_id').on('input', function() {
        clearTimeout(window.relTimeout);
        window.relTimeout = setTimeout(() => {
            let id = $(this).val();
            if(id.length > 0) {
                $.ajax({
                    url: "{{ route('leave-application.api.staff_info') }}",
                    type: "GET",
                    data: { staff_id: id },
                    success: function(res) {
                        if(res.status) {
                            $('#rel_staff_display').html('<i class="fas fa-check-circle text-success"></i> ' + res.name);
                        } else {
                            $('#rel_staff_display').html('<i class="fas fa-times-circle text-danger"></i> Not found');
                        }
                    }
                });
            } else {
                $('#rel_staff_display').text('');
            }
        }, 500);
    });
});
</script>
@endpush

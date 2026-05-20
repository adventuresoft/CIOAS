@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormList'])
@section('title', 'View Application Form')

@push('style')
    <style>
        .application-view .info-box {
            min-height: auto;
            box-shadow: none;
            border: 1px solid #e9ecef;
        }

        .application-view .info-label {
            color: #6c757d;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .application-view .info-value {
            color: #212529;
            font-size: 15px;
            margin-bottom: 0;
            word-break: break-word;
        }

        .application-view .message-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            min-height: 120px;
            padding: 18px;
            white-space: pre-line;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Application Form Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('application-form.index') }}">Application Form</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content application-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h3 class="card-title mb-0">দাখিল করা চিঠি</h3>
                                </div>
                                <div class="col-md-5 text-right">
                                    <a href="{{ route('application-form.index') }}" class="btn btn-sm btn-dark">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Application No</div>
                                            <p class="info-value">{{ $applicationForm->application_number ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Date</div>
                                            <p class="info-value">
                                                {{ $applicationForm->date ? date('d M, Y', strtotime($applicationForm->date)) : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Status</div>
                                            @php
                                                $badge = match ($applicationForm->status) {
                                                    'pending' => 'secondary',
                                                    'assigned' => 'info',
                                                    'received' => 'primary',
                                                    'processing' => 'warning',
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span class="badge badge-{{ $badge }}">{{ ucfirst($applicationForm->status ?? 'pending') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Received By</div>
                                            <p class="info-value">{{ $applicationForm->receiver->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Current Department</div>
                                            <p class="info-value">{{ $applicationForm->currentDepartment->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Current Section</div>
                                            <p class="info-value">{{ $applicationForm->currentSection->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">প্রাপক (Recipient)</div>
                                            <p class="info-value">{{ $applicationForm->recipient ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">প্রেরক (Sender)</div>
                                            <p class="info-value">{{ $applicationForm->sender ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">মোবাইল নম্বর (Mobile Number)</div>
                                            <p class="info-value">{{ $applicationForm->mobile ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">এনআইডি নম্বর (NID NO)</div>
                                            <p class="info-value">{{ $applicationForm->nid_no ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">ফর্মের ধরণ</div>
                                            <p class="info-value">{{ $applicationForm->form_type ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">বিষয় (Subject)</div>
                                            <p class="info-value">{{ $applicationForm->subject ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Created At</div>
                                            <p class="info-value">
                                                {{ $applicationForm->created_at ? $applicationForm->created_at->format('d M, Y h:i A') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Approved By</div>
                                            <p class="info-value">{{ $applicationForm->approver->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">Approved At</div>
                                            <p class="info-value">
                                                {{ $applicationForm->approved_at ? $applicationForm->approved_at->format('d M, Y h:i A') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="info-label">ঠিকানা (Address)</div>
                                    <div class="message-box">{{ $applicationForm->address ?: '-' }}</div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="info-label">বার্তা (Message)</div>
                                    <div class="message-box">{{ $applicationForm->message ?: '-' }}</div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="info-box p-3">
                                        <div class="info-label">Last Assignment Note</div>
                                        <p class="info-value">{{ $applicationForm->note ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="info-box p-3">
                                        <div class="info-label">Approval Note</div>
                                        <p class="info-value">{{ $applicationForm->approval_note ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">সংযুক্তি (Attachment)</div>
                                            @if ($applicationForm->attachment)
                                                <a href="{{ asset($applicationForm->attachment) }}" target="_blank"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-paperclip"></i> View Attachment
                                                </a>
                                            @else
                                                <p class="info-value">No attachment uploaded</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($canAssign || $canReceive || $canApprove)
                                <hr>
                            @endif

                            <div class="row">
                                @if ($canAssign)
                                    <div class="col-md-8">
                                        <form id="assignForm" method="POST">
                                            @csrf
                                            <div class="card card-outline card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Assign / Re-Assign</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="department_id">Department</label>
                                                                <select name="department_id" id="department_id" class="form-control" required>
                                                                    <option value="">Select Department</option>
                                                                    @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}"
                                                                            {{ (int) $applicationForm->current_department_id === (int) $department->id ? 'selected' : '' }}>
                                                                            {{ $department->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="text-danger error department_id_error"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="section_id">Section</label>
                                                                <select name="section_id" id="section_id" class="form-control" required>
                                                                    <option value="">Select Section</option>
                                                                    @foreach ($sections as $section)
                                                                        <option value="{{ $section->id }}"
                                                                            {{ (int) $applicationForm->current_section_id === (int) $section->id ? 'selected' : '' }}>
                                                                            {{ $section->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="text-danger error section_id_error"></small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="assign_note">Note</label>
                                                        <textarea name="note" id="assign_note" rows="3" class="form-control" placeholder="Assignment note (optional)"></textarea>
                                                        <small class="text-danger error note_error"></small>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button type="submit" class="btn btn-primary" id="assignBtn">
                                                        Save Assignment
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif

                                @if ($canReceive || ($showApproveForm ?? false))
                                    <div class="col-md-4">
                                        @if ($canReceive)
                                            <form id="receiveForm" method="POST">
                                                @csrf
                                                <div class="card card-outline card-success">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Receive Application</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="mb-0">
                                                            যদি এই ফাইলটি আপনার Department/Section এর হয়, তাহলে Receive দিন।
                                                        </p>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <button type="submit" class="btn btn-success" id="receiveBtn">
                                                            Receive
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif

                                        @if ($showApproveForm ?? false)
                                            <form id="approveForm" method="POST" class="{{ $canReceive ? 'mt-3' : '' }}">
                                                @csrf
                                                <input type="hidden" name="status_action" id="status_action" value="approve">
                                                <div class="card card-outline card-success">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            @if ($applicationForm->status === 'processing')
                                                                Final Approve Application
                                                            @else
                                                                Approve Application
                                                            @endif
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group mb-0">
                                                            <label for="approval_note">Approval Note</label>
                                                            <textarea name="approval_note" id="approval_note" rows="3" class="form-control"
                                                                placeholder="Approve করার নোট লিখুন" {{ $canApprove ? 'required' : 'disabled' }}>{{ $applicationForm->approval_note }}</textarea>
                                                            <small class="text-danger error approval_note_error"></small>
                                                            @if ($applicationForm->status === 'approved')
                                                                <small class="text-success d-block mt-1">আবেদনটি ইতিপূর্বে অনুমোদিত হয়েছে। (Application has been approved)</small>
                                                            @elseif ($applicationForm->status === 'rejected')
                                                                <small class="text-danger d-block mt-1">আবেদনটি প্রত্যাখ্যান করা হয়েছে। (Application has been rejected)</small>
                                                            @elseif ($applicationForm->status === 'processing' && !$canApprove)
                                                                <small class="text-warning d-block mt-1">আবেদনটি বর্তমানে Processing অবস্থায় আছে। ফাইনাল অ্যাপ্রুভ করার অনুমতি আপনার নেই।</small>
                                                            @elseif (!$canApprove)
                                                                <small class="text-muted d-block mt-1">Receive করার পরে Approve করা যাবে।</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if ($applicationForm->status !== 'approved' && $applicationForm->status !== 'rejected')
                                                        @if ($canApprove)
                                                            <div class="card-footer text-right">
                                                                @if ($applicationForm->status === 'processing')
                                                                    <button type="button" class="btn btn-danger mr-2" id="rejectBtn">
                                                                        Reject
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success" id="approveBtn">
                                                                        Final Approve
                                                                    </button>
                                                                @else
                                                                    <button type="submit" class="btn btn-success" id="approveBtn">
                                                                        Approve
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mb-3">Assignment History</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Assigned At</th>
                                                    <th>From Department/Section</th>
                                                    <th>To Department/Section</th>
                                                    <th>Assigned By</th>
                                                    <th>Received By</th>
                                                    <th>Received At</th>
                                                    <th>Note</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($applicationForm->assignments as $key => $assign)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $assign->created_at ? $assign->created_at->format('d M, Y h:i A') : '-' }}</td>
                                                        <td>
                                                            {{ $assign->fromDepartment->name ?? '-' }}
                                                            /
                                                            {{ $assign->fromSection->name ?? '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $assign->toDepartment->name ?? '-' }}
                                                            /
                                                            {{ $assign->toSection->name ?? '-' }}
                                                        </td>
                                                        <td>{{ $assign->assignedByUser->name ?? '-' }}</td>
                                                        <td>{{ $assign->receivedByUser->name ?? '-' }}</td>
                                                        <td>{{ $assign->received_at ? $assign->received_at->format('d M, Y h:i A') : '-' }}</td>
                                                        <td>{{ $assign->note ?? '-' }}</td>
                                                        <td>
                                                            @if ($key === 0)
                                                                @php
                                                                    $badge = match ($applicationForm->status) {
                                                                        'pending' => 'secondary',
                                                                        'assigned' => 'info',
                                                                        'received' => 'primary',
                                                                        'processing' => 'warning',
                                                                        'approved' => 'success',
                                                                        'rejected' => 'danger',
                                                                        default => 'secondary',
                                                                    };
                                                                @endphp
                                                                <span class="badge badge-{{ $badge }}">{{ ucfirst($applicationForm->status ?? 'pending') }}</span>
                                                            @else
                                                                @if ($assign->is_received)
                                                                    <span class="badge badge-success">Received</span>
                                                                @else
                                                                    <span class="badge badge-info">Assigned</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">No assignment history found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('application-form.index') }}" class="btn btn-default">Back to List</a>
                            @if ($canManageAllApplications ?? false)
                                <a href="{{ route('application-form.edit', $applicationForm->id) }}" class="btn btn-info">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            const sectionRouteTemplate = @json(route('basic-settings.get-sections-by-department', ['department_id' => '__DEPARTMENT__']));

            function renderSections(departmentId, selectedSectionId = null) {
                const sectionSelect = $('#section_id');
                sectionSelect.html('<option value="">Loading...</option>');

                if (!departmentId) {
                    sectionSelect.html('<option value="">Select Section</option>');
                    return;
                }

                const requestUrl = sectionRouteTemplate.replace('__DEPARTMENT__', departmentId);

                $.get(requestUrl, function(response) {
                    let options = '<option value="">Select Section</option>';
                    $.each(response, function(index, section) {
                        const isSelected = selectedSectionId && parseInt(selectedSectionId, 10) === parseInt(section.id, 10) ? 'selected' : '';
                        options += `<option value="${section.id}" ${isSelected}>${section.name}</option>`;
                    });
                    sectionSelect.html(options);
                }).fail(function() {
                    sectionSelect.html('<option value="">Select Section</option>');
                    toastr.error('Section list load করতে সমস্যা হয়েছে।');
                });
            }

            $('#department_id').on('change', function() {
                renderSections($(this).val());
            });

            $('#assignForm').on('submit', function(e) {
                e.preventDefault();
                const thisForm = $(this);
                const submitBtn = $('#assignBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.assign', $applicationForm->id) }}",
                    data: thisForm.serialize(),
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                        thisForm.find('.error').text('');
                    },
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 900);
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);

                        if (xhr.status === 422) {
                            const response = xhr.responseJSON || {};
                            $.each(response.errors || {}, function(key, val) {
                                thisForm.find('.' + key + '_error').text(val[0]);
                            });
                            toastr.error(response.message || 'Validation error');
                            return;
                        }

                        const response = xhr.responseJSON || {};
                        toastr.error(response.message || 'Assign failed');
                    }
                });
            });

            $('#receiveForm').on('submit', function(e) {
                e.preventDefault();
                const submitBtn = $('#receiveBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.receive', $applicationForm->id) }}",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                    },
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 900);
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        const response = xhr.responseJSON || {};
                        toastr.error(response.message || 'Receive failed');
                    }
                });
            });

            $('#approveBtn').on('click', function() {
                $('#status_action').val('approve');
            });

            $('#rejectBtn').on('click', function() {
                $('#status_action').val('reject');
                // Ensure approval note is provided when rejecting
                const approvalNote = $('#approval_note').val().trim();
                if (!approvalNote) {
                    toastr.error('প্রত্যাখ্যান (Reject) করার জন্য নোট লেখা আবশ্যিক।');
                    $('#approval_note').focus();
                    return;
                }
                $('#approveForm').submit();
            });

            $('#approveForm').on('submit', function(e) {
                e.preventDefault();
                const thisForm = $(this);
                const submitBtn = $('#approveBtn');
                const rejectBtn = $('#rejectBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.approve', $applicationForm->id) }}",
                    data: thisForm.serialize(),
                    beforeSend: function() {
                        submitBtn.prop('disabled', true);
                        rejectBtn.prop('disabled', true);
                        thisForm.find('.error').text('');
                    },
                    success: function(response) {
                        submitBtn.prop('disabled', false);
                        rejectBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 900);
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false);
                        rejectBtn.prop('disabled', false);

                        if (xhr.status === 422) {
                            const response = xhr.responseJSON || {};
                            $.each(response.errors || {}, function(key, val) {
                                thisForm.find('.' + key + '_error').text(val[0]);
                            });
                            toastr.error(response.message || 'Validation error');
                            return;
                        }

                        const response = xhr.responseJSON || {};
                        toastr.error(response.message || 'Approve failed');
                    }
                });
            });
        });
    </script>
@endpush

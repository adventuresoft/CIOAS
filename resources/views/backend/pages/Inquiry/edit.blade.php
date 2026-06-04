@extends('backend.master', ['mainMenu' => 'Inquiry', 'subMenu' => 'FormList'])
@push('style')
    <style>
        .card-outline {
            border-top: 3px solid;
        }
        .inquiry-table th {
            font-weight: 600;
            color: #495057;
            vertical-align: middle;
        }
        .inquiry-table td {
            vertical-align: middle;
        }
    </style>
@endpush
@section('title', 'Inquiry Details')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inquiry Details & Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('inquiry.formlist') }}">Form List</a></li>
                        <li class="breadcrumb-item active">View & Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <!-- User Info Card -->
                    <div class="card card-primary card-outline shadow-sm mb-4">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h3 class="card-title m-0"><i class="fas fa-info-circle text-primary"></i> User Inquiry Information</h3>
                            @if($inquiry->status)
                                @php
                                    $badgeClass = 'secondary';
                                    if($inquiry->status == 'Pending') $badgeClass = 'warning';
                                    elseif($inquiry->status == 'In Progress') $badgeClass = 'info';
                                    elseif($inquiry->status == 'Resolved') $badgeClass = 'success';
                                    elseif($inquiry->status == 'Rejected') $badgeClass = 'danger';
                                @endphp
                                <span class="badge badge-{{ $badgeClass }} float-right px-3 py-2" style="font-size: 0.9rem;">{{ $inquiry->status }}</span>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0 inquiry-table">
                                    <tbody>
                                        <tr>
                                            <th style="width: 35%;"><i class="fas fa-user text-muted mr-2"></i> Applicant Name</th>
                                            <td><strong>{{ $inquiry->applicant_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-user-tie text-muted mr-2"></i> Father's Name</th>
                                            <td>{{ $inquiry->father_name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-phone-alt text-muted mr-2"></i> Mobile Number</th>
                                            <td><a href="tel:{{ $inquiry->mobile_number }}">{{ $inquiry->mobile_number }}</a></td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-envelope text-muted mr-2"></i> Email Address</th>
                                            <td>{!! $inquiry->email ? '<a href="mailto:'.$inquiry->email.'">'.$inquiry->email.'</a>' : '<span class="text-muted">N/A</span>' !!}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-id-card text-muted mr-2"></i> NID Number</th>
                                            <td>{{ $inquiry->nid_number ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-map-marker-alt text-muted mr-2"></i> Address</th>
                                            <td>{{ $inquiry->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-paperclip text-muted mr-2"></i> Proof File</th>
                                            <td>
                                                @if($inquiry->proof_file)
                                                    <a href="{{ asset($inquiry->proof_file) }}" target="_blank" class="btn btn-xs btn-outline-primary rounded-pill px-3"><i class="fas fa-external-link-alt"></i> View Attachment</a>
                                                @else
                                                    <span class="badge badge-light text-muted border">No file attached</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="p-4 mt-3" style="background-color: #f8f9fa; border-top: 1px solid #dee2e6;">
                                <h5 class="text-primary mb-3" style="font-weight: 600;"><i class="fas fa-heading mr-2"></i> {{ $inquiry->subject }}</h5>
                                <div class="text-dark bg-white p-3 rounded border" style="line-height: 1.7; font-size: 1rem;">
                                    {!! nl2br(e($inquiry->details)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Action Card -->
                    <div class="card card-warning card-outline shadow-sm">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fas fa-edit text-warning"></i> Admin Action</h3>
                        </div>
                        <form id="FormSubmit" method="POST" data-url="{{ route('inquiry.update', $inquiry->id) }}" data-redirect-url="{{ route('inquiry.formlist') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Update Status <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="Pending" {{ $inquiry->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $inquiry->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Resolved" {{ $inquiry->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="Rejected" {{ $inquiry->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <span class="error status_error text-danger"></span>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="comment">Admin Comment</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="4" placeholder="Write internal notes or a response here...">{{ $inquiry->comment }}</textarea>
                                    <span class="error comment_error text-danger"></span>
                                </div>
                            </div>
                            <div class="card-footer bg-white text-right">
                                <a href="{{ route('inquiry.formlist') }}" class="btn btn-secondary mr-2"><i class="fas fa-times"></i> Cancel</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
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
        $(document).ready(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        });
    </script>
@endpush

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
            min-height: 160px;
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

                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box p-3">
                                        <div>
                                            <div class="info-label">মোবাইল নম্বর (Mobile Number)</div>
                                            <p class="info-value">{{ $applicationForm->mobile ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">

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
                                            <div class="info-label">ঠিকানা (Address)</div>
                                            <p class="info-value">{{ $applicationForm->address ?? '-' }}</p>
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
                                            <div class="info-label">Status</div>
                                            @php
                                                $badge = match ($applicationForm->status) {
                                                    'pending' => 'secondary',
                                                    'assigned' => 'info',
                                                    'received' => 'primary',
                                                    'forwarded' => 'warning',
                                                    'in_review' => 'dark',
                                                    'approved' => 'success',
                                                    'rejected' => 'danger',
                                                    'completed' => 'success',
                                                    default => 'secondary',
                                                };
                                            @endphp

                                            <div class="badge badge-{{ $badge }}">
                                                {{ ucfirst($applicationForm->status) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="info-label">বার্তা (Message)</div>
                                    <div class="message-box">
                                        {{ $applicationForm->message ?: '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
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

                                <div class="col-md-6">
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
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('application-form.index') }}" class="btn btn-default">Back to List</a>
                            <a href="{{ route('application-form.edit', $applicationForm->id) }}"
                                class="btn btn-info">received</a>
                            <a href="{{ route('application-form.edit', $applicationForm->id) }}"
                                class="btn btn-success">Approved</a>
                            <a href="{{ route('application-form.edit', $applicationForm->id) }}"
                                class="btn btn-danger">Rejected</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

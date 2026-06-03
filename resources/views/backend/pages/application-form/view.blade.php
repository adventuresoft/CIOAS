@extends('backend.master', ['mainMenu' => 'Application Form', 'subMenu' => 'ApplicationFormList'])
@section('title', 'View Application Form')

@push('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+Bengali:wght@300;400;500;600;700;800&family=Courier+Prime:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        /* Modern Smart Gov Theme Rules */
        .application-view-container {
            font-family: 'Inter', 'Noto Sans Bengali', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #2d3748;
            background-color: #f8fafc;
            padding-bottom: 50px;
        }

        /* Bangladesh Govt Color Strip */
        .govt-strip {
            height: 5px;
            background: linear-gradient(90deg, #006a4e 0%, #006a4e 75%, #f42a41 75%, #f42a41 100%);
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 8px 8px 0 0;
        }

        /* Official Document Paper style */
        .document-paper {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            position: relative;
            overflow: hidden;
            padding: 40px 50px;
            margin-bottom: 30px;
            min-height: 800px;
        }

        @media (max-width: 768px) {
            .document-paper {
                padding: 25px 20px;
            }
        }

        /* Watermark Rubber Stamp styling */
        .watermark-stamp {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-family: 'Inter', sans-serif;
            font-weight: 800;
            font-size: 3.5rem;
            text-transform: uppercase;
            border: 6px double;
            padding: 8px 24px;
            border-radius: 12px;
            opacity: 0.05;
            pointer-events: none;
            letter-spacing: 4px;
            z-index: 10;
            text-align: center;
        }

        .watermark-stamp.approved {
            color: #006a4e;
            border-color: #006a4e;
        }

        .watermark-stamp.processing {
            color: #d97706;
            border-color: #d97706;
        }

        .watermark-stamp.rejected {
            color: #dc2626;
            border-color: #dc2626;
        }

        .watermark-stamp.pending {
            color: #4b5563;
            border-color: #4b5563;
        }

        /* Govt Letterhead Header */
        .govt-header {
            border-bottom: 2px solid #006a4e;
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .govt-subtext {
            font-weight: 600;
            color: #4b5563;
            font-size: 13.5px;
            letter-spacing: 0.5px;
        }

        .govt-maintext {
            color: #006a4e;
            font-weight: 800;
            font-size: 22px;
        }

        .govt-address {
            color: #6b7280;
            font-size: 12.5px;
        }

        /* Memo Info Layout */
        .memo-info {
            font-size: 14px;
            color: #374151;
            margin-bottom: 25px;
        }

        .mono-num {
            font-family: 'Courier Prime', monospace;
            font-weight: 700;
            color: #0f172a;
        }

        /* Letter Structure styling */
        .letter-subject {
            font-size: 16.5px;
            font-weight: 700;
            color: #111827;
            padding-bottom: 10px;
            border-bottom: 1px dashed #cbd5e1;
            margin-bottom: 20px;
        }

        .letter-salutation {
            font-size: 15px;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .letter-body {
            font-size: 15.5px;
            line-height: 1.8;
            color: #1f2937;
            text-align: justify;
            text-indent: 45px;
            margin-bottom: 30px;
            white-space: pre-line;
        }

        /* Signatures blocks */
        .sig-block {
            text-align: center;
            position: relative;
            padding: 20px 15px;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            background-color: #fafafa;
            height: 100%;
        }

        .sig-stamp-placeholder {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 10.5px;
            background: #006a4e;
            color: white;
            padding: 2px 10px;
            border-radius: 20px;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sig-stamp-placeholder.warn {
            background: #d97706;
        }

        .sig-name {
            font-weight: 700;
            color: #111827;
            font-size: 13.5px;
            margin-top: 15px;
        }

        .sig-title {
            color: #4b5563;
            font-size: 12px;
            font-weight: 500;
        }

        .sig-date {
            color: #9ca3af;
            font-size: 10.5px;
            margin-top: 4px;
        }

        /* Attachment badges styling */
        .attachment-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            color: #334155;
            font-weight: 600;
            font-size: 13.5px;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }

        .attachment-badge:hover {
            background-color: #e2e8f0;
            color: #0f172a;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        /* Tracking Timeline Styling */
        .timeline-routing {
            position: relative;
            padding-left: 24px;
            margin-left: 6px;
        }

        .timeline-routing::before {
            content: '';
            position: absolute;
            left: 5px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background-color: #e2e8f0;
        }

        .timeline-node {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-node:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: -24px;
            top: 3px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background-color: #cbd5e1;
            border: 2px solid white;
            z-index: 2;
        }

        .timeline-node.success .timeline-icon {
            background-color: #16a34a !important;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.15);
        }

        .timeline-node.info .timeline-icon {
            background-color: #0284c7 !important;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .timeline-node.warning .timeline-icon {
            background-color: #d97706 !important;
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.15);
        }

        .timeline-node.danger .timeline-icon {
            background-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
        }

        .timeline-content {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: 13px;
        }

        .timeline-time {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .timeline-title {
            font-weight: 700;
            color: #0f172a;
            font-size: 13.5px;
            margin-bottom: 2px;
        }

        .timeline-desc {
            color: #475569;
            font-size: 12.5px;
            line-height: 1.4;
        }

        .timeline-note {
            font-style: italic;
            color: #475569;
            font-size: 12px;
            background-color: #f8fafc;
            border-left: 2px solid #cbd5e1;
            padding: 4px 8px;
            margin-top: 6px;
            border-radius: 0 4px 4px 0;
        }

        /* Capsule Status badges */
        .capsule-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
        }

        .capsule-badge.pending {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .capsule-badge.assigned {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .capsule-badge.received {
            background-color: #f3e8ff;
            color: #6b21a8;
            border: 1px solid #e9d5ff;
        }

        .capsule-badge.processing {
            background-color: #fef9c3;
            color: #854d0e;
            border: 1px solid #fef08a;
        }

        .capsule-badge.approved {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .capsule-badge.rejected {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Card panels */
        .control-card {
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
            background: #ffffff;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .control-card-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 18px;
            font-weight: 700;
            font-size: 14.5px;
            color: #1e293b;
        }

        .control-card-body {
            padding: 18px;
        }

        /* Sidebar meta values */
        .meta-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
        }

        .meta-item:last-child {
            margin-bottom: 0;
            border-bottom: none;
            padding-bottom: 0;
        }

        .meta-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }

        .meta-val {
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
        }

        /* Print media configurations */
        @media print {
            body {
                background: white !important;
                color: black !important;
            }

            .main-sidebar,
            .main-header,
            .main-footer,
            .no-print,
            .breadcrumb,
            .content-header,
            .btn,
            .control-card {
                display: none !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
                background: white !important;
                padding: 0 !important;
            }

            .print-document-area {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
                position: absolute;
                left: 0;
                top: 0;
            }

            .document-paper {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }

            .govt-strip {
                display: none !important;
            }

            .govt-logo-container img {
                max-height: 90px !important;
            }
        }
    </style>
@endpush

@section('content')
    <section class="content-header no-print">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold text-dark" style="font-size: 24px;"><i class="fa fa-file-alt text-info"></i>
                        Application Form Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: transparent;">
                        <li class="breadcrumb-item"><a href="{{ route('application-form.index') }}">Application Form</a>
                        </li>
                        <li class="breadcrumb-item active">View Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @php
        $statusBn = match ($applicationForm->status) {
            'pending' => 'অপেক্ষমান (Pending)',
            'assigned' => 'প্রেরিত (Assigned)',
            'received' => 'গৃহীত (Received)',
            'processing' => 'প্রক্রিয়াধীন (Processing)',
            'approved' => 'অনুমোদিত (Approved)',
            'rejected' => 'প্রত্যাখ্যাত (Rejected)',
            default => 'অপেক্ষমান (Pending)',
        };
        $statusClass = $applicationForm->status ?? 'pending';
        $statusIcon = match ($applicationForm->status) {
            'pending' => 'fa-clock',
            'assigned' => 'fa-paper-plane',
            'received' => 'fa-inbox',
            'processing' => 'fa-sync-alt fa-spin',
            'approved' => 'fa-check-circle',
            'rejected' => 'fa-times-circle',
            default => 'fa-clock',
        };
    @endphp

    <section class="content application-view-container">
        <div class="container-fluid">

            @if($applicationForm->revision_note && $applicationForm->final_approved_by == null)
                <div class="alert alert-warning no-print border-0 p-3 mb-3 d-flex align-items-start shadow-sm"
                    style="border-left: 4px solid #d97706 !important; background-color: #fffbeb; border-radius: 6px;">
                    <i class="fa fa-exclamation-triangle mt-1 mr-3 text-warning" style="font-size: 18px;"></i>
                    <div>
                        <h6 class="font-weight-bold text-warning-deep mb-1" style="color: #b45309;"><i class="fa fa-edit"></i>
                            সংশোধন নির্দেশনা (Revision Instruction)</h6>
                        <p class="mb-0 text-dark" style="white-space: pre-line; font-size:13.5px;">
                            {{ $applicationForm->revision_note }}</p>
                    </div>
                </div>
            @endif

            <div class="row">
                <!-- ================= Left Column: The Official Letter Sheet ================= -->
                <div class="col-lg-8 col-md-12 print-document-area">
                    <div class="document-paper">
                        <div class="govt-strip"></div>

                        <!-- Rubber stamp watermark -->
                        <div class="watermark-stamp {{ $statusClass }}">
                            {{ $statusClass }}
                        </div>

                        <!-- Header Area -->
                        <div class="govt-header text-center position-relative">
                            <div class="row align-items-center">
                                <div class="col-3 text-left govt-logo-container">
                                    <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Government Seal"
                                        onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/8/84/Government_Seal_of_Bangladesh.svg'; this.onerror=null;"
                                        style="height: 75px; width: auto; filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.08));">
                                </div>
                                <div class="col-6 text-center">
                                    <h5 class="govt-subtext mb-1">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                                    <h3 class="govt-maintext mb-1">
                                        {{ Auth::user()->institute->union->bn_name ?? 'ইউনিয়ন পরিষদ কার্যালয়' }}
                                    </h3>
                                    <p class="govt-address mb-0">
                                        উপজেলা: {{ Auth::user()->institute->union->thana->bn_name ?? 'সদর' }}, জেলা:
                                        {{ Auth::user()->institute->union->thana->district->bn_name ?? 'ঢাকা' }}, বাংলাদেশ।
                                    </p>
                                </div>
                                <div class="col-3 text-right govt-logo-container">
                                    <img src="{{ asset('images/dhaka.png') }}" alt="Local Logo"
                                        onerror="this.style.display='none';" style="height: 75px; width: auto;">
                                </div>
                            </div>
                            <div class="govt-divider"
                                style="height: 3px; background: linear-gradient(90deg, #006a4e 0%, #006a4e 80%, #f42a41 80%, #f42a41 100%); margin-top: 15px;">
                            </div>
                        </div>

                        <!-- Memorandum and Date Grid -->
                        <div class="row memo-info align-items-center">
                            <div class="col-6">
                                <strong>স্মারক নম্বর:</strong> <span class="mono-num"
                                    style="color: #006a4e; font-size:14.5px;">{{ $applicationForm->application_number ?? '-' }}</span>
                            </div>
                            <div class="col-6 text-right">
                                <strong>তারিখ:</strong> <span
                                    class="mono-num">{{ $applicationForm->date ? date('d/m/Y', strtotime($applicationForm->date)) : '-' }}
                                    খ্রিঃ</span>
                            </div>
                        </div>

                        <!-- Recipient Section -->
                        <div class="letter-salutation">
                            বরাবর,<br>
                            <span
                                class="font-weight-bold text-dark">{{ $applicationForm->recipient ?? 'দায়িত্বপ্রাপ্ত কর্মকর্তা' }}</span>
                        </div>

                        <!-- Subject Section -->
                        <div class="letter-subject">
                            বিষয়: <span style="text-decoration: underline;">{{ $applicationForm->subject ?? '-' }}</span>
                        </div>

                        <!-- Letter Opener -->
                        <div class="letter-salutation">
                            মহোদয়,<br>
                            সবিনয় নিবেদন এই যে, {{ $applicationForm->message ?: '-' }}
                        </div>

                        <!-- Letter Body Message -->
                        <div class="letter-body">
                            <!-- {{ $applicationForm->message ?: '-' }} -->
                        </div>

                        <!-- Applicant Identity & Form Meta Table -->
                        <div class="row mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
                            <div class="col-md-6 mb-4">
                                <h6 style="color:#006a4e; font-weight:700; font-size:14.5px; margin-bottom:12px;"><i
                                        class="fa fa-user-circle"></i> আবেদনকারীর বিবরণ:</h6>
                                <table class="table table-sm table-borderless"
                                    style="font-size: 13.5px; line-height: 1.6; margin-bottom: 0;">
                                    <tr>
                                        <td style="width: 100px; color:#64748b; padding: 2px 0;">প্রেরক (Sender):</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->sender ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#64748b; padding: 2px 0;">মোবাইল নম্বর:</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->mobile ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#64748b; padding: 2px 0;">এনআইডি নম্বর:</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->nid_no ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#64748b; padding: 2px 0;">ঠিকানা:</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0; white-space: pre-line;">
                                            {{ $applicationForm->address ?: '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h6 style="color:#006a4e; font-weight:700; font-size:14.5px; margin-bottom:12px;"><i
                                        class="fa fa-info-circle"></i> আবেদনের দাপ্তরিক বিবরণ:</h6>
                                <table class="table table-sm table-borderless"
                                    style="font-size: 13.5px; line-height: 1.6; margin-bottom: 0;">
                                    <tr>
                                        <td style="width: 120px; color:#64748b; padding: 2px 0;">আবেদনের ধরণ:</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->form_type ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#64748b; padding: 2px 0;">দাখিলকারী (Inward):</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->receiver->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:#64748b; padding: 2px 0;">দাখিলের সময়:</td>
                                        <td style="font-weight:700; color: #1e293b; padding: 2px 0;">
                                            {{ $applicationForm->created_at ? $applicationForm->created_at->format('d M, Y h:i A') : '-' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Attachment Preview -->
                        @if ($applicationForm->attachment)
                            <div class="mt-4 pt-3 no-print" style="border-top: 1px solid #f1f5f9;">
                                <h6 style="color:#006a4e; font-weight:700; font-size:14.5px; margin-bottom:12px;"><i
                                        class="fa fa-paperclip"></i> আবেদনপত্রের সংযুক্তি (Attachment):</h6>
                                <a href="{{ asset($applicationForm->attachment) }}" target="_blank" class="attachment-badge">
                                    <i class="fa fa-file-pdf text-danger" style="font-size: 18px;"></i>
                                    <span>সংযুক্ত ফাইলটি দেখুন (View Attachment)</span>
                                    <i class="fa fa-external-link-alt"
                                        style="font-size:10px; margin-left:5px; opacity:0.6;"></i>
                                </a>
                            </div>
                        @endif

                        <!-- Signatures & Approval Blocks Section -->
                        <div class="row signature-row mt-5">
                            <div class="col-md-6 mb-4">
                                <div class="sig-block">
                                    <span class="sig-stamp-placeholder warn"><i class="fa fa-check-circle"></i> প্রথম
                                        অনুমোদন</span>
                                    <div style="height: 45px; display: flex; align-items: center; justify-content: center;">
                                        @if($applicationForm->initialApprover || $applicationForm->approver)
                                            <div
                                                style="font-family:'Courier Prime', monospace; color: #16a34a; font-weight: 700; font-size:15px; border: 2px solid #16a34a; padding: 2px 8px; border-radius: 4px; transform: rotate(-3deg);">
                                                ✓ INITIAL OK
                                            </div>
                                        @else
                                            <span style="color:#cbd5e1; font-size: 13px; font-style: italic;">অপেক্ষমান
                                                (Pending)</span>
                                        @endif
                                    </div>
                                    <div class="sig-name">
                                        {{ $applicationForm->initialApprover->name ?? ($applicationForm->approver->name ?? '-') }}
                                    </div>
                                    <div class="sig-title">দায়িত্বপ্রাপ্ত কর্মকর্তা (প্রথম অনুমোদনকারী)</div>
                                    <div class="sig-date">
                                        {{ $applicationForm->initial_approved_at ? $applicationForm->initial_approved_at->format('d M, Y h:i A') : ($applicationForm->approved_at ? $applicationForm->approved_at->format('d M, Y h:i A') : '-') }}
                                    </div>
                                    @if($applicationForm->initial_approval_note ?? $applicationForm->approval_note)
                                        <div
                                            style="font-size: 11.5px; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 4px; padding: 6px; margin-top: 8px; text-align: left; color: #b45309; word-break: break-word; line-height: 1.4;">
                                            <strong>নোট:</strong>
                                            {{ $applicationForm->initial_approval_note ?? $applicationForm->approval_note }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="sig-block">
                                    <span class="sig-stamp-placeholder"><i class="fa fa-check-double"></i> চূড়ান্ত
                                        অনুমোদন</span>
                                    <div style="height: 45px; display: flex; align-items: center; justify-content: center;">
                                        @if($applicationForm->finalApprover)
                                            <div
                                                style="font-family:'Courier Prime', monospace; color: #16a34a; font-weight: 700; font-size:15px; border: 2px double #16a34a; padding: 2px 8px; border-radius: 4px; transform: rotate(-3deg);">
                                                ✓ FINAL APPROVED
                                            </div>
                                        @else
                                            <span style="color:#cbd5e1; font-size: 13px; font-style: italic;">অপেক্ষমান
                                                (Pending)</span>
                                        @endif
                                    </div>
                                    <div class="sig-name">{{ $applicationForm->finalApprover->name ?? '-' }}</div>
                                    <div class="sig-title">উর্ধ্বতন কর্তৃপক্ষ (চূড়ান্ত অনুমোদনকারী)</div>
                                    <div class="sig-date">
                                        {{ $applicationForm->final_approved_at ? $applicationForm->final_approved_at->format('d M, Y h:i A') : '-' }}
                                    </div>
                                    @if($applicationForm->final_approval_note)
                                        <div
                                            style="font-size: 11.5px; background: #ecfdf5; border: 1px solid #d1fae5; border-radius: 4px; padding: 6px; margin-top: 8px; text-align: left; color: #065f46; word-break: break-word; line-height: 1.4;">
                                            <strong>নোট:</strong> {{ $applicationForm->final_approval_note }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= Right Column: Control Center & Actions ================= -->
                <div class="col-lg-4 col-md-12 no-print">

                    <!-- Quick Info Panel Card -->
                    <div class="control-card">
                        <div class="control-card-header bg-light">
                            <i class="fa fa-info-circle text-info"></i> আবেদন বিবরণী ও নিয়ণ্ত্রণ (Quick Controls)
                        </div>
                        <div class="control-card-body">
                            <div class="text-center mb-4 pb-3 border-bottom">
                                <span class="capsule-badge {{ $statusClass }} mb-2">
                                    <i class="fa {{ $statusIcon }}"></i> {{ $statusBn }}
                                </span>
                                <h6 class="text-muted font-weight-bold mb-0 mt-1" style="font-size: 13.5px;">আবেদন নং:
                                    #{{ $applicationForm->application_number ?? '-' }}</h6>
                            </div>

                            <div class="meta-item">
                                <div class="meta-label">নথির বর্তমান বিভাগ (Dept)</div>
                                <div class="meta-val">{{ $applicationForm->currentDepartment->name ?? '-' }}</div>
                            </div>

                            <div class="meta-item">
                                <div class="meta-label">নথির বর্তমান শাখা (Section)</div>
                                <div class="meta-val">{{ $applicationForm->currentSection->name ?? '-' }}</div>
                            </div>

                            <div class="meta-item">
                                <div class="meta-label">গৃহীতকারী কর্মকর্তা</div>
                                <div class="meta-val">
                                    {{ $applicationForm->initialApprover->name ?? ($applicationForm->receiver->name ?? '-') }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('application-form.index') }}"
                                    class="btn btn-sm btn-outline-dark w-100 font-weight-bold">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>

                            <button onclick="window.print()" class="btn btn-success w-100 mt-2 btn-sm font-weight-bold">
                                <i class="fa fa-print"></i> আবেদনটি প্রিন্ট করুন (Print Document)
                            </button>
                        </div>
                    </div>

                    <!-- Management Actions Form Card -->
                    @if ($applicationForm->status === 'approved')
                        <!-- Show dedicated card for Approved Status -->
                        <div class="control-card">
                            <div class="control-card-header bg-success text-white"
                                style="background-color: #166534 !important;">
                                <i class="fa fa-stamp"></i> সিদ্ধান্ত ও অনুমোদন প্যানেল
                            </div>
                            <div class="control-card-body">
                                <div class="form-group mb-0">
                                    <label style="font-size:12px; font-weight:600; color:#555;">অনুমোদন নোট (Approval
                                        Note)</label>
                                    <div class="p-3 bg-light border rounded text-dark mb-0"
                                        style="font-size: 13.5px; white-space: pre-wrap; line-height:1.5; border-radius: 6px;">
                                        {{ $applicationForm->approval_note ?: 'কোন মন্তব্য করা হয়নি।' }}
                                    </div>
                                    <small class="text-success d-block mt-3 font-weight-bold" style="font-size: 13px;">
                                        <i class="fa fa-check-double"></i> আবেদনটি চূড়ান্তভাবে অনুমোদিত হয়েছে। (The application
                                        has been approved)
                                    </small>
                                </div>
                            </div>
                        </div>
                    @elseif ($applicationForm->status === 'rejected')
                        <!-- Show dedicated card for Rejected Status -->
                        <div class="control-card">
                            <div class="control-card-header bg-danger text-white" style="background-color: #991b1b !important;">
                                <i class="fa fa-times-circle"></i> সিদ্ধান্ত ও বাতিল প্যানেল
                            </div>
                            <div class="control-card-body">
                                <div class="form-group mb-0">
                                    <label style="font-size:12px; font-weight:600; color:#555;">বাতিল মন্তব্য (Rejection
                                        Note)</label>
                                    <div class="p-3 bg-light border rounded text-dark mb-0"
                                        style="font-size: 13.5px; white-space: pre-wrap; line-height:1.5; border-radius: 6px;">
                                        {{ $applicationForm->approval_note ?: 'কোন মন্তব্য করা হয়নি।' }}
                                    </div>
                                    <small class="text-danger d-block mt-3 font-weight-bold" style="font-size: 13px;">
                                        <i class="fa fa-times-circle"></i> আবেদনটি বাতিল করা হয়েছে। (The application has been
                                        rejected)
                                    </small>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Original Action Panel Card for Active Stages -->
                        @if ($canAssign || $canReceive || ($showApproveForm ?? false))
                            <div class="control-card">
                                <div class="control-card-header bg-success text-white"
                                    style="background-color: #006a4e !important;">
                                    <i class="fa fa-cog"></i> নথি ব্যবস্থাপনা প্যানেল (Action Panel)
                                </div>
                                <div class="control-card-body">

                                    @if ($canReceive)
                                        <form id="receiveForm" method="POST" class="mb-3">
                                            @csrf
                                            <div class="alert alert-info p-2 mb-2" style="font-size:12.5px; border-radius: 4px;">
                                                <i class="fa fa-info-circle"></i> আবেদনটি আপনার দপ্তর বা শাখায় হস্তান্তরের জন্য প্রথমে
                                                <strong>রিসিভ (Receive)</strong> করুন।
                                            </div>
                                            <button type="submit" class="btn btn-success w-100 font-weight-bold" id="receiveBtn">
                                                <i class="fa fa-check"></i> ফাইল গ্রহণ করুন (Receive File)
                                            </button>
                                        </form>
                                    @endif

                                    @if ($canAssign && ($applicationForm->status === 'pending' || $applicationForm->status === 'revision'))
                                        <form id="assignForm" method="POST" class="mb-3 border-top pt-3">
                                            @csrf
                                            <h6 class="font-weight-bold text-dark mb-2" style="font-size:13.5px;"><i
                                                    class="fa fa-share"></i> নথি প্রেরণ / রি-অ্যাসাইন করুন:</h6>

                                            <div class="form-group mb-2">
                                                <label for="department_id" style="font-size:12px; font-weight:600; color:#555;">বিভাগ
                                                    (Department)</label>
                                                <select name="department_id" id="department_id" class="form-control form-control-sm"
                                                    required>
                                                    <option value="">Select Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}" {{ (int) $applicationForm->current_department_id === (int) $department->id ? 'selected' : '' }}>
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger error department_id_error"></small>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="section_id" style="font-size:12px; font-weight:600; color:#555;">শাখা
                                                    (Section)</label>
                                                <select name="section_id" id="section_id" class="form-control form-control-sm" required>
                                                    <option value="">Select Section</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}" {{ (int) $applicationForm->current_section_id === (int) $section->id ? 'selected' : '' }}>
                                                            {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-danger error section_id_error"></small>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="assign_note" style="font-size:12px; font-weight:600; color:#555;">মন্তব্য
                                                    (Assignment Note)</label>
                                                <textarea name="note" id="assign_note" rows="2" class="form-control form-control-sm"
                                                    placeholder="প্রেরণের কারণ বা নির্দেশনা লিখুন (ঐচ্ছিক)"></textarea>
                                                <small class="text-danger error note_error"></small>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-sm w-100 font-weight-bold" id="assignBtn">
                                                <i class="fa fa-paper-plane"></i> প্রেরণ করুন (Save & Assign)
                                            </button>
                                        </form>
                                    @endif

                                    @if ($showApproveForm ?? false)
                                        <form id="approveForm" method="POST" class="border-top pt-3">
                                            @csrf
                                            <input type="hidden" name="status_action" id="status_action" value="approve">
                                            <h6 class="font-weight-bold text-dark mb-2" style="font-size:13.5px;"><i
                                                    class="fa fa-stamp"></i> সিদ্ধান্ত ও অনুমোদন প্যানেল:</h6>

                                            <div class="form-group mb-3">
                                                <label for="approval_note"
                                                    style="font-size:12px; font-weight:600; color:#555;">সিদ্ধান্ত নোট (Note/Remarks)
                                                    <span class="text-danger">*</span></label>
                                                <textarea name="approval_note" id="approval_note" rows="3"
                                                    class="form-control form-control-sm"
                                                    placeholder="মতামত বা সিদ্ধান্ত বিবরণী এখানে লিখুন" {{ $canApprove ? 'required' : 'disabled' }}>{{ $applicationForm->approval_note }}</textarea>
                                                <small class="text-danger error approval_note_error"></small>

                                                @if ($applicationForm->status === 'processing' && !$canApprove)
                                                    <small class="text-warning d-block mt-1"><i class="fa fa-info-circle"></i> আবেদনটি
                                                        বর্তমানে প্রক্রিয়াধীন (Processing) আছে। চূড়ান্ত অনুমোদনের ক্ষমতা আপনার নেই।</small>
                                                @elseif (!$canApprove)
                                                    <small class="text-muted d-block mt-1"><i class="fa fa-exclamation-triangle"></i> ফাইলটি
                                                        রিসিভ করার পর সিদ্ধান্ত প্রদান সচল হবে।</small>
                                                @endif
                                            </div>

                                            @if ($canApprove)
                                                <div class="row g-2">
                                                    @if ($applicationForm->status === 'processing')
                                                        <div class="col-4">
                                                            <button type="button"
                                                                class="btn btn-warning btn-sm text-white w-100 font-weight-bold"
                                                                id="revisionBtn">
                                                                <i class="fa fa-undo"></i> সংশোধন
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="button" class="btn btn-danger btn-sm w-100 font-weight-bold"
                                                                id="rejectBtn">
                                                                <i class="fa fa-times"></i> বাতিল
                                                            </button>
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="submit" class="btn btn-success btn-sm w-100 font-weight-bold"
                                                                id="approveBtn">
                                                                <i class="fa fa-check-double"></i> অনুমোদন
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-success btn-sm w-100 font-weight-bold"
                                                                id="approveBtn">
                                                                <i class="fa fa-check"></i> অনুমোদন দিন (Approve)
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </form>
                                    @endif

                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Routing History Timeline Card -->
                    <div class="control-card">
                        <div class="control-card-header">
                            <i class="fa fa-history text-muted"></i> নথি চলাচল বিবরণী (Routing Timeline)
                        </div>
                        <div class="control-card-body p-3">
                            <div class="timeline-routing">
                                @forelse ($applicationForm->assignments as $key => $assign)
                                    @php
                                        $nodeClass = 'info';
                                        $iconClass = 'fa-paper-plane';
                                        if ($key === 0) {
                                            $nodeClass = match ($applicationForm->status) {
                                                'pending' => 'warning',
                                                'assigned' => 'info',
                                                'received' => 'success',
                                                'processing' => 'warning',
                                                'approved' => 'success',
                                                'rejected' => 'danger',
                                                default => 'info'
                                            };
                                            $iconClass = match ($applicationForm->status) {
                                                'pending' => 'fa-clock',
                                                'assigned' => 'fa-paper-plane',
                                                'received' => 'fa-inbox',
                                                'processing' => 'fa-sync-alt fa-spin',
                                                'approved' => 'fa-check-double',
                                                'rejected' => 'fa-times',
                                                default => 'fa-circle'
                                            };
                                        } else {
                                            if ($assign->is_received) {
                                                $nodeClass = 'success';
                                                $iconClass = 'fa-check';
                                            } else {
                                                $nodeClass = 'info';
                                                $iconClass = 'fa-arrow-right';
                                            }
                                        }
                                    @endphp
                                    <div class="timeline-node {{ $nodeClass }}">
                                        <div class="timeline-icon d-flex align-items-center justify-content-center text-white">
                                            <i class="fa {{ $iconClass }}" style="font-size:7px;"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-time">
                                                <i class="far fa-clock"></i>
                                                {{ $assign->created_at ? $assign->created_at->format('d M, Y h:i A') : '-' }}
                                            </div>
                                            <div class="timeline-title">
                                                @if ($key === 0)
                                                    বর্তমান অবস্থা: {{ ucfirst($applicationForm->status ?? 'pending') }}
                                                @else
                                                    {{ $assign->is_received ? 'ফাইল গৃহীত (Received)' : 'ফাইল স্থানান্তরিত (Assigned)' }}
                                                @endif
                                            </div>
                                            <div class="timeline-desc">
                                                <strong>প্রাপক:</strong> {{ $assign->toDepartment->name ?? '-' }} /
                                                {{ $assign->toSection->name ?? '-' }}<br>
                                                <strong>প্রেরক:</strong> {{ $assign->fromDepartment->name ?? '-' }} /
                                                {{ $assign->fromSection->name ?? '-' }}<br>
                                                <strong>দ্বারা:</strong> {{ $assign->assignedByUser->name ?? '-' }}
                                                @if($assign->receivedByUser)
                                                    <br><strong>গ্রহীতা:</strong> {{ $assign->receivedByUser->name }}
                                                    ({{ $assign->received_at ? $assign->received_at->format('d M, Y h:i A') : '-' }})
                                                @endif
                                            </div>
                                            @if($assign->note)
                                                <div class="timeline-note">
                                                    <strong>নোট:</strong> "{{ $assign->note }}"
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-3" style="font-size:13px;">
                                        <i class="fa fa-info-circle d-block mb-1"></i> কোন চলাচল ইতিহাস পাওয়া যায়নি।
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            const sectionRouteTemplate = @json(route('basic-settings.get-sections-by-department', ['department_id' => '__DEPARTMENT__']));

            function renderSections(departmentId, selectedSectionId = null) {
                const sectionSelect = $('#section_id');
                sectionSelect.html('<option value="">Loading...</option>');

                if (!departmentId) {
                    sectionSelect.html('<option value="">Select Section</option>');
                    return;
                }

                const requestUrl = sectionRouteTemplate.replace('__DEPARTMENT__', departmentId);

                $.get(requestUrl, function (response) {
                    let options = '<option value="">Select Section</option>';
                    $.each(response, function (index, section) {
                        const isSelected = selectedSectionId && parseInt(selectedSectionId, 10) === parseInt(section.id, 10) ? 'selected' : '';
                        options += `<option value="${section.id}" ${isSelected}>${section.name}</option>`;
                    });
                    sectionSelect.html(options);
                }).fail(function () {
                    sectionSelect.html('<option value="">Select Section</option>');
                    toastr.error('Section list load করতে সমস্যা হয়েছে।');
                });
            }

            $('#department_id').on('change', function () {
                renderSections($(this).val());
            });

            $('#assignForm').on('submit', function (e) {
                e.preventDefault();
                const thisForm = $(this);
                const submitBtn = $('#assignBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.assign', $applicationForm->id) }}",
                    data: thisForm.serialize(),
                    beforeSend: function () {
                        submitBtn.prop('disabled', true);
                        thisForm.find('.error').text('');
                    },
                    success: function (response) {
                        submitBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        submitBtn.prop('disabled', false);

                        if (xhr.status === 422) {
                            const response = xhr.responseJSON || {};
                            $.each(response.errors || {}, function (key, val) {
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

            $('#receiveForm').on('submit', function (e) {
                e.preventDefault();
                const submitBtn = $('#receiveBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.receive', $applicationForm->id) }}",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        submitBtn.prop('disabled', true);
                    },
                    success: function (response) {
                        submitBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        submitBtn.prop('disabled', false);
                        const response = xhr.responseJSON || {};
                        toastr.error(response.message || 'Receive failed');
                    }
                });
            });

            $('#approveBtn').on('click', function () {
                $('#status_action').val('approve');
            });

            $('#revisionBtn').on('click', function () {
                $('#status_action').val('revision');
                const approvalNote = $('#approval_note').val().trim();
                if (!approvalNote) {
                    toastr.error('Revision করার জন্য নোট লেখা আবশ্যিক।');
                    $('#approval_note').focus();
                    return;
                }
                $('#approveForm').submit();
            });

            // Prevent default form submission and trigger it safely
            $('#rejectBtn').on('click', function () {
                $('#status_action').val('reject');
                const approvalNote = $('#approval_note').val().trim();
                if (!approvalNote) {
                    toastr.error('প্রত্যাখ্যান (Reject) করার জন্য নোট লেখা আবশ্যিক।');
                    $('#approval_note').focus();
                    return;
                }
                $('#approveForm').submit();
            });

            $('#approveForm').on('submit', function (e) {
                e.preventDefault();
                const thisForm = $(this);
                const submitBtn = $('#approveBtn');
                const rejectBtn = $('#rejectBtn');
                const revisionBtn = $('#revisionBtn');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('application-form.approve', $applicationForm->id) }}",
                    data: thisForm.serialize(),
                    beforeSend: function () {
                        submitBtn.prop('disabled', true);
                        rejectBtn.prop('disabled', true);
                        revisionBtn.prop('disabled', true);
                        thisForm.find('.error').text('');
                    },
                    success: function (response) {
                        submitBtn.prop('disabled', false);
                        rejectBtn.prop('disabled', false);
                        revisionBtn.prop('disabled', false);
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        submitBtn.prop('disabled', false);
                        rejectBtn.prop('disabled', false);
                        revisionBtn.prop('disabled', false);

                        if (xhr.status === 422) {
                            const response = xhr.responseJSON || {};
                            $.each(response.errors || {}, function (key, val) {
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
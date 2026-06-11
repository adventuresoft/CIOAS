@extends('backend.master', ['mainMenu' => 'MisCase', 'subMenu' => 'MisCaseList'])

@push('style')
<style>
    /* ===== Print Pad Styling ===== */
    .print-pad-container {
        background: #ffffff;
        color: #1e293b;
        max-width: 210mm; /* A4 width */
        margin: 20px auto;
        padding: 20mm 15mm;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        position: relative;
        font-family: 'Source Sans Pro', 'Kalpurush', sans-serif;
    }

    .pad-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px double #0f766e;
        padding-bottom: 12px;
        margin-bottom: 24px;
    }

    .pad-header img {
        height: 70px;
        width: 70px;
        object-fit: contain;
    }

    .pad-header-center {
        text-align: center;
        flex-grow: 1;
    }

    .pad-header-center h4 {
        margin: 0;
        font-size: 16px;
        color: #475569;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .pad-header-center h2 {
        margin: 4px 0;
        font-size: 26px;
        color: #0f766e;
        font-weight: 700;
    }

    .pad-header-center h3 {
        margin: 0;
        font-size: 18px;
        color: #1e3a8a;
        font-weight: 600;
    }

    .pad-header-center p {
        margin: 4px 0 0;
        font-size: 13px;
        color: #64748b;
    }

    .report-title-container {
        text-align: center;
        margin-bottom: 24px;
    }

    .report-title {
        display: inline-block;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        border-bottom: 2px solid #1e293b;
        padding-bottom: 4px;
        text-transform: uppercase;
    }

    .info-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 8px 12px;
        border: 1px solid #cbd5e1;
        font-size: 14px;
        vertical-align: top;
    }

    .info-table td.label {
        font-weight: 700;
        background-color: #f8fafc;
        width: 25%;
    }

    .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f766e;
        border-left: 4px solid #0f766e;
        padding-left: 8px;
        margin: 20px 0 10px;
        text-transform: uppercase;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .data-table th {
        background-color: #f1f5f9;
        color: #475569;
        font-weight: 700;
        border: 1px solid #cbd5e1;
        padding: 8px 10px;
        text-align: left;
    }

    .data-table td {
        border: 1px solid #cbd5e1;
        padding: 8px 10px;
        color: #1e293b;
        vertical-align: middle;
    }

    .timeline-table th {
        background-color: #eff6ff;
        color: #1e40af;
    }

    .timeline-table td {
        vertical-align: top;
    }

    .pad-footer {
        margin-top: 40px;
        border-top: 1px solid #e2e8f0;
        padding-top: 12px;
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        color: #64748b;
    }

    /* Print settings */
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background: #ffffff !important;
            margin: 0;
            padding: 0;
        }

        .main-sidebar,
        .main-header,
        .main-footer,
        .content-header,
        #printPageButton,
        #cancelPageButton {
            display: none !important;
        }

        .content-wrapper {
            margin-left: 0 !important;
            padding: 0 !important;
            background: none !important;
        }

        .print-pad-container {
            max-width: 100% !important;
            width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            margin: 0 !important;
            padding: 10mm !important;
        }
    }
</style>
@endpush

@section('title', 'Mis Case History Pad')

@section('content')
<div class="container p-0">
    <div class="print-pad-container">
        
        <!-- Pad Header (Letterhead) -->
        <div class="pad-header">
            <div class="logo-left">
                <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Government Seal">
            </div>
            
            <div class="pad-header-center">
                <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                @php
                    $institute = auth()->user()->institute ?? null;
                    $unionName = $institute->union->name ?? '৩নং শুকতাইল ইউনিয়ন পরিষদ';
                    $unionEnName = $institute->union->en_name ?? 'No. 3 Suktail Union Parishad';
                    $thanaName = $institute->union->thana->name ?? 'গোপালগঞ্জ সদর';
                    $districtName = $institute->union->thana->district->name ?? 'গোপালগঞ্জ';
                @endphp
                <h2>{{ $unionName }} কার্যালয়</h2>
                <h3>Office of the {{ $unionEnName }}</h3>
                <p>উপজেলা: {{ $thanaName }}, জেলা: {{ $districtName }}, বাংলাদেশ।</p>
            </div>

            <div class="logo-right">
                <img src="{{ asset('images/dhaka.png') }}" alt="Union Emblem">
            </div>
        </div>

        <!-- Case History Title -->
        <div class="report-title-container">
            <span class="report-title">মিসকেস শুনানির ইতিহাস ও নথি</span>
        </div>

        <!-- General Info -->
        <table class="info-table">
            <tr>
                <td class="label">কেস নম্বর:</td>
                <td><strong>{{ $miscase->case_no }}</strong></td>
                <td class="label">রুজুর তারিখ:</td>
                <td>{{ optional($miscase->case_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="label">মামলার ধরণ:</td>
                <td>{{ $miscase->case_type_label }}</td>
                <td class="label">ফি/ফি পরিমাণ:</td>
                <td>{{ number_format($miscase->case_fee, 2) }} ৳</td>
            </tr>
            <tr>
                <td class="label">বর্তমান অবস্থা:</td>
                <td colspan="3">
                    <span class="status-badge {{ $miscase->status }}" style="font-weight:700;">
                        {{ ucfirst($miscase->status) }}
                    </span>
                    @if ($miscase->status === 'rejected' && $miscase->rejection_reason)
                        <br><small class="text-danger">কারণ: {{ $miscase->rejection_reason }}</small>
                    @endif
                </td>
            </tr>
        </table>

        <!-- Parties Information -->
        <h4 class="section-title">বাদী ও বিবাদী বিবরণ</h4>
        <table class="info-table">
            <tr>
                <td class="label">বাদী (Plaintiffs):</td>
                <td>
                    @if(!empty($miscase->plaintiffs))
                        @foreach($miscase->plaintiffs as $key => $p)
                            <div class="mb-2">
                                <strong>{{ $key + 1 }}. {{ $p['name'] ?? '—' }}</strong><br>
                                <small class="text-muted">
                                    পিতা: {{ $p['father_name'] ?? '—' }} | মোবাইল: {{ $p['mobile'] ?? '—' }}<br>
                                    ঠিকানা: {{ $p['address'] ?? '—' }}
                                </small>
                            </div>
                        @endforeach
                    @else
                        —
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">বিবাদী (Defendants):</td>
                <td>
                    @if(!empty($miscase->defendants))
                        @foreach($miscase->defendants as $key => $d)
                            <div class="mb-2">
                                <strong>{{ $key + 1 }}. {{ $d['name'] ?? '—' }}</strong><br>
                                <small class="text-muted">
                                    পিতা: {{ $d['father_name'] ?? '—' }} | মোবাইল: {{ $d['mobile'] ?? '—' }}<br>
                                    ঠিকানা: {{ $d['address'] ?? '—' }}
                                </small>
                            </div>
                        @endforeach
                    @else
                        —
                    @endif
                </td>
            </tr>
        </table>

        <!-- Land Records -->
        <h4 class="section-title">জমির তথ্য (Land Records)</h4>
        <table class="data-table">
            <thead>
                <tr>
                    <th>রেকর্ড</th>
                    <th>জেলা</th>
                    <th>উপজেলা</th>
                    <th>মৌজা</th>
                    <th>দাগ নং</th>
                    <th>খতিয়ান</th>
                    <th>রেকর্ড গ্রুপ</th>
                    <th>মোট জমি</th>
                    <th>রেকর্ড মালিক</th>
                </tr>
            </thead>
            <tbody>
                @forelse(is_array($miscase->land_info) ? $miscase->land_info : [] as $row)
                    <tr>
                        <td>{{ $row['record'] ?? '-' }}</td>
                        <td>{{ $locationNames['districts'][$row['district_id'] ?? null] ?? '-' }}</td>
                        <td>{{ $locationNames['thanas'][$row['thana_id'] ?? null] ?? '-' }}</td>
                        <td>{{ $locationNames['mouzas'][$row['mouza_id'] ?? null] ?? '-' }}</td>
                        <td><strong>{{ $row['dag_no'] ?? '-' }}</strong></td>
                        <td>{{ $row['khatian'] ?? '-' }}</td>
                        <td>{{ $row['record_group'] ?? '-' }}</td>
                        <td>{{ $row['total_land'] ?? '-' }}</td>
                        <td>{{ $row['record_owner_name'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="text-align:center;" class="text-muted">No land records linked.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Case History Timeline (Hearing Order History) -->
        <h4 class="section-title">শুনানির ইতিহাস ও আদেশসমূহ</h4>
        <table class="data-table timeline-table">
            <thead>
                <tr>
                    <th style="width: 15%;">শুনানি নং</th>
                    <th style="width: 25%;">শুনানির তারিখ ও সময়</th>
                    <th style="width: 45%;">আদেশ / সিদ্ধান্তের বিবরণ</th>
                    <th style="width: 15%;">পরবর্তী তারিখ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($caseOrders as $order)
                    <tr>
                        <td style="text-align:center;">
                            <span class="badge badge-light border" style="font-weight:700;">
                                {{ sprintf('H%05d', $order->id) }}
                            </span>
                        </td>
                        <td>
                            <strong>{{ optional($order->created_at)->format('d/m/Y') }}</strong>
                            @if ($order->next_hearing_time)
                                <br><small class="text-muted"><i class="far fa-clock"></i> {{ $order->next_hearing_time }}</small>
                            @endif
                        </td>
                        <td>
                            <strong>আদেশের ধরণ:</strong> {{ $order->command_type_label ?: '—' }}<br>
                            @if ($order->command_text)
                                <span class="d-block mt-1"><strong>আদেশ:</strong> {{ $order->command_text }}</span>
                            @endif
                            @if ($order->command_yes_note)
                                <span class="d-block mt-1"><strong>নোট:</strong> {{ $order->command_yes_note }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $order->next_hearing_date ? $order->next_hearing_date->format('d/m/Y') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;" class="text-muted">কোনো শুনানির ইতিহাস পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Notes -->
        @php
            $notesText = is_array($miscase->notes) ? $miscase->notes['notes'] ?? '' : $miscase->notes;
        @endphp
        @if ($notesText)
            <div style="margin-top: 20px;">
                <strong>বিশেষ নোট:</strong>
                <p style="font-size: 13px; background-color: #f8fafc; padding: 10px; border-radius: 6px; border: 1px solid #cbd5e1; margin-top: 4px;">
                    {{ $notesText }}
                </p>
            </div>
        @endif

        <!-- Pad Footer -->
        <div class="pad-footer">
            <span>প্রতিবেদনটি জেনারেট করেছে: UPMS | Powered by Adventure Soft</span>
            <span>তারিখ: {{ date('d/m/Y h:i A') }}</span>
        </div>

    </div>

    <!-- Print Control Buttons -->
    <div class="text-center mt-2 mb-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.close();">
            বন্ধ করুন
        </button>
        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">
            প্রিন্ট করুন
        </button>
    </div>
</div>
@endsection

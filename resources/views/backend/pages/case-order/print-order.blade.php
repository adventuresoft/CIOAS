@extends('backend.master', ['mainMenu' => 'CaseOrder', 'subMenu' => 'CaseOrderList'])

@section('title', 'আদেশপত্র প্রিন্ট — ' . ($misCase->case_no ?? 'N/A'))

@push('style')
    <style>
        /* ===== Print Pad Styling ===== */
        .print-pad-container {
            background: #ffffff;
            color: #1e293b;
            max-width: 210mm;
            /* A4 width */
            margin: 20px auto;
            padding: 10mm 15mm;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            position: relative;
            font-family: 'Source Sans Pro', 'Kalpurush', sans-serif;
        }

        .form-header-left {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .pad-header-center {
            text-align: center;
            margin-bottom: 15px;
        }

        .pad-header-center h3 {
            margin: 0;
            font-size: 20px;
            color: #1e293b;
            font-weight: 700;
        }

        .pad-header-center p {
            margin: 4px 0 0;
            font-size: 15px;
            color: #1e293b;
        }

        .report-title-container {
            text-align: center;
            margin-bottom: 15px;
            font-size: 15px;
            line-height: 1.6;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            color: #1e293b;
            margin-top: 20px;
            border: 1px solid #1e293b;
        }

        .order-table th {
            border: 1px solid #1e293b;
            padding: 8px 10px;
            text-align: center;
            font-weight: 700;
        }

        .order-table td {
            border: 1px solid #1e293b;
            padding: 10px 12px;
            vertical-align: top;
            line-height: 1.5;
        }

        .nested-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .nested-table th,
        .nested-table td {
            border: 1px solid #1e293b;
            padding: 5px 8px;
            text-align: left;
        }

        .signature-block {
            margin-top: 30px;
            float: right;
            text-align: center;
            font-size: 14px;
            line-height: 1.4;
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
                padding: 0 !important;
            }
        }
    </style>
@endpush

@php
    function bnNum($str)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bn = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($eng, $bn, $str);
    }



    $districtName = $misCase->institue->district->name;
    $thanaName = $misCase->institue->thana->name;
    $caseYear = $misCase->case_date ? bnNum($misCase->case_date->format('Y')) : bnNum(date('Y'));

    $startDate = bnDate($caseOrder->command_start_date);
    $endDate = bnDate($caseOrder->command_end_date);
    $tillDate = bnDate($caseOrder->command_till_date);
@endphp

@section('content')
    <div class="container p-0">
        <div class="print-pad-container">

            <div class="form-header-left">
                বাংলাদেশ ফরম নং-২৭০
            </div>

            <div class="pad-header-center">
                <h3>আদেশপত্র</h3>
                <p>({{ $caseOrder->order_law ?? '' }})</p>
            </div>

            <div class="report-title-container">
                আদেশপত্র, তারিখ {{ $startDate }} হইতে {{ $endDate }} পর্যন্ত<br>
                জেলা: {{ $districtName }}, উপজেলা/সার্কেল: {{ $thanaName }}, {{ $caseYear }} খ্রি: সালের
                {{$tillDate}}খ্রি. পর্যন্ত<br>
                মামলার ধরণ: {{ $misCase->case_type_label }}, মামলা নং- {{ bnNum($misCase->case_no) }}
            </div>

            <table class="order-table">
                <thead>
                    <tr>
                        <th style="width: 18%;">আদেশের ক্রমিক নং ও তারিখ</th>
                        <th style="width: 57%;">আদেশ ও অফিসারের স্বাক্ষর</th>
                        <th style="width: 25%;">আদেশের উপর গৃহীত ব্যবস্থা</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allCaseOrders as $index => $order)
                        <tr>
                            <td style="text-align: center;">
                                <span
                                    style="font-size: 15px; font-weight: bold; border-bottom: 1px solid #1e293b; display: inline-block; margin-bottom: 5px;">{{ bnNum(sprintf('%02d', $index + 1)) }}</span><br>
                                {{ $order->created_at ? bnDate($order->created_at) : '—' }}
                            </td>
                            <td>
                                @if($index === 0)
                                    <div style="margin-bottom: 10px;">
                                        <strong style="text-decoration: underline;">বাদী/বাদীগণ:</strong><br>
                                        @if(!empty($misCase->plaintiffs))
                                            @foreach($misCase->plaintiffs as $pIndex => $plaintiff)
                                                @php
                                                    $details = [];
                                                    if (!empty($plaintiff['father_name']))
                                                        $details[] = "পিতা: " . $plaintiff['father_name'];
                                                    if (!empty($plaintiff['address']))
                                                        $details[] = "সাং- " . $plaintiff['address'];
                                                    if (!empty($plaintiff['mobile']))
                                                        $details[] = "মোবাইল নং- " . bnNum($plaintiff['mobile']);
                                                    $detailsStr = !empty($details) ? ", " . implode(", ", $details) : "";
                                                @endphp
                                                {{ bnNum($pIndex + 1) }}. {{ $plaintiff['name'] ?? '—' }}{{ $detailsStr }}<br>
                                            @endforeach
                                        @else
                                            —
                                        @endif
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <strong style="text-decoration: underline;">বিবাদী/বিবাদীগণ:</strong><br>
                                        @if(!empty($misCase->defendants))
                                            @foreach($misCase->defendants as $dIndex => $defendant)
                                                @php
                                                    $details = [];
                                                    if (!empty($defendant['father_name']))
                                                        $details[] = "পিতা: " . $defendant['father_name'];
                                                    if (!empty($defendant['address']))
                                                        $details[] = "সাং- " . $defendant['address'];
                                                    if (!empty($defendant['mobile']))
                                                        $details[] = "মোবাইল নং- " . bnNum($defendant['mobile']);
                                                    $detailsStr = !empty($details) ? ", " . implode(", ", $details) : "";
                                                @endphp
                                                {{ bnNum($dIndex + 1) }}. {{ $defendant['name'] ?? '—' }}{{ $detailsStr }}<br>
                                            @endforeach
                                        @else
                                            —
                                        @endif
                                    </div>

                                    <p style="text-align: justify;">উপরোক্ত আবেদনকারীর নিকট হতে নিম্ন তফসিলভুক্ত জমির জন্য
                                        {{ $misCase->case_type_label }} এর আবেদন পাওয়া গেছে।
                                    </p>

                                    <strong
                                        style="text-decoration: underline; text-align: center; display: block; margin-top: 10px;">জমির
                                        তফসিল</strong>
                                    @if(!empty($misCase->land_info) && is_array($misCase->land_info))
                                        @foreach($misCase->land_info as $land)
                                            @if($land['district_id'])
                                                <div style="text-align: center; font-size: 13px; margin-bottom: 5px;">
                                                    রেকর্ড: {{ $land['record'] ?? '—' }}, জেলা:
                                                    {{ $locationNames['districts'][$land['district_id'] ?? ''] ?? '—' }}, উপজেলা/সার্কেল:
                                                    {{ $locationNames['thanas'][$land['thana_id'] ?? ''] ?? '—' }}, মৌজা:
                                                    {{ $locationNames['mouzas'][$land['mouza_id'] ?? ''] ?? '—' }}
                                                </div>
                                            @endif
                                        @endforeach
                                        <table class="nested-table">
                                            <thead>
                                                <tr>
                                                    <th>দাগ নং</th>
                                                    <th>খতিয়ান নং</th>
                                                    <th>রেকর্ডীয় শ্রেণি</th>
                                                    <th>দাগে মোট জমির পরিমাণ (একর)</th>
                                                    <th>বাদীর দাবীকৃত জমির পরিমাণ (একর)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($misCase->land_info as $land)
                                                    <tr>
                                                        <td>{{ bnNum($land['dag_no'] ?? '—') }}</td>
                                                        <td>{{ bnNum($land['khatian'] ?? '—') }}</td>
                                                        <td>{{ $land['record_group'] ?? '—' }}</td>
                                                        <td>{{ bnNum($land['total_dag_no'] ?? '—') }}</td>
                                                        <td>{{ bnNum($land['total_land'] ?? '—') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    <p style="text-align: justify; margin-top: 15px;">
                                        {{ $order->side_note ?: "" }}<br><br>
                                        দেখলাম। উভয় পক্ষকে শুনানির জন্য নোটিশ জারী করা হোক। শুনানির ধার্য তারিখ
                                        {{ $order->next_hearing_date ? bnDate($order->next_hearing_date) : '—' }}
                                    </p>
                                @else
                                    <p style="text-align: justify;">
                                        {{ $order->command_yes_note ?: $order->side_note }}<br><br>
                                        @if($order->next_hearing_date)
                                            দেখলাম। উভয় পক্ষকে শুনানির জন্য নোটিশ জারী করা হোক। শুনানির ধার্য তারিখ
                                            {{ bnDate($order->next_hearing_date) }}
                                        @endif
                                    </p>
                                @endif

                                <div class="signature-block">
                                    @if($order->creator)
                                        <strong>{{ $order->creator->name }}</strong><br>
                                        {{ $order->creator->section->name ?? '' }}<br>
                                        {{ $misCase->header_one ?? '' }}<br>
                                        {{ $misCase->header_two ?? '' }}
                                    @endif
                                </div>
                                <div style="clear: both;"></div>
                            </td>
                            <td>
                                <p style="text-align: justify;">{{ $order->command_text }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <!-- Print Control Buttons -->
        <div class="text-center mt-3 mb-5">
            <button id="cancelPageButton" class="btn btn-danger btn-sm px-4" onclick="window.close();">
                বন্ধ করুন
            </button>
            <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2" onclick="window.print();">
                প্রিন্ট করুন
            </button>
        </div>
    </div>
@endsection
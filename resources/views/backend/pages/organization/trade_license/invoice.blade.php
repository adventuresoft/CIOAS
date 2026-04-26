@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])

@push('style')
<style>
    @page {
        size: A4 portrait;
        margin: 12mm 8mm;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 13px !important;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        background: #f4f6f9;
    }

    /* Main license container */
    .trade-license-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 4px;
    }

    .trade-license-content {
        padding: 8mm 12mm;
    }

    /* Header Logos and Title - Matching People Certificate */
    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        border-bottom: 2px solid #006600;
        padding-bottom: 10px;
    }

    .header-logos img {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    /* Union header section - centered text */
    .union-header {
        text-align: center;
        flex: 1;
    }

    .union-title-bn {
        font-size: 22px;
        font-weight: bold;
        color: #006600;
        margin: 0;
    }

    .union-title-en {
        font-size: 18px;
        font-weight: bold;
        color: #2e3192;
        margin: 2px 0;
    }

    .union-address {
        font-size: 14px;
        margin: 0;
        color: #333;
    }

    /* License Title */
    .license-title {
        text-align: center;
        margin: 15px 0;
    }

    .license-title h3 {
        background: #28a745;
        color: #fff;
        display: inline-block;
        padding: 8px 30px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 4px;
        margin: 0;
    }

    .tax-year {
        font-size: 14px;
        font-weight: bold;
        color: #006600;
        margin-top: 8px;
    }

    /* Info Tables */
    .info-table {
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
    }

    .info-table td {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        vertical-align: top;
    }

    .info-table td:first-child {
        background: #343a40;
        color: #fff;
        font-weight: bold;
        width: 200px;
    }

    /* Fees Table */
    .fees-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .fees-table th,
    .fees-table td {
        border: 1px solid #dee2e6;
        padding: 8px;
        vertical-align: middle;
    }

    .fees-table th {
        background: #343a40;
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    .fees-table td {
        text-align: right;
    }

    .fees-table td:first-child {
        text-align: center;
        width: 10%;
    }

    .fees-table td:nth-child(2) {
        text-align: left;
        width: 70%;
    }

    .fees-table td:nth-child(3) {
        width: 20%;
    }

    /* Footer totals */
    .total-row {
        background: #e9ecef;
        font-weight: bold;
    }

    /* Signature area */
    .signature-area {
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
        text-align: center;
        border-top: 1px dashed #aaa;
        padding-top: 20px;
    }

    .sig-block {
        width: 30%;
    }

    .sig-line {
        border-top: 1px solid #000;
        margin: 25px 0 5px;
    }

    /* Print styles */
    @media print {
        body {
            margin: 0;
            padding: 0;
            background: white;
        }
        
        .trade-license-page {
            margin: 0;
            padding: 0;
            box-shadow: none;
            border-radius: 0;
            width: 100%;
        }
        
        .trade-license-content {
            padding: 8mm 12mm;
        }
        
        #printPageButton,
        .no-print,
        .card-footer,
        footer,
        .main-footer {
            display: none !important;
        }
        
        .bg-success {
            background: #28a745 !important;
            color: #fff;
        }
        
        .content-wrapper,
        .container,
        .card {
            background: #ffffff;
            padding: 0;
            margin: 0;
        }
        
        @page {
            margin: 12mm 8mm;
        }
        
        /* Force background colors */
        .info-table td:first-child,
        .fees-table th,
        .total-row {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        /* Page break controls */
        .fees-table tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }
        
        .signature-area {
            margin-top: 200px !important;
            page-break-inside: avoid;
            break-inside: avoid;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .info-table td:first-child {
            width: 120px;
        }
        
        .fees-table th,
        .fees-table td {
            font-size: 11px;
            padding: 5px;
        }
    }
</style>
@endpush

@section('title', 'Organization Trade License')

@section('content')
<div class="trade-license-page">
    <div class="trade-license-content">
        
        {{-- Header with Logos - Matching People Certificate exactly --}}
        <div class="header-logos">
            <!-- <img src="{{ isset($license->organization->institute->left_image) ? asset($license->organization->institute->left_image) : asset('images/dhaka.png') }}" alt="City Logo"> -->
            <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $license->organization->institute->union->bn_name ?? 'মোহরাজপুর ইউনিয়ন' }}</div>
                <div class="union-title-en">{{ $license->organization->institute->union->name ?? 'Moharajpur Union' }}</div>
                <p class="union-address">
                    উপজেলা: {{ $license->organization->institute->union->thana->bn_name ?? 'গোপালগঞ্জ সদর' }},
                    জেলা: {{ $license->organization->institute->union->thana->district->bn_name ?? 'গোপালগঞ্জ' }},
                    বাংলাদেশ।
                </p>
            </div>
            <!-- <img src="{{ isset($license->organization->institute->right_image) ? asset($license->organization->institute->right_image) : asset('images/govt-bd-logo.png') }}" alt="Govt Logo"> -->
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>
        
        {{-- License Title --}}
        <div class="license-title">
            <h3>ট্রেড লাইসেন্স রসিদ / TRADE LICENSE INVOICE</h3>
            <div class="tax-year">অর্থ বছর: <strong>{{ $license->taxYear->bn_name ?? 'N/A' }}</strong></div>
        </div>

        {{-- License Metadata --}}
        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
            <div><strong>নম্বর:</strong> {{ bnValue($license->system_id ?? '') }}</div>
            <div><strong>তারিখ:</strong> {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }} খ্রিঃ</div>
        </div>

        {{-- Organization Information --}}
        <table class="info-table">
            <tr>
                <td>প্রতিষ্ঠানের তথ্য:</strong> </td>
                <td>
                    <strong>আইডি নং- {{ bnValue($license->organization->system_id ?? '') }},</strong>
                    <strong>নাম: {{ $license->organization->name ?? 'N/A' }}</strong>
                </strong>
            </strong>
            </tr>
            <tr>
                <td>প্রতিষ্ঠান সংক্রান্ত তথ্য:</strong> </td>
                <td>
                    <strong>
                        বাড়ি নং- {{ $license->organization->house->house_bn ?? 'N/A' }}, 
                        এলাকা: {{ $license->organization->villageArea->bn_name ?? 'N/A' }}, 
                        গ্রাম: {{ $license->organization->village->bn_name ?? 'N/A' }}
                    </strong>
                </strong>
            </strong>
        </table>

        {{-- Fees Table --}}
        <table class="fees-table">
            <thead>
                <tr>
                    <th style="width: 10%">ক্রমিক নং</th>
                    <th style="width: 70%">ফি এর শিরোনাম</th>
                    <th style="width: 20%">ফি এর পরিমাণ</th>
                </tr>
            </thead>
            <tbody id="load-fees">
                @php
                    $total_fee = 0;
                    $index = 0;
                    $fees = json_decode($license->fees, true);
                @endphp
                @if(!empty($fees))
                    @foreach ($fees as $key => $fee)
                        @php
                            $total_fee = $total_fee + $fee;
                        @endphp
                        <tr>
                            <td>{{ ++$index }}</strong>
                            <td class="text-left"><strong>{{ $key }}</strong></td>
                            <td class="text-right"><strong>{{ currencyFormat($fee) }}</strong></td>
                        </tr>
                    @endforeach
                @endif
                <tr class="total-row">
                    <td><strong>মোট:</strong></strong>
                    <td class="text-right" colspan="2"><strong>{{ currencyFormat($total_fee) }}</strong></td>
                </tr>
            </tbody>
        </table>

        {{-- Signature Area --}}
        <div class="signature-area">
            <div class="sig-block">
                <div class="sig-line"></div>
                লাইসেন্স ও বিজ্ঞাপন সুপারভাইজার
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                সীল
            </div>
            <div class="sig-block">
                <div class="sig-line"></div>
                কর্তৃপক্ষ
            </div>
        </div>
        
        {{-- Footer --}}
        <!-- <div class="text-center mt-3 small text-muted">
            <small>ইস্যুর তারিখ: {{ bnValue(date('d/m/Y')) }} খ্রিঃ</small>
        </div>
        <div class="text-center mt-2 small text-muted">
            <small>Developed & Maintained by: <a href="https://www.jatri24.com">Jatri 24 Ltd.</a> & <a href="https://www.adventure-soft.com">Adventure Soft Ltd.</a></small>
        </div> -->
    </div>
</div>

{{-- Print Buttons --}}
<div class="no-print text-center my-4">
    <button class="btn btn-success px-5 py-2" onclick="window.print()">
        <i class="fa fa-print"></i> Print / প্রিন্ট
    </button>
    <a href="{{ route('organizationA.trade-license.index') }}" class="btn btn-secondary px-5 py-2 ms-3">
        <i class="fa fa-arrow-left"></i> Back to List
    </a>
</div>
@endsection

@push('script')
<script>
    window.onbeforeprint = function() {
        // Optional: Any pre-print adjustments
    };
    
    window.onafterprint = function() {
        // Optional: Any post-print cleanup
    };
</script>
@endpush
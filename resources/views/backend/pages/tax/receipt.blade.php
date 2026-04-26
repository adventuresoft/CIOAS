@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' => 'TaxList'])

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

    /* Main invoice container */
    .tax-invoice-page {
        max-width: 1100px;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: visible;
        border-radius: 4px;
    }

    .tax-invoice-content {
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

    /* Invoice Title */
    .invoice-title {
        text-align: center;
        margin: 15px 0;
    }

    .invoice-title h3 {
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

    /* Tax Items Table */
    .tax-table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .tax-table th,
    .tax-table td {
        border: 1px solid #dee2e6;
        padding: 8px;
        vertical-align: middle;
    }

    .tax-table th {
        background: #343a40;
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    .tax-table td {
        text-align: right;
    }

    .tax-table td:first-child {
        text-align: center;
        width: 8%;
    }

    .tax-table td:nth-child(2) {
        text-align: left;
        width: 52%;
    }

    .tax-table td:nth-child(3),
    .tax-table td:nth-child(4) {
        width: 20%;
    }

    /* Footer totals */
    .total-row {
        background: #e9ecef;
        font-weight: bold;
    }

    .grand-total {
        background: #6c757d;
        color: #fff;
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
        
        .tax-invoice-page {
            margin: 0;
            padding: 0;
            box-shadow: none;
            border-radius: 0;
            width: 100%;
        }
        
        .tax-invoice-content {
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
        .tax-table th,
        .grand-total {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        
        /* Page break controls */
        .tax-table tr {
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
        
        .tax-table th,
        .tax-table td {
            font-size: 11px;
            padding: 5px;
        }
    }
</style>
@endpush

@section('title', 'Tax Invoice')

@section('content')
<div class="tax-invoice-page">
    <div class="tax-invoice-content">
        
        {{-- Header with Logos - Matching People Certificate exactly --}}
        <div class="header-logos">
            <!-- <img src="{{ isset($tax->user->institute->left_image) ? asset($tax->user->institute->left_image) : asset('images/dhaka.png') }}" alt="City Logo"> -->
            <img src="{{ asset('images/dhaka.png') }}" alt="City Logo">
            <div class="union-header">
                <h5 class="mb-0">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                <div class="union-title-bn">{{ $tax->user->institute->union->bn_name ?? 'মোহরাজপুর ইউনিয়ন' }}</div>
                <div class="union-title-en">{{ $tax->user->institute->union->name ?? 'Moharajpur Union' }}</div>
                <p class="union-address">
                    উপজেলা: {{ $tax->user->institute->union->thana->bn_name ?? 'গোপালগঞ্জ সদর' }},
                    জেলা: {{ $tax->user->institute->union->thana->district->bn_name ?? 'গোপালগঞ্জ' }},
                    বাংলাদেশ।
                </p>
            </div>
            <!-- <img src="{{ isset($tax->user->institute->right_image) ? asset($tax->user->institute->right_image) : asset('images/govt-bd-logo.png') }}" alt="Govt Logo"> -->
            <img src="{{ asset('images/govt-bd-logo.png') }}" alt="Govt Logo">
        </div>
        
        {{-- Invoice Title --}}
        <div class="invoice-title">
            <h3>কর রসিদ / TAX INVOICE</h3>
            <div class="tax-year">অর্থ বছর: <strong>{{ $tax->taxYear->bn_name ?? 'N/A' }}</strong></div>
        </div>

        {{-- Invoice Metadata --}}
        <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
            <div><strong>নম্বর:</strong> {{ bnValue($tax->system_id ?? '') }}</div>
            <div><strong>তারিখ:</strong> {{ bnValue(date('d/m/Y', strtotime($tax->created_at))) }} খ্রিঃ</div>
        </div>

        {{-- User and Holding Information --}}
        <table class="info-table">
            <tr>
                <td>হোল্ডিং এর মালিকের তথ্য:</strong> </td>
                <td>
                    <strong>আইডি নং- {{ bnValue($tax->user->system_id ?? '') }},</strong>
                    <strong>নাম: {{ $tax->user->people->bn_name ?? $tax->user->name ?? 'N/A' }}</strong>
                </td>
            </tr>
            <tr>
                <td>হোল্ডিং সংক্রান্ত তথ্য:</strong> </td>
                <td>
                    <strong>
                        বাড়ি নং- {{ $tax->house->house_bn ?? 'N/A' }}, 
                        ওয়ার্ড নং- {{ $tax->unionWard->bn_ward_no ?? 'N/A' }}, 
                        এলাকা: {{ $tax->villageArea->bn_name ?? 'N/A' }}, 
                        গ্রাম: {{ $tax->village->bn_name ?? 'N/A' }}
                    </strong>
                </td>
            </tr>
        </table>

        {{-- Tax Items Table --}}
        <table class="tax-table">
            <thead>
                <tr>
                    <th style="width: 10%">ক্রমিক নং</th>
                    <th style="width: 50%">করের বিষয়</th>
                    <th style="width: 20%">বকেয়া কর</th>
                    <th style="width: 20%">কর</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>১</td>
                    <td class="text-left">বসতবাড়ির বাৎসরিক মূল্যের উপর কর</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_residence_tax) }}</td>
                    <td class="text-right">{{ currencyFormat($tax->residence_tax) }}</td>
                </tr>
                <tr>
                    <td>২</td>
                    <td class="text-left">ব্যবসা/পেশা/জীবিকার উপর কর</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_income_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->income_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৩</td>
                    <td class="text-left">সিনেমা/যাত্রা/থিয়েটার বা বিনোদনমূলক অনুষ্ঠানের উপর কর</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_entertainment_institute_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->entertainment_institute_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৪</td>
                    <td class="text-left">লাইসেন্স ও পারমিট ফি</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_license_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->license_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৫</td>
                    <td class="text-left">হাট-বাজার/ফেরিঘাট ও জলমহল ইজারা বাবদ ফি</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_bazar_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->bazar_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৬</td>
                    <td class="text-left">ভূমি/ইমারত ভাড়ার উপর কর</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_land_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->land_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৭</td>
                    <td class="text-left">নিলামে বিক্রয়লব্ধ আয়</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_auction_tax ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->auction_tax ?? '') }}</td>
                </tr>
                <tr>
                    <td>৮</td>
                    <td class="text-left">জরিমানা (যদি থাকে)</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_fine ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->fine ?? '') }}</td>
                </tr>
                <tr>
                    <td>৯</td>
                    <td class="text-left">অন্যান্য দাবি আদায় (যদি থাকে)</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_others ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->others ?? '') }}</td>
                </tr>
                <tr>
                    <td>১০</td>
                    <td class="text-left">বিবিধ</td>
                    <td class="text-right">{{ currencyFormat($tax->previous_extra ?? '') }}</td>
                    <td class="text-right">{{ currencyFormat($tax->extra ?? '') }}</td>
                </tr>
            </tbody>
            <tfoot>
                @php
                    $total_previous = ($tax->previous_extra ?? 0) + ($tax->previous_others ?? 0) + ($tax->previous_fine ?? 0) + 
                                      ($tax->previous_auction_tax ?? 0) + ($tax->previous_land_tax ?? 0) + ($tax->previous_bazar_tax ?? 0) + 
                                      ($tax->previous_license_tax ?? 0) + ($tax->previous_entertainment_institute_tax ?? 0) + 
                                      ($tax->previous_income_tax ?? 0) + ($tax->previous_residence_tax ?? 0);
                    
                    $total_current = ($tax->extra ?? 0) + ($tax->others ?? 0) + ($tax->fine ?? 0) + 
                                    ($tax->auction_tax ?? 0) + ($tax->land_tax ?? 0) + ($tax->bazar_tax ?? 0) + 
                                    ($tax->license_tax ?? 0) + ($tax->entertainment_institute_tax ?? 0) + 
                                    ($tax->income_tax ?? 0) + ($tax->residence_tax ?? 0);
                @endphp
                <tr class="total-row">
                    <td colspan="2" class="text-right"><strong>মোট:</strong></td>
                    <td class="text-right"><strong>{{ currencyFormat($total_previous) }}</strong></td>
                    <td class="text-right"><strong>{{ currencyFormat($total_current) }}</strong></td>
                </tr>
                <tr class="grand-total">
                    <td colspan="3" class="text-right"><strong>সর্বমোট:</strong></td>
                    <td class="text-right"><strong>{{ currencyFormat($total_current + $total_previous) }}</strong></td>
                </tr>
            </tfoot>
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
                কর কর্মকর্তা বা কর্তৃপক্ষ
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
    <a href="{{ route('tax.index') }}" class="btn btn-secondary px-5 py-2 ms-3">
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
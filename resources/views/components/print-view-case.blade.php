@props([
    'title' => '',
    'header_one' => null,
    'header_two' => null,
])

@push('style')
<style>
    /* ===== Print Pad Styling ===== */
    .print-pad-container {
        background: #ffffff;
        color: #1e293b;
        max-width: 210mm; /* A4 width */
        margin: 20px auto;
        padding: 10mm 10mm;
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
        font-size: 17px;
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
        font-size: 16px;
        font-weight: 600;
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
                    $dcName = $header_one ?? 'জেলা প্রশাসকের কার্যালয়, ঢাকা';
                    $districtName = $header_two ?? 'ঢাকা';
                @endphp
                <h2>{{ $dcName }}</h2>
                <p> {{ $districtName }}</p>
            </div>

            <div class="logo-right">
                <img src="{{ asset('images/dhaka.png') }}" alt="Union Emblem">
            </div>
        </div>

        <!-- Case History Title -->
        @if($title)
            <div class="report-title-container">
                <span class="report-title">{{ $title }}</span>
            </div>
        @endif

        <!-- Component Content Slot -->
        {{ $slot }}

        <!-- Pad Footer -->
        <div class="pad-footer">
            <span>প্রতিবেদনটি জেনারেট করেছে: CIOAS | Powered by Adventure Soft</span>
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

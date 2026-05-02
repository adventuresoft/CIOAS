@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' => 'TradeLicense'])

@push('style')
<style>
    @page {
        size: A4 portrait;
        margin: 0;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Nikosh', 'Noto Sans Bengali', Arial, sans-serif;
        font-size: 18px !important;
        line-height: 1.4;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .header-logos {
        margin-top: -18px;
    }

    .certificate-page {
        width: 267mm;
        height: 374mm;
        margin: auto;
        position: relative;
        background: url('{{ asset("images/sucsesion.png") }}') no-repeat center;
        background-size: 267mm 374mm;
        overflow: hidden;
    }

    .certificate-content {
        position: absolute;
        padding: 10mm !important;
        top: 25mm;
        left: 20mm;
        right: 20mm;
        bottom: 20mm;
    }

    .header-logos {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .header-logos img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }

    .union-title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        color: #006600;
    }

    .union-subtitle {
        text-align: center;
        font-size: 15px;
        color: #003366;
    }

    .doc-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 13px;
        margin: 12px 0;
    }

    .doc-title-block {
        flex: 1;
        text-align: center;
    }

    .doc-title {
        background: #006600;
        color: #fff;
        font-size: 22px;
        font-weight: bold;
        padding: 6px 20px;
        border-radius: 4px;
        display: inline-block;
    }

    .validity-info {
        text-align: center;
        font-size: 13px;
        margin-bottom: 10px;
        margin-top: -60px;
    }

    .intro-text {
        font-size: 14px;
        line-height: 1.6;
        text-align: justify;
        margin: 10px 0 15px;
    }

    .section-header {
        background: #006600;
        color: #fff;
        font-weight: bold;
        padding: 6px 10px;
        margin: 12px 0 6px;
        font-size: 14px;
    }

    .info-row {
        display: flex;
        margin-bottom: 4px;
        font-size: 13px;
    }

    .info-label {
        width: 220px;
        font-weight: bold;
    }

    .info-value {
        flex: 1;
    }

    .fee-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .fee-table td {
        padding: 2px 6px;
    }

    .fee-table td:last-child {
        text-align: right;
        font-weight: 600;
    }

    .fee-total {
        background: #f2f2f2;
        font-weight: bold;
    }

    .signature-area {
        margin-top: 200px;
        bottom: 15mm;
        display: flex;
        justify-content: space-between;
        text-align: center;
    }

    .sig-block {
        width: 30%;
    }

    .sig-line {
        border-top: 1px solid #000;
        margin: 30px 0 5px;
    }

    .main-footer {
        display: none;
    }

    .manual-payment-box {
        max-width: 900px;
        margin: 25px auto 0;
        background: #fff;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 6px;
    }

    @media print {
        body {
            margin: 0;
        }

        .no-print {
            display: none !important;
        }
    }
</style>
@endpush

@section('title','Trade License Preview')

@section('content')

@php
    $owner = $license->organization->ownership->firstWhere('is_trade_license')?->user;
    $fees = json_decode($license->fees ?? '{}', true) ?? [];

    $feeList = [
        ['label' => 'নতুন নিবন্ধন ফি', 'key' => 'New Registration Charge'],
        ['label' => 'বার্ষিক ফি', 'key' => 'Yearly Charge'],
        ['label' => 'ট্রেড লাইসেন্স নবায়ন ফি', 'key' => 'Renew Charge'],
        ['label' => 'সাইনবোর্ড ফি', 'key' => 'Signboard Fees'],
        ['label' => 'সারচার্জ', 'key' => 'Surcharge'],
        ['label' => 'অন্যান্য ফি', 'key' => 'Others'],
        ['label' => 'ভ্যাট', 'key' => 'VAT'],
        ['label' => 'আয়কর/উৎসকর', 'key' => 'TAX'],
        ['label' => 'জরিমানা', 'key' => 'Fine'],
    ];

    $total = 0;

    if (!empty($license->taxYear?->name) && str_contains($license->taxYear->name, '-')) {
        [$start, $end] = explode('-', $license->taxYear->name);
    } else {
        $start = '';
        $end = '';
    }

    // IMPORTANT: এখানে তোমার actual approval condition বসাবে
    $isApproved = ($license->status==2 ?? null) == 1;
@endphp

<div class="certificate-page">
    <div class="certificate-content">

        <div class="header-logos">
            <img src="{{ asset('images/dhaka.png') }}">
            <div>
                <h6 class="text-center">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h6>
                <div class="union-title">৩নং শুকতাইল ইউনিয়ন পরিষদ</div>
                <div class="union-subtitle">No. 3 Shukhtail Union Parishad</div>
            </div>
            <img src="{{ asset('images/govt-bd-logo.png') }}">
        </div>

        <div class="doc-header">
            <div>
                নম্বর: <strong>{{ bnValue($license->system_id) }}</strong><br>
                <img src="{{ $license->scan_image ?? asset('images/scanner.png') }}" style="width:80px;height:80px;object-fit:cover;">
            </div>

            <div class="doc-title-block">
                <div class="doc-title">ট্রেড লাইসেন্স</div>
            </div>

            <div style="text-align:right">
                তারিখ: {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }}<br>
                <img src="{{ $owner->people->photo ?? asset('images/photo-placeholder.png') }}" style="width:80px;height:80px;object-fit:cover;">
            </div>
        </div>

        <div class="validity-info">
            নবায়ন/নতুন <br>
            অর্থ বছর: {{ $license->taxYear->name }} <br>
            এই ট্রেড লাইসেন্সের মেয়াদ {{ bnValue(trim($end)) }} সনের ৩০ জুন পর্যন্ত
        </div>

        <p class="intro-text">
            স্থানীয় সরকার (প্রাদেশিক প্রশাসন) আইন, ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ অনুযায়ী সরকার প্রণীত আদেশ ও বিধি অনুযায়ী, ২০১৬ সালের ১০ অনুচ্ছেদ অনুযায়ী অনুরূপ ব্যবসা, প্রতিষ্ঠান, দোকান বা শিল্পপ্রতিষ্ঠানের উপর আদায়কৃত কর এবং অন্যান্য ফি পরিশোধের ভিত্তিতে এই ট্রেড লাইসেন্সটি ইস্যু করা হলো।
        </p>

        @php
        $businessInfo = [
            '১। (ক) প্রতিষ্ঠানের নাম' => $license->organization->name,
            '(খ) প্রতিষ্ঠানের নাম (ইংরেজি)' => $license->organization->en_name ?? $license->organization->name,
            '২। ব্যবসার ধরণ' => $license->organization->subCategory->name,
            '৩। প্রতিষ্ঠানের ধরণ' => count($license->organization->ownership) == 1 ? 'একক প্রতিষ্ঠান' : 'পার্টনারশিপ',
            '৪। প্রতিষ্ঠানের মূলধন' => currencyFormat($license->organization->capital),
            '৬। ব্যবসা প্রতিষ্ঠানের ঠিকানা' => $license->organization->address
        ];
        @endphp

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের তথ্য</div>
        @foreach($businessInfo as $label => $value)
            <div class="info-row">
                <span class="info-label">{{ $label }} :</span>
                <span class="info-value">{{ $value }}</span>
            </div>
        @endforeach

        @php
        $ownerInfo = [
            '১। (ক) মালিকের নাম' => $owner?->people?->bn_name,
            '(খ) মালিকের নাম (ইংরেজি)' => $owner?->people?->name,
            '২। মালিকের আইডি' => bnValue($owner?->id),
            '৩। মালিকের এনআইডি' => bnValue($owner?->people?->nid),
            '৪। মোবাইল নম্বর' => bnValue($owner?->mobile),
            '৫। ই-মেইল' => $owner?->email,
            '৬। মালিকের ঠিকানা' => $owner?->people?->bn_address
        ];
        @endphp

        <div class="section-header">মালিকের তথ্য</div>
        @foreach($ownerInfo as $label => $value)
            <div class="info-row">
                <span class="info-label">{{ $label }} :</span>
                <span class="info-value">{{ $value }}</span>
            </div>
        @endforeach

        <div class="section-header">ব্যবসা প্রতিষ্ঠানের ফিস</div>
        <table class="fee-table">
            @foreach($feeList as $index => $item)
                @php
                    $amount = (float)($fees[$item['key']] ?? 0);
                    $total += $amount;
                @endphp
                <tr>
                    <td>{{ bnValue($index + 1) }}। {{ $item['label'] }} :</td>
                    <td>{{ bnValue(currencyFormat($amount)) }}</td>
                </tr>
            @endforeach

            <tr class="fee-total">
                <td>সর্বমোট =</td>
                <td>{{ bnValue(currencyFormat($total)) }}</td>
            </tr>
        </table>

        <div class="signature-area">
            @foreach(['লাইসেন্স ও বিজ্ঞাপন সুপারভাইজার', 'সীল', 'কর্তৃপক্ষ'] as $sign)
                <div class="sig-block">
                    <div class="sig-line"></div>
                    {{ $sign }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="no-print text-center my-4">
    @if($isApproved)
        <button type="button" class="btn btn-primary px-4 py-2 mr-2" id="showManualPaymentBtn">Manual Payment</button>

        <a href="{{ route('organizationA.trade-license.online-payment', $license->id) }}" class="btn btn-warning px-4 py-2 mr-2">
            Online Payment
        </a>

        <button type="button" class="btn btn-success px-4 py-2 mr-2" onclick="window.print()">Print</button>
    @endif

    <a href="{{ route('organizationA.trade-license.index') }}" class="btn btn-secondary px-4 py-2">Back</a>
</div>

@if($isApproved)
<div class="manual-payment-box no-print" id="manualPaymentBox" style="display:none;">
    <h4 class="mb-3">Manual Payment Information</h4>

    <form action="{{ route('organizationA.trade-license.manual-payment.store', $license->id) }}" method="POST">
        @csrf

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Payment Details <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="payment_details" class="form-control" value="{{ old('payment_details') }}" placeholder="Enter payment details">
                @error('payment_details')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Transaction ID <span class="text-danger">*</span></label>
            <div class="col-md-9">
                <input type="text" name="transaction_id" class="form-control" value="{{ old('transaction_id') }}" placeholder="Enter transaction id">
                @error('transaction_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label">Note</label>
            <div class="col-md-9">
                <textarea name="note" class="form-control" rows="3" placeholder="Enter note">{{ old('note') }}</textarea>
                @error('note')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-info">Save Manual Payment</button>
        </div>
    </form>
</div>
@endif

@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('#showManualPaymentBtn').on('click', function () {
            $('#manualPaymentBox').slideToggle();
        });
    });
</script>
@endpush
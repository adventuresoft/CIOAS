@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'VoterList'])
@push('style')
<style>
    .certificate-card {
        background-image: url('{{ asset('images/bg-images.jpeg') }}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 297mm;
        height: 210mm;
        position: relative;
        overflow: hidden;
    }

    .certificate-body {
        width: 100%;
        height: 100%;
        padding: 15mm;
        box-sizing: border-box;
    }

    .inner-frame{
        border: 1px solid #222;
        height: 100%;
        padding: 15mm;
        position: relative;
    }

    .certificate-footer {
        position: absolute;
        bottom: 8px;
        left: 15mm;
        right: 15mm;
        font-size: 11px;
        text-align: left;
        opacity: 0.9;
    }

    .certificate-signature {
        position: absolute;
        bottom: 14mm;
        left: 15mm;
        right: 15mm;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .certificate-signature .qr-code img{
        height: 100px;
        width: 100px;
    }

    .certificate-signature .chairman {
        text-align: center;
        font-weight: 600;
        margin-right: 10mm;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: A4 landscape;
            margin: 0;
        }

        html, body {
            width: 297mm;
            height: 210mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #fff !important;
        }

        #printPageButton,
        #cancelPageButton{
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Citizen Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body">
            <div class="inner-frame">

                <!-- ================= Header ================= -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Nikosh-bold mb-0" style="font-size:18px;">
                            গণপ্রজাতন্ত্রী বাংলাদেশ সরকার
                        </h2>
                        <h2 class="text-success font-weight-bold mb-0" style="font-size:28px;">
                            {{ $certificate->user->institute->union->bn_name ?? '' }}
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:32px;">
                            {{ $certificate->user->institute->union->name ?? '' }}
                        </h3>
                        <p class="mb-0" style="font-size:15px;">
                            থানাঃ {{ $certificate->user->institute->union->thana->bn_name ?? '' }},
                            জেলাঃ {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }},
                            বাংলাদেশ।
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= -->
                <div class="row mt-3 align-items-center">
                    <div class="col-4 text-left">
                        <strong>নম্বরঃ</strong >  <span style="font-weight:bold;color:blue">      {{ bnValue($certificate->system_id ?? '') }}   </span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge bg-info text-light px-4 py-2"
                              style="font-size:24px; border-radius:28px;">
                            ভোটার তালিকায় নাম না থাকার সনদপত্র
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        <strong>তারিখঃ</strong>
                        {{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }} খ্রিঃ
                    </div>
                </div>

                <!-- ================= Body ================= -->
                <div class="row mt-5">
                    <div class="col-12" style="font-size:18px; line-height:1.9; text-align:justify;">
                        <p>
                            <span style="margin-left:40px;"></span>
                            এই মর্মে প্রত্যয়ন করা যাচ্ছে যে,
                            {{ $certificate->user->people->gender == 1 ? 'জনাব' : 'জনাবা' }}
                            <strong>{{ $certificate->user->people->bn_name ?? '' }}</strong>,
                            আইডি নং <strong>{{ bnValue($certificate->user->people->approved_id ?? '') }}</strong>,
                            পিতাঃ {{ $certificate->user->familyInfo->father_name_bn ?? '' }},
                            মাতাঃ {{ $certificate->user->familyInfo->mother_name_bn ?? '' }},
                            ঠিকানাঃ 
                            গ্রাম: - {{ $certificate->user->addressInfo->permanentVillage->bn_name ?? '' }},
                            ওয়ার্ড:- {{ $certificate->user->addressInfo->permanentWard->bn_ward_no ?? '' }},
                            ডাকঘর: - 
{{ optional($certificate->user->addressInfo->permanentPostOffice)->bn_name ?? '' }} -
@if(optional($certificate->user->addressInfo->permanentPostOffice)->postal_code)
{{ bnValue($certificate->user->addressInfo->permanentPostOffice->postal_code) }},
@endif
                            উপজেলা: - {{ $certificate->user->institute->union->thana->bn_name ?? '' }},
                            জেলা: - {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}।
                            তিনি জন্মসূত্রে একজন বাংলাদেশী নাগরিক এবং অত্র ইউনিয়নের স্থায়ী বাসিন্দা।
                            আমার জানা মতে তিনি আইন-শৃঙ্খলা ও রাষ্ট্রবিরোধী কোন কার্যকলাপের সাথে জড়িত নন।
                        </p>

                        <p style="margin-left:40px;">
                            আমি তার সার্বিক কল্যাণ ও মঙ্গলময় উন্নত জীবন কামনা করি।
                        </p>
                    </div>
                </div>

                <!-- ================= Signature ================= -->
                <div class="certificate-signature">
                    <div class="qr-code"  id="qrcode">
                        <!--<img src="{{ asset('images/scanner.png') }}">-->
                    </div>

                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1">(মোহাম্মাদ রানা)</p>
                        <p class="mb-0">চেয়ারম্যান</p>
                        <p class="mb-0">৩ নং শুকতাইল ইউনিয়ন পরিষদ</p>
                        <p class="mb-0" style="font-size:14px;">
                            {{ $certificate->user->institute->union->thana->bn_name ?? '' }},
                            {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}
                        </p>
                    </div>
                </div>

                <!-- ================= Footer ================= -->
                <div class="certificate-footer">
                    This report generated by UPMS | Powered by <strong>Adventure Soft</strong>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= Buttons ================= -->
    <div class="text-center mt-2 mb-4">
        <button id="cancelPageButton" class="btn btn-danger btn-sm px-4"
                onclick="window.location.href='{{ route('voter-list.index') }}'">
            Cancel
        </button>

        <button id="printPageButton" class="btn btn-success btn-sm px-4 ms-2"
                onclick="window.print();">
            Print
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<script>

    new QRCode(document.getElementById("qrcode"), {
        text: "{{ url('/certificate/verify?system_id=' . $certificate->system_id) }}",
        width: 150,
        height: 150
    });
</script>

@endsection
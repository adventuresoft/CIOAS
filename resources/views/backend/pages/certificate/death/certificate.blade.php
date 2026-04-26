@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Death'])

@push('style')
<style>
    /* ===== Certificate Canvas ===== */
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
        border: 0px solid #0dcaf0;
        height: 100%;
        padding: 15mm;
        position: relative;
    }

    /* Footer */
    .certificate-footer {
        position: absolute;
        bottom: 8px;
        left: 15mm;
        right: 15mm;
        font-size: 11px;
        text-align: left;
        opacity: 0.9;
    }

    /* Signature Area */
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

    /* Print Control */
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

        .container{
            width: 297mm;
            height: 210mm;
            padding: 0;
            margin: 0;
        }

        .main-footer{
            display: none;
        }

        #printPageButton,
        #cancelPageButton{
            display: none !important;
        }
    }
</style>
@endpush

@section('title', 'Death Certificate')

@section('content')
<div class="container p-0">
    <div class="certificate-card">
        <div class="certificate-body border border-dark">
            <div class="inner-frame">

                <!-- ================= Header ================= -->
                <div class="row align-items-center">
                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/dhaka.png') }}">
                    </div>

                    <div class="col-8 text-center">
                        <h2 class="text- font-Tahoma-bold mb-0" style="font-size:16px;">
                          Government of the People's Republic of Bangladesh
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:30px;">
                            {{ $certificate->user->institute->union->name ?? '' }}
                        </h3>
                        <h2 class="text-success font-Nikosh-bold mb-0" style="font-size:28px;">
                            {{ $certificate->user->institute->union->bn_name ?? '' }}
                        </h2>
                        <p class="mb-0" style="font-size:15px;">
                            Thana: {{ $certificate->user->institute->union->thana->name ?? '' }},
                            District: {{ $certificate->user->institute->union->thana->district->name ?? '' }},
                            Bangladesh
                        </p>
                    </div>

                    <div class="col-2 text-center">
                        <img height="90" width="90" src="{{ asset('images/govt-bd-logo.png') }}">
                    </div>
                </div>

                <!-- ================= Title ================= -->
                <div class="row mt-3 align-items-center">
                    <div class="col-4 text-left">
                        <strong>NO:</strong>  <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge bg-danger text-light px-4 py-2" style="font-size:24px; border-radius:28px;">
                           Death Certificate
                        </span>
                    </div>

                    <div class="col-4 text-right">
                       <strong>Date: </strong> {{ date('d/m/Y', strtotime($certificate->created_at)) }} 
                    </div>
                </div>

                <!-- Body -->
                <div class="row mt-5">
                    <div class="col-12" style="font-size:18px; line-height:1.9; text-align:justify;">

                        <span>
                            <span style="margin-left:40px;"></span>
                             This is to certify that ,
                            {{ $certificate->user->people->gender == 1 ? 'Mr.' : 'Mrs.' }}
                            <strong>{{ $certificate->user->people->name ?? '' }}</strong>,
                            ID No.<strong>{{ $certificate->user->people->approved_id ?? '' }}</strong>,
                            Father: <span>{{ $certificate->user->familyInfo->father_name ?? '' }}</span>
                            and Mother: <span>{{ $certificate->user->familyInfo->mother_name ?? '' }}</span>,
                            Address: Village : - <span>{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</span>,
                            Word:- {{ $certificate->user->addressInfo->permanentWard->en_ward_no ?? '' }},
                            Post Office: - 
{{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->name ?? '' }}
@if(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code)
    {{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code }},
@endif
                            Upzila:- <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                            District: - <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>.

                        <span>
                             {{ $certificate->user->people->gender == 1 ? 'He ' : 'She ' }}
                            <strong>
                                {{ $certificate->death_date 
                                    ? \Carbon\Carbon::parse($certificate->death_date)->format('d/m/Y')
                                    : 'Don\'t mention' }}
                            </strong>
                         Died on.
                        </span>

                        <span >
                           Cause of death :
                            <strong>{{ $certificate->cause_of_death ?? 'Don\'t mention' }}</strong>
                        </span>

                        <span>
                            This certificate is issued based on the information recorded by the Union Parishad and is applicable and acceptable for all government and private works.
                        </p>

                        <p style="margin-left:40px;">
                            I pray for the forgiveness of his departed soul.
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
                        <p class="mb-1">(Mohammad Rana)</p>
                        <p class="mb-0">Chairman</p>
                        <p class="mb-0"> {{ $certificate->user->institute->union->name ?? '' }} </p>
                        <p class="mb-0" style="font-size:14px;">
                            {{ $certificate->user->institute->union->thana->name ?? '' }},
                            {{ $certificate->user->institute->union->thana->district->name ?? '' }}
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

    <!-- Action Buttons -->
    <div class="text-center mt-2 mb-4">
        <!-- Cancel Button -->
        <button 
            id="cancelPageButton" 
            class="btn btn-danger btn-sm px-4"
            onclick="goToIndex();">
            Cancel
        </button>

        <!-- Print Button -->
        <button 
            id="printPageButton" 
            class="btn btn-success btn-sm px-4 ms-2"
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

@push('script')
<script>
    function goToIndex(){
        window.location.href = "{{ route('death.index') }}";
    }
</script>
@endpush
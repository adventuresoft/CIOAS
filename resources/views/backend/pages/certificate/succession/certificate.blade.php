@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Succession'])

@push('style')
<style>
/* =========================
   A4 CANVAS
========================= */
.certificate-card {
    background-image: url('{{ asset('images/sucsesion.png') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    width: 267mm;
    height: 374mm;
    position: relative;
    overflow: hidden;
    box-sizing: border-box;
    margin: 0 auto;
}

/* =========================
   BODY WRAPPER
========================= */
.certificate-body {
    width: 100%;
    height: 100%;
    padding: 15mm;
    box-sizing: border-box;
}

.inner-frame{
    height: 100%;
    padding: 15mm;
    position: relative;
    box-sizing: border-box;
}

/* =========================
   FOOTER
========================= */
.certificate-footer {
    position: absolute;
    bottom: 6mm;
    left: 12mm;
    right: 12mm;
    font-size: 10px;
    text-align: center;
    opacity: 0.85;
}

/* =========================
   SIGNATURE
========================= */
.certificate-signature {
    position: absolute;
    bottom: 16mm;
    left: 12mm;
    right: 12mm;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}

.certificate-signature .qr-code img{
    height: 90px;
    width: 90px;
}

.certificate-signature .chairman {
    text-align: center;
    font-weight: 400;
    font-size: 14px;
}

/* =========================
   MEMBER TABLE
========================= */
.member-table{
    width:100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.member-table th,
.member-table td{
    border:1px solid #000;
    padding:6px;
    text-align:center;
}

.member-table th{
    background:#e9f6ff;
    font-weight:600;
}

/* =========================
   PRINT CONFIG
========================= */
@media print {

    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        box-sizing: border-box !important;
    }

    @page {
        size: A4 portrait;
        margin: 0;
    }

    html, body {
        width: 267mm;
        height: 374mm;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important;
        background: #fff !important;
    }

    .container {
        width: 267mm !important;
        height: 374mm !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .certificate-card {
        width: 267mm !important;
        height: 374mm !important;
        margin: 0 !important;
        page-break-inside: avoid !important;
    }

    .main-footer{
        display: none;
    }

    #printPageButton,
    #cancelPageButton {
        display: none !important;
    }
}
</style>
@endpush

@section('title', 'Succession Certificate')

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
                        <h2 class="text- font-Tahoma-bold mb-0" style="font-size:16px;">
                          Government of the People's Republic of Bangladesh
                        </h2>
                        <h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:28px;">
                            {{ $certificate->user->institute->union->name ?? '' }}
                        </h3>
                        <h4 class="text-success font-Nikosh-bold mb-0" style="font-size:24px;">
                            {{ $certificate->user->institute->union->bn_name ?? '' }}
                        </h4>
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
                        <strong> NO: </strong >  <span style="font-weight:bold;color:blue">      {{ $certificate->system_id ?? '' }}   </span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge bg-info text-light px-4 py-2"
                              style="font-size:24px; border-radius:28px;">
                           Citizenship Certificate
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        <strong>Date:</strong>
                        {{ date('d/m/Y', strtotime($certificate->created_at)) }}
                    </div>
                </div>

                <!-- ================= Body ================= -->
                <div class="row mt-2 align-items-center">
                    <div class="col-4 text-left">
                        <strong>No:</strong>  <span style="font-weight:bold;color:blue">{{ $certificate->system_id ?? '' }}</span>
                    </div>

                    <div class="col-4 text-center">
                        <span class="badge bg-info text-light px-4 py-2" style="font-size:22px; border-radius:26px;">
                            Inheritance certificate
                        </span>
                    </div>

                    <div class="col-4 text-right">
                        <strong>Date: </strong> {{ date('d/m/Y', strtotime($certificate->created_at)) }} 
                    </div>
                </div>

                <!-- ===== Body ===== -->
                <div class="row mt-3">
                    <div class="col-12" style="font-size:15px; line-height:1.9; text-align:justify;">

                        <p>
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
{{ optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->bn_name ?? '' }}
@if(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code)
    {{ bnValue(optional(optional(optional($certificate->user)->addressInfo)->permanentPostOffice)->postal_code) }},
@endif
                            Upzila:- <span>{{ $certificate->user->institute->union->thana->name ?? '' }}</span>,
                            District: - <span>{{ $certificate->user->institute->union->thana->district->name ?? '' }}</span>.
                            তিনি অত্র ইউনিয়নের একজন স্থায়ী বাসিন্দা ছিলেন। গত 
                            <strong>
                                {{ $certificate->death_date 
                                    ? date('d/m/Y', strtotime($certificate->death_date))
                                    : '00/00/0000' }}
                            </strong> Date 
                            <strong>
                                {{ $certificate->death_cause??''}}
                            </strong> He died of causes related to his death.
His death registration number is -
                            <strong>{{ $certificate->death_reg_no??"" }}</strong>।
                            To the best of my knowledge, at the time of his death he left behind the heirs/heirs mentioned in the table below.
                        </p>

                        <p class="text-center"><strong>- List of heirs -</strong></p>

                        @php
                            $members = is_null($certificate->members) ? [] : json_decode($certificate->members, true);
                        @endphp

                        <table class="member-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>NID</th>
                                    <th>Relation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member['name'] }}</td>
                                        <td>{{ $member['age'] }}</td>
                                        <td>{{ $member['nid'] }}</td>
                                        <td>{{ $member['relation'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No heir information found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <p style="margin-top:10px;">
                            <span style="margin-left:40px;"></span>
                           I wish him all the best and a prosperous life.
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

    <!-- ===== Buttons ===== -->
    <div class="text-center mt-2 mb-4">
        <button 
            id="cancelPageButton" 
            class="btn btn-danger btn-sm px-4"
            onclick="goToIndex();">
            Cancel
        </button>

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
        window.location.href = "{{ route('succession.index') }}";
    }
</script>
@endpush

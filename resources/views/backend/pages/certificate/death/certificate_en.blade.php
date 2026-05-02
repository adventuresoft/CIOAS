<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Death Certificate</title>

    <style>
        body {
            background-color: #fff !important;
            padding: 0;
            margin: 0;
        }

        .first-border {
            border: 1px solid black;
            padding: 1.25rem;
        }

        .second-border {
            border: 1px solid #17a2b8;
            padding: 1.25rem;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-danger {
            color: #000;
            
        }

        .bg-success {
            background-color: #28a745;
        }

        .text-light {
            color: #fff;
        }

        .wrapper {
            background-color: #ffffff;
        }

        .ml-2 {
            padding-left: 2rem;
        }

        .mr-2 {
            padding-right: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="first-border">
                <div class="second-border">
                    <div class="card">
                        <div class="card-body">
                            <table>
                                <thead>
                                    {{-- <tr>
                                        <td colspan="3" class="text-center">
                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->top_image) }}"
                                                alt="top_image">
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td class="text-right mr-2">

                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->left_image) }}"
                                                alt="left_image">
                                            <h6 class="text-success mt-4">No. : {{ $certificate->system_id ?? '' }}</h6>

                                        </td>
                                        <td class="text-center">
                                            <h2 class="text-danger bold" style="font-size: 18px;">
                                                {{ $certificate->user->institute->union->name ?? '' }} Union
                                                Parishad
                                            </h2>
                                            <p>
                                                PS.:- <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                                                Dist.:- <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                                <strong class="text-danger">Dhaka</strong>, Bangladesh
                                            </p>
                                            <h3 class="text-light bg-success bold" style="font-size: 16px">Certificate of Death</h3>
                                        </td>
                                        <td class="text-left ml-2">
                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->right_image) }}"
                                                alt="right_image">
                                            <h6 class="text-success mt-4">Date :
                                                {{ date('d.m.Y', strtotime($certificate->created_at)) }}
                                            </h6>
                                        </td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <p>This is to certify that <strong
                                                    class="text-danger">{{ $certificate->user->name ?? '' }}</strong>
                                                Id no.: <strong class="text-danger">
                                                    {{ $certificate->user->system_id ?? '' }}</strong>
                                                son of <strong
                                                    class="text-danger">{{ family_live_status($certificate->user->familyInfo->father_live_status ?? 0) }}
                                                    {{ $certificate->user->familyInfo->father_name ?? '' }}</strong> &
                                                <strong
                                                    class="text-danger">{{ family_live_status($certificate->user->familyInfo->mother_live_status ?? 0) }}
                                                    {{ $certificate->user->familyInfo->mother_name ?? '' }}</strong>,
                                                Village: <strong
                                                    class="text-danger">{{ $certificate->user->addressInfo->village ?? '' }}</strong>,
                                                PO.:
                                                <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->name ?? '' }}</strong>,
                                                PS.
                                                : <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                                                Dist.: <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                                is a citizen of Bangladesh by birth, has died on {{ date('d.m.Y', strtotime($certificate->date_of_death)) }}
                                                <br>
                                            </p>
                                            <p>To the best of my knowledge, he was of good moral character and was not involved in any activities against the freedom, peace, and integrity of the country.</p>
                                            <p>I hereby issue this certificate for official record and necessary purposes.</p>


                                        </td>
                                    </tr>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            <p>Chairman/Meyor</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p>NB.: Any Query <a href="https://www.upbd.com"
                                                    target="_blank">www.upbd.com</a></p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <p>This report generated by Jatri 24 Ltd. <a href="https://www.jatri24.com">www.jatri24.com</a></p>
        </footer>
    </div>
</body>

</html>

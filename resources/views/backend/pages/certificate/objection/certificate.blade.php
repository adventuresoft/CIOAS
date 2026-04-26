<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate</title>

    <style>
        body {
            background-color: #00000008 !important;
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
            color: #dc3545;
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
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->top_image) }}"
                                                alt="top_image">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right mr-2">

                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->left_image) }}"
                                                alt="left_image">
                                            <h6 class="text-success mt-4">No. : {{ $certificate->system_id ?? '' }}</h6>

                                        </td>
                                        <td class="text-center">
                                            <h2 class="text-danger bold">
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
                                            <h3 class="text-light bg-success bold">A g e C e r t i f i c a t e</h3>
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
                                                    class="text-danger">{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</strong>,
                                                <strong
                                                    class="text-danger">Road-{{ $certificate->user->addressInfo->permanent_road ?? '' }}</strong>,
                                                <strong class="text-danger">House-03</strong>,
                                                <strong class="text-danger">Ward
                                                    No.-{{ $certificate->user->addressInfo->presentWard->en_ward_no ?? '' }}</strong>,
                                                PO.:
                                                <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->name ?? '' }}</strong>,
                                                PS.
                                                : <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                                                Dist.: <strong
                                                    class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                                is known to me for about long time.
                                                <br>
                                                He is a citizen of Bangladesh by birth.
                                            </p>
                                            <p>To the best of my knowledge, he bears a good moral character and is not
                                                involved is such
                                                activities which are against the country freedom and peace.</p>
                                            <p>I wish all success and prosperity in his life.</p>


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

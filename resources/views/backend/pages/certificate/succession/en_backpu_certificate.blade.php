<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Succession Certificate</title>

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

        .text-dark {
            color: #000;
            font-weight: 400;
            font-size: 14px;
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


       #member-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

       #member-table thead tr {
            background-color: #009879;
            color: #ffffff;
        }

       #member-table th, td {
            padding: 5px 7px;
        }

        .bold{
            font-weight: 500;
        }

        strong {
            font-weight: 500;
        }

        .certificate-title{
            font-size: 16px;
        }

        .union-title{
            font-size: 18px;
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
                                        <td class="text-right mr-2">

                                            <img height="80" width="80" class="mx-auto d-block"
                                                src="{{ asset($certificate->user->institute->left_image) }}"
                                                alt="left_image">
                                            <h6 class="text-success mt-4">No. : {{ $certificate->system_id ?? '' }}</h6>

                                        </td>
                                        <td class="text-center">
                                            <h2 class="text-dark bold union-title">
                                                {{ $certificate->user->institute->union->name ?? '' }} Union
                                                Parishad
                                            </h2>
                                            <p>
                                                PS.:- <strong
                                                    class="text-dark">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                                                Dist.:- <strong
                                                    class="text-dark">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                                <strong class="text-dark">Dhaka</strong>, Bangladesh
                                            </p>
                                            <h3 class="text-light bg-success certificate-title bold">Certificate of Succession</h3>
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
                                                    class="text-dark bold">Late {{ $certificate->deathPerson->user->name ?? '' }}</strong>
                                                Id no.: <strong class="text-dark bold">
                                                    {{ $certificate->deathPerson->user->system_id ?? '' }}</strong>
                                                son of <strong
                                                    class="text-dark bold">{{ $certificate->deathPerson->user->familyInfo->father_name ?? '' }}</strong> &
                                                <strong
                                                    class="text-dark bold">{{ $certificate->deathPerson->user->familyInfo->mother_name ?? '' }}</strong>,
                                                Village: <strong class="text-dark bold">{{ $certificate->deathPerson->user->addressInfo->village ?? '' }}</strong>,
                                                PO.:
                                                <strong
                                                    class="text-dark bold">{{ $certificate->user->institute->union->name ?? '' }}</strong>,
                                                PS.
                                                : <strong
                                                    class="text-dark bold">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                                                Dist.: <strong
                                                    class="text-dark bold">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,

                                                Death Certificate ID.: <strong
                                                    class="text-dark bold">{{ $certificate->deathPerson->system_id ?? '' }}</strong>,
                                                is known to me for about long time.
                                                <br><br>
                                                He was a permanent citizen of Bangladesh by birth. At the time of his death, he left behind the following heirs.
                                            </p>
                                            @php
                                                $members = is_null($certificate->members) ? [] : json_decode($certificate->members, true);
                                            @endphp

                                            <table id="member-table">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>NID</th>
                                                        <th>Relation</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($members))
                                                        @foreach ($members as $key => $member)
                                                            <tr>
                                                                <td style="text-align: center">{{$loop->iteration}}</td>
                                                                <td style="text-align: center">{{$member['name']}}</td>
                                                                <td style="text-align: center">{{$member['age']}}</td>
                                                                <td style="text-align: center">{{$member['nid']}}</td>
                                                                <td style="text-align: center">{{$member['relation']}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>


                                            <p>I pray for the forgiveness of the departed soul and the well-being of the heirs.</p>


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

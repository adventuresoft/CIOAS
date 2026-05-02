@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])
@push('style')
    <style>
        @media print {

            #printPageButton {
                display: none;
            }

            .bg-success {
                background: #28a745 !important;
                color: #fff;
            }


            footer {
                display: none;
            }

            .content-wrapper,
            .container,
            .card,
            .card-footer {
                background: #ffffff
            }

            .border-dark {
                border: 1px solid #343a40 !important;
            }

        }
    </style>
@endpush
@section('title', 'Oranization Trade License')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Oranization Trade License</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('organizationA.trade-license.index')}}">Organization Trade License</a></li>
                        <li class="breadcrumb-item active">License</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                      
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div style="border: 2px solid #6086b6">
                            <div style="border: 5px solid #f9cc9d; padding:5px; margin:5px;">
                                <div style="border: 2px solid #6086b6">
                                    <div class="card-body">

                                   <!-- <div class="row  text-center">
                                        <div class="col-md-12 ">
                                            <img height="70" width="70" class="mx-auto d-block" src="{{ isset($license->organization->institute->top_image) ? asset($license->organization->institute->top_image)  : asset('public/backend/img/certificate/govt-bd-logo.png') }}" alt="govt-bd-logo">
                                        </div>
                                    </div>-->

                                        <div class="row mt-2">
                                            <div class="col-md-2 text-right">
                                                <img height="70" width="70" class="mx-auto d-block" src=" {{ isset($license->organization->institute->left_image) ? asset($license->organization->institute->left_image) : 'https://seeklogo.com/images/M/moharajpur-union-logo-6FAC2CBD46-seeklogo.com.png ' }}" alt="govt-bd-logo">
                                            </div>
                                            <div class="col-md-8 text-center">
                                                <h2 class="text-danger bold">
                                                    {{ $license->organization->institute->union->bn_name ?? '' }}
                                                </h2>
                                                <p>
                                                    ডাকঘরঃ <strong class="text-success">
                                                        {{ $license->organization->institute->union->bn_name ?? '' }}
                                                    </strong>,
                                                    থানাঃ <strong class="text-success">
                                                        {{ $license->organization->institute->union->thana->bn_name ?? '' }}
                                                    </strong>,
                                                    জেলাঃ <strong class="text-success">
                                                        {{ $license->organization->institute->union->thana->district->bn_name ?? '' }}, বাংলাদেশ 
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="col-md-2 text-left">
                                                <img height="70" width="70" class="mx-auto d-block" src="{{ isset($license->organization->institute->right_image) ? asset($license->organization->institute->right_image) : 'https://upload.wikimedia.org/wikipedia/en/thumb/a/ab/Mujib_100_Logo.svg/1200px-Mujib_100_Logo.svg.png' }} "
                                                alt="govt-bd-logo">
                                            </div>
                                        </div>


                                        <div class="row character-tax mt-2">
                                            <div class="col-md-4 text-left">
                                                <h6 class=" mt-2">নম্বর- 
                                                    <strong class="text-success">{{ bnValue($license->system_id ?? '--') }}</strong>
                                                </h6>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <h3 class="text-light bg-success bold p-2">TRADE LICENSE</h3>
                                                <h6 class="bold p-2">অর্থ বছর: 
                                                    <strong>{{$license->taxYear->bn_name}}</strong>
                                                </h6>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <h6 class="mt-2">তারিখঃ
                                                    {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }} খ্রিঃ
                                                </h6>
                                            </div>
                                        </div>


                                        <div>

                                            <table class=" table my-2 user_info_table">
                                                <tr> 
                                                    <td colspan="2">স্থানীয় সরকার (সিটি কর্পোরেশন) আইন ২০০৯ (২০০৯ সনের ৬০ নং আইন) এর ধারা ৮৪ তে প্রদত্ত ক্ষমতা বলে সরকারপ্রণীতআদর্শ কর ডফসিল, ২০১৬ এর ১০ অনুচ্ছেদ অনযায়ী ব্যবসা, বৃত্তি, পেশা বা শিল্প প্রতিষ্ঠানের উপর আরোপিত কর আদায়ের লক্ষ্যে নিম্নে বর্ণিত ব্যক্তি প্রতিষ্ঠানের অনুকুলে অত্র ট্রেড লাইসেন্সটি (বাণিজ্যিক সনদ) ইস্যু করা হলো । </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="text-center bg-success text-light"> প্রতিষ্ঠান সম্পর্কিত তথ্য: </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        ১। (ক) প্রতিষ্ঠানের নামঃ <br>
                                                           (খ) প্রতিষ্ঠানের নাম (ইংরেজী): <br>

                                                        ২। ব্যবসার ধরণঃ <br>
                                                        ৩। প্রতিষ্ঠানের ধরণঃ <br>
                                                        ৪। প্রতিষ্ঠানের মূলধনঃ <br>
                                                        ৫। ব্যবসা পরিচালনার মেয়াদ কালঃ<br>

                                                    </td>
                                                    <td>
                                                        {{$license->organization->bn_name ?? '--'}} <br>
                                                        {{$license->organization->name ?? '--'}} <br>
                                                        {{$license->organization->category->bn_name ?? '--'}} <br>
                                                        {{$license->organization->subcategory->bn_name ?? '--'}} <br>
                                                        {{currencyFormat($license->organization->capital ?? 0)}} <br>
                                                        {{$license->organization->establish_year ? ((date('Y') + 1) - $license->organization->establish_year) : '--'}} বৎসর
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th colspan="2" class="text-center bg-success text-light"> প্রতিষ্ঠানের মালিকানা সম্পর্কিত তথ্য: </th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        ১। (ক) মালিকের নামঃ <br>
                                                        (খ) মালিকের নাম (ইংরেজী): <br>

                                                        ২। মালিকের আইডিঃ <br>
                                                        ৩। মালিকের এনআইডিঃ <br>
                                                        ৪। মোবাইল নম্বরঃ<br>
                                                        ৫। ই-মেইলঃ <br>
                                                    </td>
                                                    <td>

                                                        @php
                                                            $ownerships
                                                        @endphp
                                                        @if(isset($license->organization->ownership))
                                                            @if (count($license->organization->ownership))
                                                                @foreach ($license->organization->ownership as $ownership)
                                                                    @if($ownership->is_trade_license)
                                                                        {{$ownership->user->people->bn_name ?? '--'}} <br>
                                                                        {{$ownership->user->name ?? '--'}} <br>
                                                                        {{$ownership->user->system_id ?? '--'}} <br>
                                                                        {{$ownership->user->nid ?? '--'}} <br>
                                                                        {{$ownership->user->mobile ?? '--'}} <br>
                                                                        {{$ownership->user->email ?? '--'}} <br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endif

                                                        

                                                        
               
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th colspan="2" class="text-center bg-success text-light"> প্রতিষ্ঠানের ফিস সম্পর্কিত তথ্য: </th>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        @php
                                                            $total_fee = 0;
                                                            $index = 0;
                                                            $fees = json_decode($license->fees, true);
                                                        @endphp

                                                        @if (!empty( $fees))
                                                        
                                                            @foreach ($fees as $key => $fee)
                                                                @php
                                                                    $total_fee = $total_fee + $fee;
                                                                @endphp
                                                                {{$key}}:<br>
                                                                Total:
                                                            @endforeach

                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty( $fees))
                                                            @foreach ($fees as $key => $fee)
                                                                {{currencyFormat($fee)}} <br>
                                                            @endforeach
                                                            {{currencyFormat($total_fee)}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>

                                            

                                        
                                        </div>

                                        <div>
                                        <table class="table border table-borderless text-center">
                                            <tr>
                                            <td>
                                                <br><br>
                                                <p>------------------------------</p>
                                                <p>লাইসেন্স ও বিজ্ঞাপন সুপার ভাইজার</p>
                                            </td>
                                            <td>
                                                <br><br>
                                                <p>------------------------------</p>
                                                <p>সীল</p>
                                            </td>
                                            <td>
                                                <br><br>
                                                <p>------------------------------</p>
                                                <p>কর্তৃপক্ষ</p>
                                            </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12 text-right">
                                            <small>Develop & Maintenance by:<a href="https://www.jatri24.com"> Jatri 24 Ltd.</a> & <a href="https://www.adventure-soft.com"> Adventure Soft Ltd.</a></small>
                                        </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="button" id="printPageButton" class="btn btn-secondary text-right"
                                        onClick="window.print();">Print</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('script')
@endpush

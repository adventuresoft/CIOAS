@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' => 'TaxList'])
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
@section('title', 'Tax Show')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tax Generate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tax.index') }}">Tax</a></li>
                        <li class="breadcrumb-item active">Generate</li>
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
                        <div class="card-header">
                            <h3 class="card-title">কর হার</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="tabl-responsive">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>অর্থ বছর</th>
                                            <th>
                                                @if ($tax->year == 1)
                                                    2022-2023
                                                @else
                                                    2021-2022
                                                @endif
                                            </th>
                                            <th>গ্রাম</th>
                                            <th>{{ $tax->village->bn_name ?? '' }}</th>
                                        </tr>
                                        <tr>
                                            <th>ওয়ার্ড নং</th>
                                            <th>{{ $tax->unionWard->bn_ward_no ?? '' }}</th>
                                            <th>এলাকা</th>
                                            <th>{{ $tax->villageArea->bn_name ?? '' }}</th>
                                        </tr>
                                        <tr>
                                            <th>বাড়ি নং</th>
                                            <th>{{ $tax->house->house_bn ?? '' }}</th>
                                            <th>আইডি নং</th>
                                            <th>{{ $tax->user_system_id }} </th>
                                        </tr>
                                    </thead>
                                </table>

                                <table class=" table my-2 user_info_table">
                                    <tr>
                                        <td><img class="user_img" height="60" width="60"
                                                src="{{ asset($tax->user->image ?? 'public/no-image-found.jpeg') }}"></td>
                                        <td> নাম: <strong class="user_name">{{ $tax->user->people->bn_name ?? '' }}</strong>
                                        </td>
                                        <td> পিতার নাম: <strong
                                                class="user_father_name">{{ $tax->user->familyInfo->father_name_bn ?? '' }}</strong>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">ক্রমিক নং</th>
                                            <th>করের বিষয়</th>
                                            <th style="width: 20%">বকেয়া কর</th>
                                            <th style="width: 30%">কর</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>১ ।</td>
                                            <td class="text-left">বসতবাড়ির বাৎসরিক মূল্যের উপর কর</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_residence_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->residence_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>২ ।</td>
                                            <td class="text-left">ব্যবসা/পেশা/জীবিকার উপর কর</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_income_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->income_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৩ ।</td>
                                            <td class="text-left">সিনেমা/যাত্রা/থিয়েটার বা বিনোদেনমূলক অনুষ্ঠানের উপর কর
                                            </td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_entertainment_institute_tax ?? '') }}
                                            </td>
                                            <td class="text-right">{{ currencyFormat($tax->entertainment_institute_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৪ ।</td>
                                            <td class="text-left">লাইসেন্স ও পারমিট ফিস</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_license_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->license_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৫ ।</td>
                                            <td class="text-left">হাট-বাজার/ফেরিঘাট ও জলমহল ইজারা বাবদ ফি</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_bazar_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->bazar_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৬ ।</td>
                                            <td class="text-left">ভূমি/ইমারত ভাড়ার উপর কর</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_land_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->land_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৭ ।</td>
                                            <td class="text-left">নিলামে বিক্রয়লব্ধ আয়</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_auction_tax ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->auction_tax ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৮ ।</td>
                                            <td class="text-left">জরিমানা (যদি থাকে)</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_fine ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->fine ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>৯ ।</td>
                                            <td class="text-left">অন্যান্য দাবি আদায় (যদি থাকে)</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_others ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->others ?? '') }}</td>
                                        </tr>

                                        <tr>
                                            <td>১০ ।</td>
                                            <td class="text-left">বিবিধ</td>
                                            <td class="text-right">{{ currencyFormat($tax->previous_extra ?? '') }}</td>
                                            <td class="text-right">{{ currencyFormat($tax->extra ?? '') }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right"><strong>মোট:</strong></td>
                                            <td class="text-right">
                                                @php
                                                    $total_previous = 0;
                                                    $total_previous = $total_previous + ($tax->previous_extra ? $tax->previous_extra : 0);
                                                    $total_previous = $total_previous + ($tax->previous_others ? $tax->previous_others : 0);
                                                    $total_previous = $total_previous + ($tax->previous_fine ? $tax->previous_fine : 0);
                                                    $total_previous = $total_previous + ($tax->previous_auction_tax ? $tax->previous_auction_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_land_tax ? $tax->previous_land_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_bazar_tax ? $tax->previous_bazar_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_license_tax ? $tax->previous_license_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_entertainment_institute_tax ? $tax->previous_entertainment_institute_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_income_tax ? $tax->previous_income_tax : 0);
                                                    $total_previous = $total_previous + ($tax->previous_residence_tax ? $tax->previous_residence_tax : 0);
                                                @endphp
                                                <strong class="previous_total">{{ currencyFormat($total_previous) }}</strong>
                                            </td>
                                            <td class="text-right">

                                                @php
                                                    $total_current = 0;
                                                    $total_current = $total_current + ($tax->extra ? $tax->extra : 0);
                                                    $total_current = $total_current + ($tax->others ? $tax->others : 0);
                                                    $total_current = $total_current + ($tax->fine ? $tax->fine : 0);
                                                    $total_current = $total_current + ($tax->auction_tax ? $tax->auction_tax : 0);
                                                    $total_current = $total_current + ($tax->land_tax ? $tax->land_tax : 0);
                                                    $total_current = $total_current + ($tax->bazar_tax ? $tax->bazar_tax : 0);
                                                    $total_current = $total_current + ($tax->license_tax ? $tax->license_tax : 0);
                                                    $total_current = $total_current + ($tax->entertainment_institute_tax ? $tax->entertainment_institute_tax : 0);
                                                    $total_current = $total_current + ($tax->income_tax ? $tax->income_tax : 0);
                                                    $total_current = $total_current + ($tax->residence_tax ? $tax->residence_tax : 0);
                                                @endphp

                                                <strong class="current_total">{{ currencyFormat($total_current) }}</strong>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" class="text-right"><strong>সর্বমোট:</strong></td>
                                            <td class="text-right"><strong
                                                    class="sum_of_total">{{ currencyFormat($total_current + $total_previous) }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="form-group row">
                                <a href="{{ route('taxes.tax.received') }}" class="btn btn-default float-right">Cancel</a>
                                <div class="col-sm-9">
                                    <button type="button" id="confirmReceived"
                                    data-id="{{$tax->id}}"
                                        {{ $tax->status ? 'disabled' : '' }} class="btn btn-success text-right"> <i
                                            class="fa fa-dollar-sign"></i> Confirm Payment Received</button>
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
    <script>
        $(document).on('click', '#confirmReceived', function(e) {
            e.preventDefault();
            let _this = $(this);
            let _id = _this.attr('data-id');
           
   
                $("#toast-container").show();
                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to receive the payment?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {


                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('tax.status') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "status": 1,
                                        "id": _id
                                    },
                                    beforeSend: function() {
                                        _this.prop("disabled", true);
                                    },
                                    success: function(response) {
                                        _this.prop("disabled", true);
                                        toastr.success(response.message);
                                        setTimeout(() => {
                                            location.href= "{{route('taxes.receipt', $tax->id )}}";
                                        }, 2000);
                                    },
                                    error: function(xhr, status, error) {
                                        _this.prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr.responseText);
                                        toastr.error(responseText.message);
                                    }
                                });


                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });
        })
    </script>
@endpush

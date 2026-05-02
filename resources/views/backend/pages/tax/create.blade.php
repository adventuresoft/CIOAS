@extends('backend.master', ['mainMenu' => 'Tax', 'subMenu' =>'TaxGenerate'])
@push('style')
@endpush
@section('title', 'Tax Generate')
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
            <li class="breadcrumb-item"><a href="{{route('tax.index')}}">Tax</a></li>
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
                        <form class="form-horizontal" id="taxGenerateForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" id="user_id" >
                            <div class="card-body">
                                <div class="tabl-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>অর্থ বছর</th>
                                                <th>
                                                    <select class="form-control" name="tax_year_id">
                                                        <option value="">Select Tax Year</option>
                                                        @if(count($tax_years))
                                                            @foreach ($tax_years as $year)
                                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </th>
                                                <th>গ্রাম</th>
                                                <th>

                                                    <select class="form-control" id="village_id" name="village_id">
                                                        <option value="">Select Village</option>
                                                        @if (count($villages))

                                                            @foreach ($villages as $village)
                                                                <option value="{{$village->id}}">{{$village->en_name}}</option>
                                                            @endforeach
                                                            
                                                        @endif

                                                    </select>
                                                
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>ওয়ার্ড নং</th>
                                                <th>
                                                    <select class="form-control" name="ward_id">
                                                        <option value="">Select Ward</option>
                                                        @if (count($union_wards))
                                                            @foreach ($union_wards as $union_ward)
                                                                <option value="{{$union_ward->id}}">{{$union_ward->en_ward_no}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </th>
                                                <th>এলাকা</th>
                                                <th>
                                                    <select class="form-control" id="area_id" name="area_id">
                                                        <option value="">Select Area</option>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>বাড়ি নং</th>
                                                <th>
                                                    <select class="form-control" id="house_id" name="house_id">
                                                        <option value="">Select House</option>
                                                    </select>
                                                </th>
                                                <th>আইডি নং</th>
                                                <th>

                                                    <div class="row input-group input-group-sm user_info">
                                                        <input type="text" name="user_system_id" value="" required class="form-control system_id">
                                                        <span class="input-group-append">
                                                          <button type="button" class="btn btn-info btn-flat find_user_info"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <table class=" table my-2 user_info_table d-none">
                                        <tr>
                                            <td><img class="user_img" height="60" width="60" src="{{asset('public/no-image-found.jpeg')}}"></td>
                                            <td> নাম: <strong class="user_name"></strong> </td>
                                            <td> পিতার নাম: <strong class="user_father_name"></strong></td>
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
                                        <tbody >
                                            <tr>
                                                <td>১ ।</td>
                                                <td class="text-left">বসতবাড়ির বাৎসরিক মূল্যের উপর কর</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_residence_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="residence_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>২ ।</td>
                                                <td  class="text-left">ব্যবসা/পেশা/জীবিকার উপর কর</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_income_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="income_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৩ ।</td>
                                                <td  class="text-left">সিনেমা/যাত্রা/থিয়েটার বা বিনোদেনমূলক অনুষ্ঠানের উপর কর</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_entertainment_institute_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="entertainment_institute_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৪ ।</td>
                                                <td  class="text-left">লাইসেন্স ও পারমিট ফিস</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_license_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="license_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৫ ।</td>
                                                <td  class="text-left">হাট-বাজার/ফেরিঘাট ও জলমহল ইজারা বাবদ ফি</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_bazar_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="bazar_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৬ ।</td>
                                                <td  class="text-left">ভূমি/ইমারত ভাড়ার উপর কর</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_land_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="land_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৭ ।</td>
                                                <td  class="text-left">নিলামে বিক্রয়লব্ধ আয়</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_auction_tax"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="auction_tax"></td>
                                            </tr>

                                            <tr>
                                                <td>৮ ।</td>
                                                <td  class="text-left">জরিমানা (যদি থাকে)</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_fine"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="fine"></td>
                                            </tr>

                                            <tr>
                                                <td>৯ ।</td>
                                                <td  class="text-left">অন্যান্য দাবি আদায় (যদি থাকে)</td>
                                                <td><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_others"></td>
                                                <td><input class="form-control curent_tax_variable text-right" min="0" type="number" name="others"></td>
                                            </tr>

                                            <tr>
                                                <td>১০ ।</td>
                                                <td  class="text-left">বিবিধ</td>
                                                <td class="text-right"><input class="form-control previous_tax_variable text-right" min="0" type="number" name="previous_extra"></td>
                                                <td class="text-right"><input class="form-control curent_tax_variable text-right" min="0" type="number" name="extra"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr >
                                                <td colspan="2" class="text-right"><strong>মোট:</strong></td>
                                                <td class="text-right"><strong class="previous_total">0.00</strong></td>
                                                <td class="text-right"><strong class="current_total">0.00</strong></td>
                                            </tr>

                                            <tr >
                                                <td colspan="3" class="text-right"><strong>সর্বমোট:</strong></td>
                                                <td class="text-right"><strong class="sum_of_total">0.00</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="{{route('tax.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <button type="submit" disabled class="btn btn-info tax-generate-submit-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

{{-- {{ route('death.store') }} --}}
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();

            $("#taxGenerateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('tax.store')}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })


            $('.previous_tax_variable').on('change', function(e){
                calculateSum();
            })

            $('.curent_tax_variable').on('change', function(e){
                calculateSum();
            })
        })

        function calculateSum(){
          
            let previous_total = 0;
            $( ".previous_tax_variable" ).each(function() {
                let current_value = parseInt($(this).val());
                if(current_value){
                    previous_total = previous_total + current_value;
                }
            });
            $('.previous_total').html(previous_total);

            let current_total = 0;
            $(".curent_tax_variable").each(function() {
                let current_value = parseInt($(this).val());
                if(current_value){
                    current_total = current_total +  current_value;
                }
            });
            $('.current_total').html(current_total);
            $('.sum_of_total').html(current_total+previous_total)
        }

        $(document).on('change', '#village_id', function(e){
            e.preventDefault();
            let village_area_id = $('#area_id')
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                    beforeSend: function() {
                        village_area_id.prop("disabled", true);
                        console.log("Searcing area");
                    },
                    success: function(response) {
                        village_area_id.html(response)
                        village_area_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        village_area_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                village_area_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#area_id', function(e){
            e.preventDefault();
            let _this_house = $("#house_id");

            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-houses-by-village-area') }}/"+_this_value,
                    beforeSend: function() {
                        _this_house.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        _this_house.html(response)
                        _this_house.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        _this_house.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                _this_house.prop("disabled", true);
            }

        })




        $(document).on('click', '.find_user_info', function(e){
            e.preventDefault();
            let _this = $(this);
            let _this_user_info = _this.closest('.user_info');
            let _this_row = _this.closest('.row');
            let _this_system_id = _this_row.find('.system_id').val();

            if(_this_system_id){

                $.ajax({
                    type: "GET",
                    url: "{{ url('search-user-by-system-id') }}/" + _this_system_id,
                    beforeSend: function() {
                        console.log("Searcing Owner Form");
                        $(".tax-generate-submit-btn").prop("disabled",true);
                    },
                    success: function(response) {
                        $(".tax-generate-submit-btn").prop("disabled",false);


                        $('.user_info_table').removeClass('d-none')
                        $('.user_info_table').find('.user_name').html(response.people.bn_name);
                        $('#user_id').val(response.people.user_id);

                        if(response.people){
                            if(response.people.user){

                                if(response.people.user.family_info){
                                    $(".user_father_name").html(response.people.user.family_info.father_name_bn)
                                }
                                if(response.people.user.image){
                                    $(".user_img").attr('src', response.people.user.image)
                                }

                            }
                        }

                        // _this_user_info.find('.user_img').attr('src', response.people.user.image);;

                    },
                    error: function(xhr, status, error) {
                        $(".tax-generate-submit-btn").prop("disabled",true);
                        _this_row.find('.system_id').val('');
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });



            }else {
                alert("System ID field is required.");
            }

        })
    </script>
@endpush

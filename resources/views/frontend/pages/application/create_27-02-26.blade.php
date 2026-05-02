@extends('frontend.master')
@section('title', 'SUKTAIL UNION PARISHAD - APPLICATION')
@push('style')
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>আবেদন</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Application</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav">
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('application.create') }}"
                                            data-toggle="tab">আবেদন ফরম</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body mb-5">
                                <div class="tab-content">

                                    <div class="active tab-pane" id="application_form">
                                        <form class="form-horizontal" id="applicationForm" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="name">নাম <span class="text-danger" title="Required"
                                                            data-toggle="tooltip">*</span></label>
                                                    <input type="text" required value="" class="form-control"
                                                        name="name" id="name" placeholder="Name English">
                                                    <small class="error name-error text-danger"></small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="bn_name">নাম (বাংলায়) <span class="text-danger"
                                                            title="Required" data-toggle="tooltip">*</span></label>
                                                    <input type="text" required value="" class="form-control"
                                                        name="bn_name" id="bn_name" placeholder="Name In Bangla">
                                                    <small class="error bn_name-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="nid_no">এনআইডি নম্বর</label>
                                                    <input type="text" value="" class="form-control" name="nid"
                                                        id="nid_no" placeholder="NID NO.">
                                                    <small class="error nid_no-error text-danger"></small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="birth_reg">জন্ম নিবন্ধন নম্বর</label>
                                                    <input type="text" value="" class="form-control"
                                                        name="birth_certificate" id="birth_reg" placeholder="Birth Reg.">
                                                    <small class="error birth_reg-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="religion">ধর্ম</label>
                                                    <select name="religion" class="form-control" id="religion">
                                                        <option value="">Select Religion</option>
                                                        <option value="1">Muslim</option>
                                                        <option value="2">Hindu</option>
                                                        <option value="3">Buddhist</option>
                                                        <option value="4">Christian</option>
                                                        <option value="5">Others</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="marital_status"> বৈবাহিক অবস্থা</label>
                                                    <select name="marital_status" class="form-control" id="marital_status">
                                                        <option value="">Select Marital Status</option>
                                                        <option value="1">Single</option>
                                                        <option value="2">Married</option>
                                                        <option value="3">Widowed</option>
                                                        <option value="4">Divorced</option>
                                                        <option value="5">Separated</option>
                                                        <option value="6">Engaged</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="father_name">পিতার নাম ইংরেজিতে</label>
                                                    <input type="text" value="" class="form-control"
                                                        name="father_name" id="father_name" placeholder="Fathers' Name">
                                                    <small class="error father_name-error text-danger"></small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="father_name_bn">পিতার নাম বাংলায়</label>
                                                    <input type="text" value="" class="form-control"
                                                        name="father_name_bn" id="father_name_bn"
                                                        placeholder="Fathers' Name In Bangla">
                                                    <small class="error father_name_bn-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="mother_name">মাতার নাম ইংরেজিতে</label>
                                                    <input type="text" value="" class="form-control"
                                                        name="mother_name" id="mother_name" placeholder="Mothers' Name">
                                                    <small class="error mother_name-error text-danger"></small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="mother_name_bn">মাতার নাম বাংলায়</label>
                                                    <input type="text" value="" class="form-control"
                                                        name="mother_name_bn" id="mother_name_bn"
                                                        placeholder="Mothers' Name In Bangla">
                                                    <small class="error mother_name_bn-error text-danger"></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="email">ই-মেইল</label>
                                                    <input type="email" value="" name="email"
                                                        placeholder="E-mail" class="form-control" id="email">
                                                    <small class="error email-error text-danger"></small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mobile">মোবাইল নম্বর ইংরেজিতে <span class="text-danger"
                                                            title="Required" data-toggle="tooltip">*</span></label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">+88</span>
                                                        </div>
                                                        <input type="tel" pattern="(01){1}[3-9]{1}\d{8}"
                                                            title="Mobile number with 01 and remaing 9 digit with 0-9"
                                                            placeholder="01........." required name="mobile"
                                                            class="form-control" id="mobile">
                                                        <small class="error mobile-error text-danger"></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="date_of_birth">জন্ম তারিখ</label>
                                                    <input type="date" required value="" name="date_of_birth"
                                                        class="form-control" id="date_of_birth">
                                                    <small class="error date_of_birth-error text-danger"></small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="gender">লিঙ্গ</label>
                                                    <select name="gender" class="form-control" id="gender">
                                                        <option value="">Select Gender</option>
                                                        @if (count(people_constant_option('gender')))
                                                            @foreach (people_constant_option('gender') as $key => $item)
                                                                <option value="{{ $key }}">{{ $item }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="error gender-error text-danger"></small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="user-image">আবেদনকারীর ছবি</label>
                                                    <input type="file"  accept="image/*" class="form-control" name="image">
                                                </div>
                                            </div>


                                            <div class="form-gorup row" style="background:azure !important">
                                                <div class="col-md-12">
                                                    <p>স্থায়ী ঠিকানা</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="permanent_division">বিভাগ</label>
                                                    <select readonly name="permanent_division" class="form-control" id="permanent_division">
                                                        <option value="6">Dhaka</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="permanent_district">জেলা</label>
                                                    <select readonly name="permanent_district" class="form-control" id="permanent_district">
                                                        <option value="51">Gopalganj</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="permanent_thana">উপজেলা</label>
                                                    <select name="permanent_thana" readonly class="form-control" id="permanent_thana">
                                                        <option value="385">Gopalganj Sadar</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="permanent_union">ইউনিয়ন পরিষদ</label>
                                                    <select name="permanent_union" class="form-control" id="permanent_union">
                                                        <option value="">Select Union Parishad</option>
                                                        @if (isset($permanent_unions) && count($permanent_unions))
                                                            @foreach ($permanent_unions as $union)
                                                                <option value="{{ $union->id }}">{{ $union->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row"><div class="col-md-6">
                                                    <label for="permanent_post_office_id">ডাকঘর</label>
                                                    <select name="permanent_post_office_id" class="form-control" id="permanent_post_office_id">
                                                        <option value="">Select Post Office</option>
                                                        @foreach ($permanent_post_offices as $post_office)
                                                            <option value="{{$post_office->id}}">{{$post_office->name}} - {{$post_office->postal_code}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="permanent_ward">ওয়ার্ড নম্বর </label>
                                                    <select name="permanent_ward" class="form-control" id="permanent_ward">
                                                        <option value="">Select Permanent Ward</option>
                                                        @if (count($wards))
                                                            @foreach ($wards as $ward)
                                                                <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="permanent_village">গ্রাম</label>
                                                    <select id="permanent_village" class="form-control" name="permanent_village">
                                                        <option value="">Select Village</option>
                                                        @if (isset($permanent_villages) && count($permanent_villages))
                                                            @foreach ($permanent_villages as $village)
                                                                <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="permanent_road">রাস্তা</label>
                                                    <select id="permanent_road" class="form-control" name="permanent_road">
                                                        <option value="">Select Road</option>
                                                        @if (isset($permanent_roads) && count($permanent_roads))
                                                            @foreach ($permanent_roads as $road)
                                                                <option value="{{ $road->id }}">{{ $road->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="permanent_house_no">বাড়ি (বাংলায়)</label>
                                                    <input id="permanent_house_no" class="form-control" type="text" placeholder="House No" name="permanent_house_no">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="permanent_house_no">বাড়ি (ইংরেজীতে)</label>
                                                    <input id="permanent_house_no" class="form-control" type="text" placeholder="House No" name="permanent_house_no">
                                                </div>
                                            </div>



                                            <div class="form-group row " style="background-color:azure !important">
                                                <div class="col-md-6" style="background-color:azure !important">
                                                    <p>বর্তমান ঠিকানা</p>
                                                </div>
                                                <div class="col-md-6" style="background-color:azure !important">
                                                    <label>Same as permanent address? <input type="checkbox"
                                                            name="same_present_addres"
                                                            id="same_as_present_address" /></label>
                                                </div>
                                            </div>

                                            <div id="same-as-permanent-address-section">



                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="present_division">বিভাগ</label>
                                                        <select name="present_division" class="form-control"
                                                            id="present_division">
                                                            <option value="">Select Present Division</option>
                                                            @if (count($divisions))
                                                                @foreach ($divisions as $division)
                                                                    <option value="{{ $division->id }}">
                                                                        {{ $division->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="present_district">জেলা</label>
                                                        <select name="present_district" class="form-control"
                                                            id="present_district">
                                                            <option value="">Select Present District</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="present_thana">উপজেলা</label>
                                                        <select name="present_thana" class="form-control"
                                                            id="present_thana">
                                                            <option value="">Select Present Thana</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="present_union_name">ইউনিয়ন পরিষদ</label>
                                                        <select name="present_union_name" class="form-control"
                                                            id="present_union">
                                                            <option value="">Select Present Union</option>
                                                        </select>
                                                    </div>
                                                <div class="col-md-6">
                                                    <label for="permanent_ward">ওয়ার্ড নম্বর </label>
                                                    <select name="permanent_ward" class="form-control" id="permanent_ward">
                                                        <option value="">Select Permanent Ward</option>
                                                        @if (count($wards))
                                                            @foreach ($wards as $ward)
                                                                <option value="{{ $ward->id }}">{{ $ward->en_ward_no }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                    <div class="col-md-6">
                                                        <label for="present_union">ডাকঘর</label>
                                                        <select name="permanent_post_office_id" class="form-control" id="permanent_post_office_id">
                                                        <option value="">Select Post Office</option>
                                                        @foreach ($permanent_post_offices as $post_office)
                                                            <option value="{{$post_office->id}}">{{$post_office->name}} - {{$post_office->postal_code}}</option>
                                                        @endforeach
                                                        </select>
                                                        <!--<select name="present_union" class="form-control" id="present_union">
                                                            <option value="">Select Post Office</option>
                                                        </select>-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="present_village">গ্রাম</label>
                                                        <select id="present_village" class="form-control" name="present_village">
                                                            <option value="">Select Village</option>
                                                            @if (isset($present_villages) && count($present_villages))
                                                                @foreach ($present_villages as $village)
                                                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="present_road">রাস্তা</label>
                                                        <select id="present_road" class="form-control" name="present_road">
                                                            <option value="">Select Road</option>
                                                            @if (isset($present_roads) && count($present_roads))
                                                                @foreach ($present_roads as $road)
                                                                    <option value="{{ $road->id }}">{{ $road->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="present_house_no">বাড়ি (বাংলায়)</label>
                                                        <input id="present_house_no" class="form-control" type="text" placeholder="House No" name="present_house_no">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="present_house_no">বাড়ি (ইংরেজিতে)</label>
                                                        <input id="present_house_no" class="form-control" type="text" placeholder="House No" name="present_house_no">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>



                                            @if (false)
                                                <div class="form-group row " style="background-color:azure !important">
                                                    <div class="col-md-6" style="background-color:azure !important">
                                                        <p>Present Address: </p>
                                                    </div>
                                                    {{-- <div class="col-md-6" style="background-color:azure !important">
                                                        <label for="same_as_present_address">Same as permanent address? <input type="checkbox" name="same_present_address" id="same_as_present_address" /></label>
                                                    </div> --}}
                                                </div>

                                                <div id="same-as-permanent-address-section">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="present_division">Division</label>
                                                            <select readonly name="present_division" class="form-control" id="present_division">
                                                                <option value="6">Dhaka</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="present_district">District</label>
                                                            <select readonly name="present_district" class="form-control"
                                                                id="present_district">
                                                                <option value="51">Gopalganj</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="present_thana">Police Station</label>
                                                            <select name="present_thana" readonly class="form-control"
                                                                id="present_thana">
                                                                <option value="385">Gopalganj Sadar</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="present_union">Post Office</label>
                                                            <select name="present_union" readonly class="form-control"
                                                                id="present_union">
                                                                <option value="3503">Suktail</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="union_name">UP</label>
                                                            <input id="union_name" class="form-control" readonly value="No.3 Shuktail Union Parishad" type="text" placeholder="UP" name="union_name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="village">Village</label>
                                                            <input id="village" class="form-control" type="text" placeholder="Village" name="village">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="present_ward">Present Ward</label>
                                                            <select name="present_ward" class="form-control" id="present_ward">
                                                                <option value="">Select Present Ward</option>
                                                                @if (count($wards))
                                                                    @foreach ($wards as $ward)
                                                                        <option value="{{ $ward->id }}">
                                                                            {{ $ward->en_ward_no }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif




                                            <div class="text-center">
                                                <input type="hidden" name="union_id" value="3503">
                                                <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(document).on('submit', "#applicationForm", function(e) {
            e.preventDefault();
            let thisForm = $(this);
            let _this_text = thisForm.find('button[type="submit"]').text();
            $.ajax({
                type: "POST",
                url: "{{url('/')}}/api/application-store",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                    thisForm.find('button[type="submit"]').text("Loading...");
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    thisForm.find('button[type="submit"]').text(_this_text);
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.href = response.redirect_url;
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    thisForm.find('button[type="submit"]').text(_this_text);

                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);

                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }

            });
        })

        $(document).on('change', '#same_as_present_address', function(e){
            e.preventDefault();
            if ($(this).is(':checked')) {
                $("#same-as-permanent-address-section").hide();
            } else {
                $("#same-as-permanent-address-section").show();
            }
        })

        $(document).on('change',
            "#permanent_village, #permanent_ward, #permanent_road, #present_division, #present_district, #present_thana, #present_union, #present_village, #present_ward, #present_road",
            function(e) {
                e.preventDefault();
                let _this = $(this);
                let _this_attr = _this.attr('name');
                let _this_prefix = _this_attr.split("_")[0];
                let id = _this_prefix;
                let ward = $("#" + _this_prefix + "_ward").val();
                let village = $("#" + _this_prefix + "_village").val();
                findHouses(village, ward, id);

                if (_this_attr === 'present_division') {
                    findDistrict(_this.val(), id);
                } else if (_this_attr === 'present_district') {
                    findThana(_this.val(), id);
                } else if (_this_attr === 'present_thana') {
                    findUnion(_this.val(), id);
                } else if (_this_attr === 'present_union') {
                    findVillage(_this.val(), id);
                }
            }
        )

        function findHouses(village = 1, ward = 1, id = "permanent") {
            let default_option = "<option value=''>Select House</option>"
            if (village && ward && id) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/house-options') }}/" + ward,
                    data: {
                        'id': id,
                        "village": village
                    },
                    success: function(response) {
                        $('#' + id + "_house").html(response);
                    }
                });
            } else {
                $('#' + id + '_house').html(default_option);
            }
        }

        function findDistrict(division = 0, id = "present") {
            findThana(0, id);
            let default_option = "<option value=''>Select District</option>"
            if (division) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/get-districts-by-division') }}/" + division,
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#' + id + "_district").html(response);
                    }
                });
            } else {
                $('#' + id + '_district').html(default_option);
            }
        }

        function findThana(district = 0, id = "present") {
            findUnion(0, id);

            let default_option = "<option value=''>Select Thana</option>"
            if (district) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/get-thanas-by-district') }}/" + district,
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#' + id + "_thana").html(response);
                    }
                });
            } else {
                $('#' + id + '_thana').html(default_option);
            }
        }

        function findUnion(thana = 0, id = "present") {
            findVillage(0, id);
            let default_option = "<option value=''>Select Union</option>"
            if (thana) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana,
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#' + id + "_union").html(response);
                    }
                });
            } else {
                $('#' + id + '_union').html(default_option);
            }
        }

        function findVillage(union = 0, id = "present") {
            let default_option = "<option value=''>Select Village</option>"
            let default_road_option = "<option value=''>Select " + id.replace(/^./, str => str.toUpperCase()) +
                " Road</option>"

            let _this_village = $('#' + id + "_village");
            let _this_road = $('#' + id + "_road");
            if (union) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/get-villages-by-union') }}/" + union,
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        _this_village.html(response.villageOptions);
                        _this_road.html(response.roadOptions);
                    }
                });
            } else {
                _this_village.html(default_option);
                _this_road.html(default_road_option);
            }
        }
    </script>
@endpush

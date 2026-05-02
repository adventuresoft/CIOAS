@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@push('style')
@endpush
@section('title', 'Chairman Address')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chairman Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('chairman.index') }}">Chairman</a></li>
                        <li class="breadcrumb-item active">Create</li>
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
                            @include('backend.pages.chairman.tabs.tab_header', [
                                'user' => $user,
                                'active_tab' => 'address',
                            ])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peopleAddressForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="card-header">
                                <h6 class="card-title">Permanent Address </h6>
                            </div>

                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="permanent_village_id" class="col-sm-2 col-form-label">Village</label>
                                    <div class="col-sm-10">
                                        <select name="permanent_village_id" class="form-control select2 select2bs4" id="permanent_village_id">
                                            <option value="">Select Village</option>
                                            @if ($villages)
                                                @foreach ($villages as $village)
                                                    <option value="{{$village->id}}" {{$user->addressInfo ? ($user->addressInfo->permanent_village_id == $village->id ? 'selected' : '' ) : ''}}>{{$village->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_village_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_village_area_id" class="col-sm-2 col-form-label">Village Area</label>
                                    <div class="col-sm-10">
                                        <select name="permanent_village_area_id" class="form-control select2 select2bs4" id="permanent_village_area_id">
                                            <option value="">Select Village Area</option>
                                            @if ($permanentVillageAreas)
                                                @foreach ($permanentVillageAreas as $permanentVillageArea)
                                                    <option value="{{$permanentVillageArea->id}}" {{$user->addressInfo ? (($user->addressInfo->permanent_village_area_id == $permanentVillageArea->id) ? 'selected' : '' ) : ''}}>{{$permanentVillageArea->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_ward_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_ward_id" class="col-sm-2 col-form-label">Permanent Ward</label>
                                    <div class="col-sm-10">
                                        <select name="permanent_ward_id" class="form-control select2 select2bs4" id="permanent_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" {{$user->addressInfo ? (($user->addressInfo->permanent_ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_ward_id_error"></small>
                                    </div>
                                </div>
           
                                <div class="form-group row">
                                    <label for="permanent_road" class="col-sm-2 col-form-label">Road</label>
                                    <div class="col-sm-10">
                                            <select class="form-control select2" id="permanent_road" name="permanent_road" >
                                                <option value="">Select Road</option>
                                                @if (count($roads))
                                                    @foreach($roads as $road)
                                                        <option value="{{$road->id}}" {{isset($user->addressInfo->permanentRoad->id) ? (($user->addressInfo->permanentRoad->id == $road->id) ? 'selected' : '' ) : '' }} >{{$road->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="text-danger error permanent_road_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_house" class="col-sm-2 col-form-label">House</label>
                                    <div class="col-sm-10">

                                        <select name="permanent_house" class="form-control select2 select2bs4" id="permanent_house">
                                            @if (count($permanent_houses))
                                                @foreach ($permanent_houses as $house)
                                                    <option value="{{$house->id}}" {{isset($user->addressInfo->permanentHouse->id) ? ($user->addressInfo->permanentHouse->id == $house->id ? 'selected' : '') : ''}} >{{$house->house}}</option>
                                                @endforeach

                                            @else 
                                                <option value="{{$user->addressInfo->permanentHouse->id ?? ''}}">{{$user->addressInfo->permanentHouse->house ?? 'No House Found' }}</option>
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_house_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_flat" class="col-sm-2 col-form-label">Flat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="permanent_flat" class="form-control" id="permanent_flat"
                                            value="{{ $user->addressInfo->permanent_flat ?? '' }}" placeholder="Permanent Flat">

                                            <small class="text-danger error permanent_flat_error"></small>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->


                            <div class="card-header">
                                <h6 class="card-title">Present Address </h6>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="present_division_id" class="col-sm-2 col-form-label">Division</label>
                                    <div class="col-sm-10">
                                        <select name="present_division_id" class="form-control select2 select2bs4"
                                            id="present_division_id">
                                            <option value="">Select Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{$user->addressInfo ? ($user->addressInfo->present_division_id == $division->id ? 'selected' : '') : ''}}>{{ $division->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_division_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_district_id" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <select name="present_district_id" class="form-control select2 select2bs4"
                                            id="present_district_id">
                                            <option value="{{$user->addressInfo->present_district_id ?? ''}}">{{$user->addressInfo->presentDistrict->name ?? 'Select District'}}</option>

                                        </select>

                                        <small class="text-danger error present_district_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_thana_id" class="col-sm-2 col-form-label">Thana</label>
                                    <div class="col-sm-10">
                                        <select name="present_thana_id" class="form-control select2 select2bs4"
                                            id="present_thana_id">
                                            <option value="{{$user->addressInfo->present_thana_id ?? ''}}">{{$user->addressInfo->presentThana->name ?? 'Select Thana'}}</option>
                                        </select>
                                        <small class="text-danger error present_thana_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_union_id" class="col-sm-2 col-form-label">UP</label>
                                    <div class="col-sm-10">
                                        <select name="present_union_id"  class="form-control select2 select2bs4"
                                            id="present_union_id">
                                            <option value="{{$user->addressInfo->present_union_id ?? ''}}"> {{$user->addressInfo->presentUnion->name ?? 'Select Union'}} </option>
                                        </select>
                                        <small class="text-danger error present_union_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_village_id" class="col-sm-2 col-form-label">Village</label>
                                    <div class="col-sm-10">
                                        <select name="present_village_id"  class="form-control select2 select2bs4" id="present_village_id">
                                            <option value="{{$user->addressInfo->present_village_id ?? ''}}">{{$user->addressInfo->presentVillage->en_name ?? 'Select Village'}}</option>
                                        </select>
                                        <small class="text-danger error present_village_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_village_area_id" class="col-sm-2 col-form-label">Village Area</label>
                                    <div class="col-sm-10">
                                        <select name="present_village_area_id" class="form-control select2 select2bs4" id="present_village_area_id">
                                            <option value="">Select Village Area</option>
                                            @if ($presentVillageAreas)
                                                @foreach ($presentVillageAreas as $presentVillageArea)
                                                    <option value="{{$presentVillageArea->id}}" {{$user->addressInfo ? (($user->addressInfo->present_village_area_id == $presentVillageArea->id) ? 'selected' : '' ) : ''}}>{{$presentVillageArea->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error permanent_ward_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_ward_id" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <select name="present_ward_id" class="form-control select2 select2bs4"
                                            id="present_ward_id">
                                            <option value="">Select Ward</option>
                                            @if ($wards)
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->id}}" {{$user->addressInfo ? (($user->addressInfo->present_ward_id == $ward->id) ? 'selected' : '' ) : ''}}>{{$ward->en_ward_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error present_ward_id_error"></small>

                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="present_road" class="col-sm-2 col-form-label">Road</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" id="present_road" name="present_road" >
                                            <option value="{{$user->addressInfo->presentRoad->id ?? ''}}">{{$user->addressInfo->presentRoad->name ?? 'Select Road'}}</option>
                                        </select>
                                        <small class="text-danger error present_road_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_house" class="col-sm-2 col-form-label">House</label>
                                    <div class="col-sm-10">
                                        <select name="present_house" class="form-control select2 select2bs4" id="present_house">
                                            <option value="{{$user->addressInfo->presentHouse->id ?? ''}}">{{$user->addressInfo->presentHouse->house ?? '' }} </option>
                                        </select>
                                        <small class="text-danger error present_house_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_flat" class="col-sm-2 col-form-label">Flat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="present_flat" class="form-control"
                                            value="{{ $user->addressInfo->present_flat ?? '' }}" id="present_flat"
                                            placeholder="Present Flat">
                                            <small class="text-danger error present_flat_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_start_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="present_start_date"
                                            value="{{ $user->addressInfo->present_start_date ?? '' }}" class="form-control"
                                            id="present_start_date">
                                            <small class="text-danger error present_start_date_error"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.family', $user->id) }}" class="btn btn-danger btn-block">Family</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block">Save & Next</button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="{{ route('people.education', $user->id) }}" class="btn btn-primary btn-block ">Education</a>
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#peopleAddressForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('chairman.addressStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })
    </script>

    <script>
        $(document).on('change', '#present_division_id', function(e){
                e.preventDefault();
                let district_id = $('#present_district_id')
                let division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-districts-by-division') }}/"+division_id,
                        beforeSend: function() {
                            district_id.prop("disabled", true);
                            console.log("Searcing Districts");
                        },
                        success: function(response) {
                            district_id.html(response)
                            district_id.prop("disabled", false);
                        },
                        error: function(xhr, status, error) {
                            district_id.prop("disabled", true);
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                        }

                    });
                } else {
                    district_id.prop("disabled", true);
                }
        })

        $(document).on('change', '#present_district_id', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            let present_thana_id = $("#present_thana_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/"+district_id,
                    beforeSend: function() {
                        present_thana_id.prop("disabled", true);
                        console.log("Searcing Thana");
                    },
                    success: function(response) {
                        present_thana_id.html(response)
                        present_thana_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_thana_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                present_thana_id.prop("disabled", true);
            }
            
        })

        $(document).on('change', '#present_thana_id', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            let present_union_id = $('#present_union_id');
            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        present_union_id.prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function(response) {
                        present_union_id.html(response)
                        present_union_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_union_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_union_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#present_union_id', function(e){
            e.preventDefault();
            let present_union_id = $(this).val();
            let present_village_id = $('#present_village_id');
            if (present_union_id) {
                $.ajax({
                    type: "GET",

                    url: "{{ url('/get-villages-by-union') }}/"+present_union_id,
                    beforeSend: function() {
                        present_village_id.prop("disabled", true);
                        console.log("Searcing Villege");
                    },
                    success: function(response) {
                        present_village_id.html(response.villageOptions)
                        present_village_id.prop("disabled", false);
                        $("#present_road").html(response.roadOptions);
                    },
                    error: function(xhr, status, error) {
                        present_village_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_village_id.prop("disabled", true);
            }

        })

       
        $(document).on('change', '#permanent_village_id', function(e){
            e.preventDefault();
            let permanent_village_area = $('#permanent_village_area_id')
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                    beforeSend: function() {
                        permanent_village_area.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        permanent_village_area.html(response)
                        permanent_village_area.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        permanent_village_area.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#present_village_id', function(e){
            e.preventDefault();
            let present_village_area_id = $('#present_village_area_id')
            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-areas-by-village') }}/"+_this_value,
                    beforeSend: function() {
                        present_village_area_id.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        present_village_area_id.html(response)
                        present_village_area_id.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_village_area_id.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district_id.prop("disabled", true);
            }
        })

        $(document).on('change', '#permanent_village_area_id', function(e){
            e.preventDefault();
            let permanent_house = $("#permanent_house");

            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-houses-by-village-area') }}/"+_this_value,
                    beforeSend: function() {
                        permanent_house.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        permanent_house.html(response)
                        permanent_house.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        permanent_house.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                permanent_house.prop("disabled", true);
            }

        })

        $(document).on('change', '#present_village_area_id', function(e){
            e.preventDefault();
            let present_house = $("#present_house");

            let _this_value = $(this).val();
            if (_this_value) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-houses-by-village-area') }}/"+_this_value,
                    beforeSend: function() {
                        present_house.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        present_house.html(response)
                        present_house.prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        present_house.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                present_house.prop("disabled", true);
            }
        })


    </script>
  
@endpush

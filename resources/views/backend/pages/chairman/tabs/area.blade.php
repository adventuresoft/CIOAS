@extends('backend.master', ['mainMenu' => 'chairman', 'subMenu' =>'chairmanCreate'])
@push('style')
@endpush
@section('title', 'Chairman Area')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Chairman Area</h1>
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
                        'active_tab' => 'area',
                        ])
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" id="peopleAddressForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                         <input type="hidden" name="user_id" value="{{$user->id}}">
                         <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Chairman Type</label>
                            <div class="col-sm-9">
                                <select required class="form-control select2" name="chairman_type_id" id="chairman_type_id">
                                    <option value="">Select Chairman Type</option>
                                    <option value="1">Union</option>
                                    <option value="2">City Corporation</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="division_id" class="col-sm-2 col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2" name="division_id" id="division_id">
                                    <option value="">Division</option>
                                    @if ($divisions)
                                    @foreach ($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <small class="text-danger error division_id_error"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district_id" class="col-sm-2 col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2" name="district_id" id="district_id">
                                    <option value="">Select District</option>
                                    <option value="">No District Found</option>
                                </select>
                                <small class="text-danger error district_id_error"></small>

                            </div>
                        </div>

                        <div class="form-group row" id="city_corporation_id_div" style="display:none">
                            <label for="city_corporation_id" class="col-sm-2 col-form-label">City Corporation <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2" name="city_corporation_id" id="city_corporation_id">
                                    <option value="">Select City Corporation</option>
                                    <option value="">No City Corporation Found</option>
                                </select>
                                <small class="text-danger error city_corporation_id_error"></small>

                            </div>
                        </div>
                        <div class="form-group row" id="thana_id_div" style="display: none;">
                            <label for="thana_id" class="col-sm-2 col-form-label">Thana <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select  class="form-control select2" name="thana_id" id="thana_id">
                                    <option value="">Select Thana</option>
                                    <option value="">No Thana Found</option>
                                </select>
                                <small class="text-danger error thana_id_error"></small>

                            </div>
                        </div>


                        <div class="form-group row" id="union_id_div" style="display: none;">
                            <label for="union_id" class="col-sm-2 col-form-label">Union <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select  class="form-control select2"  name="union_id" id="union_id">
                                    <option value="">Select Union</option>
                                    <option value="">No Union Found</option>
                                </select>
                                <small class="text-danger error thana_id_error"></small>

                            </div>
                        </div> 

                        <div class="form-group row" id="word_id_div" style="display: none;">
                            <label for="ward_no" class="col-sm-2 col-form-label">Ward No</label>
                            <div class="col-sm-9">

                                <select  class="form-control select2" multiple  name="ward_no[]" id="ward_no">
                                <option value="">Select Word</option>
                                <option value="">No Word Found</option>
                            </select>
                            <small class="text-danger error thana_id_error"></small>

                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="start_date" placeholder="Start date" class="form-control" id="start_date">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-9">
                            <input type="date" name="end_date" placeholder="End date" class="form-control" id="end_date">
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <a href="{{ route('chairman.freedom', $user->id) }}" class="btn btn-danger btn-block">Fredom Fighter</a>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success btn-block">Save & Next</button>
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
                url: "{{ route('chairman.areaStore') }}",
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

    $(document).on('change', '#chairman_type_id', function(e){
        e.preventDefault();
        let chairman_type = $(this).val();
        if(chairman_type==1){
            $('#thana_id_div').show();
            $('#union_id_div').show();
            $('#word_id_div').show();
            $('#city_corporation_id_div').hide();
        }else{

           $('#thana_id_div').hide();
           $('#union_id_div').hide();
           $('#word_id_div').hide();
           $('#city_corporation_id_div').show();
       }

   });
    $(document).on('change', '#division_id', function(e){
        e.preventDefault();
        let district_id = $('#district_id')
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

    $(document).on('change', '#district_id', function(e){
        e.preventDefault();
        let district_id = $(this).val();
        let present_thana_id = $("#thana_id");
        let present_city_id = $("#city_corporation_id");
        let chairman_type=$("#chairman_type_id").val();
        

        if (district_id && chairman_type==1) {
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
        }  
        else if (district_id && chairman_type==2) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-citi-corporation-by-district') }}/"+district_id,
                beforeSend: function() {
                    present_city_id.prop("disabled", true);
                    console.log("Searcing Thana");
                },
                success: function(response) {
                    present_city_id.html(response)
                    present_city_id.prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    present_city_id.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        } else {
            present_thana_id.prop("disabled", true);
        }
        
    })

    $(document).on('change', '#thana_id', function(e){
        e.preventDefault();
        let thana_id = $(this).val();
        let present_union_id = $('#union_id');
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



    $(document).on('change', '#union_id', function(e){
        e.preventDefault();
        let union_id = $(this).val();
        let ward_no = $('#ward_no');
        if (union_id) {
            $.ajax({
                type: "GET",

                url: "{{ url('/get-word-by-union') }}/"+union_id,
                beforeSend: function() {
                    ward_no.prop("disabled", true);
                    console.log("Searcing ward");
                },
                success: function(response) {
                    console.log(response);
                    ward_no.html(response)
                    ward_no.prop("disabled", false);
                    // $("#ward_no").html(response);
                },
                error: function(xhr, status, error) {
                    ward_no.prop("disabled", true);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        } else {
            ward_no.prop("disabled", true);
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

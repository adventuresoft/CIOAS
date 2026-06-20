@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Village'])
@push('style')
@endpush
@section('title', 'Village')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Village</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.village.index')}}">Village</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Village Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="unionForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="division_id" class="col-sm-2 col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="division_id" id="division_id">
                                            <option value="">Division</option>
                                            @if ($divisions)
                                                @foreach ($divisions as $division)
                                                    <option value="{{$division->id}}" @if ($division->id == $village->division_id) selected @endif >{{$division->name}}</option>
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
                                            <option value="">District</option>
                                            @if ($districts)
                                                @foreach($districts as $district)
                                                    <option value="{{$district->id}}" @if ($district->id == $village->district_id) selected @endif >{{$district->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error district_id_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row location_cat">
                                    <label class="col-sm-2 col-form-label">Location Type </label>
                                    <div class="col-sm-9">
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check mr-4">
                                                <input class="form-check-input location_type" type="radio"
                                                    name="location_type" id="city_corporation" value="city_type" {{ $village->location_type == 'city_type' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="city_corporation">City
                                                    Corporation</label>
                                            </div>
                                            <div class="form-check mr-4">
                                                <input class="form-check-input location_type" type="radio"
                                                    name="location_type" id="pourashava" value="pos_type" {{ $village->location_type == 'pos_type' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pourashava">Pourashava</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input location_type" type="radio"
                                                    name="location_type" id="union" value="union_type" {{ $village->location_type == 'union_type' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="union">Union</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row city_type {{ $village->location_type == 'city_type' ? '' : 'd-none' }}">
                                    <label for="city_corporation_id" class="col-sm-2 col-form-label">City Corporation<span
                                            class="text-danger" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="city_corporation_id"
                                            id="city_corporation_id">
                                            <option value="">City Corporation</option>
                                            @if ($cityCorporations)
                                                @foreach ($cityCorporations as $cityCorporation)
                                                    <option value="{{ $cityCorporation->id }}" @if ($cityCorporation->id == $village->city_id) selected @endif>{{ $cityCorporation->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error city_corporation_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row pos_type {{ $village->location_type == 'pos_type' ? '' : 'd-none' }}">
                                    <label for="pourashava_id" class="col-sm-2 col-form-label">Pourashava<span
                                            class="text-danger" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="pourashava_id" id="pourashava_id">
                                            <option value="">Pourashava</option>
                                            @if ($pourashavas)
                                                @foreach ($pourashavas as $pourashava)
                                                    <option value="{{ $pourashava->id }}" @if ($pourashava->id == $village->pourashava_id) selected @endif>{{ $pourashava->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error pourashava_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row thana_list {{ $village->location_type == 'union_type' ? '' : 'd-none' }}">
                                    <label for="thana_id" class="col-sm-2 col-form-label">Thana <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="thana_id" id="thana_id">
                                            <option value="">Thana</option>
                                            @if ($thanas)
                                                @foreach($thanas as $thana)
                                                    <option value="{{$thana->id}}" @if ($thana->id == $village->thana_id) selected @endif >{{$thana->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error thana_id_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row union_type {{ $village->location_type == 'union_type' ? '' : 'd-none' }}">
                                    <label for="union_id" class="col-sm-2 col-form-label">Union <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="union_id" id="union_id">
                                            <option value="">Union</option>
                                            @if ($unions)
                                                @foreach($unions as $union)
                                                    <option value="{{$union->id}}" @if ($union->id == $village->union_id) selected @endif >{{$union->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error union_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Village Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" placeholder="Village Name" value="{{$village->en_name}}" class="form-control" id="en_name">
                                        <small class="text-danger error en_name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Village Name Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" placeholder="Village Name Bangla"  value="{{$village->bn_name}}" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('basic-settings.village.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Update</button>
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
            $("#unionForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('basic-settings.village.update', $village->id)}}",
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
                            location.href = "{{route('basic-settings.village.index')}}";
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
        })

        $(document).on('change', '#division_id', function(e){
            e.preventDefault();
            let divisionID = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{url('/get-districts-by-division')}}/"+divisionID,
                beforeSend: function() {
                    console.log("Loading districts");
                },
                success: function (response) {
                    $("#district_id").html(response);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        })

        $(document).on('change', '#district_id', function(e){
            e.preventDefault();
            let divisionID = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{url('/get-thanas-by-district')}}/"+divisionID,
                beforeSend: function() {
                    console.log("Loading tahans");
                },
                success: function (response) {
                    $("#thana_id").html(response);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        })

        $(document).on('change', '#thana_id', function(e){
            e.preventDefault();
            let divisionID = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{url('/get-unions-by-thana')}}/"+divisionID,
                beforeSend: function() {
                    console.log("Loading tahans");
                },
                success: function (response) {
                    $("#union_id").html(response);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            });
        })

        $('.location_type').on('click', function() {
            let val = $(this).val();

            if (val == 'city_type') {
                $('.' + val).removeClass('d-none');
                $('.union_type').addClass('d-none');
                $('.pos_type').addClass('d-none');
                $('.thana_list').addClass('d-none');
            } else if (val == 'union_type') {
                $('.' + val).removeClass('d-none');
                $('.city_type').addClass('d-none');
                $('.pos_type').addClass('d-none');
                $('.thana_list').removeClass('d-none');
            } else if (val == 'pos_type') {
                $('.' + val).removeClass('d-none');
                $('.city_type').addClass('d-none');
                $('.union_type').addClass('d-none');
                $('.thana_list').addClass('d-none');
            }
        });

        $(document).on('change', '#district_id', function(e) {
            e.preventDefault();
            let district_id = $(this).val();
            let pourashava_id = $("#pourashava_id");
            let city_corporation_id = $("#city_corporation_id");

            if (district_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                    success: function(response) {
                        pourashava_id.html(response)
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                    success: function(response) {
                        city_corporation_id.html(response)
                    }
                });
            }
        });
    </script>
@endpush


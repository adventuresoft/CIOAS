@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Village'])

@push('style')
@endpush

@section('title', 'Edit Village')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form id="villageForm" action="{{ route('basic-settings.village.update', $village->id) }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-home"></i> Edit Village Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">

                            <div class="form-group row mb-4">
                                <label for="division_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Division <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select Division</option>
                                        @if ($divisions)
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}" @if ($division->id == $village->division_id) selected @endif>{{ $division->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error division_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="district_id" class="col-sm-3 col-form-label text-dark font-weight-bold">District <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select District</option>
                                        @if ($districts)
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" @if ($district->id == $village->district_id) selected @endif>{{ $district->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error district_id_error"></small>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4 thana_list">
                                <label for="thana_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Thana <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="thana_id" id="thana_id" class="form-control select2">
                                        <option value="" disabled selected>Select Thana</option>
                                        @if ($thanas)
                                            @foreach ($thanas as $thana)
                                                <option value="{{ $thana->id }}" @if ($thana->id == $village->thana_id) selected @endif>{{ $thana->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error thana_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4 location_cat">
                                <label class="col-sm-3 col-form-label text-dark font-weight-bold">Location Type <span class="text-danger">*</span></label>
                                <div class="col-sm-9 d-flex align-items-center">
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input location_type" type="radio" name="location_type" id="city_corporation" value="city_type" {{ $village->location_type == 'city_type' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="city_corporation">City Corporation</label>
                                        </div>
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input location_type" type="radio" name="location_type" id="pourashava" value="pos_type" {{ $village->location_type == 'pos_type' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pourashava">Pourashava</label>
                                        </div>
                                        <div class="form-check custom-radio">
                                            <input class="form-check-input location_type" type="radio" name="location_type" id="union" value="union_type" {{ $village->location_type == 'union_type' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="union">Union</label>
                                        </div>
                                    </div>
                                    <small class="text-danger error location_type_error d-block w-100"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4 city_type {{ $village->location_type == 'city_type' ? '' : 'd-none' }}">
                                <label for="city_corporation_id" class="col-sm-3 col-form-label text-dark font-weight-bold">City Corporation <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="city_corporation_id" id="city_corporation_id" class="form-control select2">
                                        <option value="" disabled selected>Select City Corporation</option>
                                        @if ($cityCorporations)
                                            @foreach ($cityCorporations as $cityCorporation)
                                                <option value="{{ $cityCorporation->id }}" @if ($cityCorporation->id == $village->city_id) selected @endif>{{ $cityCorporation->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error city_corporation_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4 pos_type {{ $village->location_type == 'pos_type' ? '' : 'd-none' }}">
                                <label for="pourashava_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Pourashava <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="pourashava_id" id="pourashava_id" class="form-control select2">
                                        <option value="" disabled selected>Select Pourashava</option>
                                        @if ($pourashavas)
                                            @foreach ($pourashavas as $pourashava)
                                                <option value="{{ $pourashava->id }}" @if ($pourashava->id == $village->pourashava_id) selected @endif>{{ $pourashava->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error pourashava_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4 union_type {{ $village->location_type == 'union_type' ? '' : 'd-none' }}">
                                <label for="union_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Union <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="union_id" id="union_id" class="form-control select2">
                                        <option value="" disabled selected>Select Union</option>
                                        @if ($unions)
                                            @foreach ($unions as $union)
                                                <option value="{{ $union->id }}" @if ($union->id == $village->union_id) selected @endif>{{ $union->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error union_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="en_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Village Name (English) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="en_name" id="en_name" value="{{ $village->en_name }}" class="form-control" placeholder="Village Name (English)" required>
                                    <small class="text-danger error en_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Village Name (Bengali) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" value="{{ $village->bn_name }}" class="form-control" placeholder="Village Name (Bengali)" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" {{ $village->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $village->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.village.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            
            $("#villageForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.village.update', $village->id) }}",
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
                        if(response.status) {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.href = "{{ route('basic-settings.village.index') }}";
                            }, 1500);
                        } else {
                            toastr.error(response.message || 'Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || "An error occurred");
                        if(responseText.errors) {
                            $.each(responseText.errors, function(key, val) {
                                thisForm.find("." + key + "_error").text(val[0]);
                            });
                        }
                    }
                });
            });

            $(document).on('change', '#division_id', function(e) {
                e.preventDefault();
                let divisionID = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + divisionID,
                    success: function(response) {
                        $("#district_id").html(response);
                    },
                    error: function(xhr) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message || 'Error loading districts');
                    }
                });
            });

            $(document).on('change', '#district_id', function(e) {
                e.preventDefault();
                let district_id = $(this).val();
                
                if (district_id) {
                    $('.location_cat').removeClass('d-none');
                    $('.thana_list').removeClass('d-none');
                    
                    // Load Thanas
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                        success: function(response) {
                            $("#thana_id").html(response);
                        }
                    });

                    // Load Pourashavas
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-pourashava-by-district') }}/" + district_id,
                        success: function(response) {
                            $("#pourashava_id").html(response);
                        }
                    });

                    // Load City Corporations
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-city-corporation-by-district') }}/" + district_id,
                        success: function(response) {
                            $("#city_corporation_id").html(response);
                        }
                    });
                }
            });

            $('.location_type').on('click', function() {
                let val = $(this).val();

                if (val == 'city_type') {
                    $('.city_type').removeClass('d-none');
                    $('.union_type').addClass('d-none');
                    $('.pos_type').addClass('d-none');
                } else if (val == 'union_type') {
                    $('.union_type').removeClass('d-none');
                    $('.city_type').addClass('d-none');
                    $('.pos_type').addClass('d-none');
                } else if (val == 'pos_type') {
                    $('.pos_type').removeClass('d-none');
                    $('.city_type').addClass('d-none');
                    $('.union_type').addClass('d-none');
                }
            });

            $(document).on('change', '#thana_id', function(e) {
                e.preventDefault();
                let thanaID = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thanaID,
                    success: function(response) {
                        $("#union_id").html(response);
                    }
                });
            });
        });
    </script>
@endpush


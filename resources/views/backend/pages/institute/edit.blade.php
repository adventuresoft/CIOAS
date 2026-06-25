@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteList'])
@section('title', 'Institute Edit')
@section('content')

    <section class="content mt-4">
        <div class="container-fluid">
            <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card cioas-shell">
                    <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-dark font-weight-bold mb-0">
                            <i class="fas fa-edit text-teal mr-2" style="color: #0f766e;"></i> 
                            <span class="top-nav-active">Institute Create Info</span>
                            <a class="top-nav-link" href="{{route('instituteA.adminCreate', $institute->id)}}">Institutional Admin</a> | 
                            <a class="top-nav-link" href="{{route('instituteA.imagesCreate', $institute->id)}}">Institutional Images</a>
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        {{-- Institute Category --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="institute_category" class="col-sm-3 col-form-label premium-form-label">Uses as</label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="institute_category" id="institute_category">
                                    <option value="">Select Working/Monitoring</option>
                                    @foreach ($institute_categories as $institute_category)
                                        <option value="{{ $institute_category->id }}"
                                            {{ $institute->institute_category_id == $institute_category->id ? 'selected' : '' }}>
                                            {{ $institute_category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Institute Subcategory --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="institute_subcategory_id" class="col-sm-3 col-form-label premium-form-label">Institute Category</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 premium-form-control" name="institute_subcategory_id" id="institute_subcategory_id">
                                    <option value="">Category A/B/C</option>
                                    <option value="1" {{ $institute->institute_subcategory_id == 1 ? 'selected' : '' }}>Category A</option>
                                    <option value="2" {{ $institute->institute_subcategory_id == 2 ? 'selected' : '' }}>Category B</option>
                                    <option value="3" {{ $institute->institute_subcategory_id == 3 ? 'selected' : '' }}>Category C</option>
                                </select>
                            </div>
                        </div>

                        {{-- Activation Date --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="activation_time" class="col-sm-3 col-form-label premium-form-label">Activation Date</label>
                            <div class="col-sm-9">
                                <input type="date" id="activation_time" value="{{ $institute->activation_time ?? '' }}"
                                    name="activation_time" class="form-control premium-form-control" required>
                            </div>
                        </div>

                        {{-- Division --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="division" class="col-sm-3 col-form-label premium-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="division" id="division">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ $institute->division_id == $division->id ? 'selected' : '' }}>
                                            {{ $division->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="error division-error text-danger"></small>
                            </div>
                        </div>

                        {{-- District --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="district" class="col-sm-3 col-form-label premium-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="district" id="district">
                                    <option value="">Select District</option>
                                    {{-- Pre-populate if division is set --}}
                                    @if($institute->district_id && $institute->district)
                                        <option value="{{ $institute->district_id }}" selected>
                                            {{ $institute->district->name ?? 'District #'.$institute->district_id }}
                                        </option>
                                    @endif
                                </select>
                                <small class="error district-error text-danger"></small>
                            </div>
                        </div>

                        {{-- Thana --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="thana" class="col-sm-3 col-form-label premium-form-label">Thana / Upazila</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 premium-form-control" name="thana" id="thana">
                                    <option value="">Select Thana</option>
                                    @if($institute->thana_id && $institute->thana)
                                        <option value="{{ $institute->thana_id }}" selected>
                                            {{ $institute->thana->name ?? 'Thana #'.$institute->thana_id }}
                                        </option>
                                    @endif
                                </select>
                                <small class="error thana-error text-danger"></small>
                            </div>
                        </div>

                        {{-- Institute Type --}}
                        <div class="form-group row premium-form-group align-items-center">
                            <label for="institute_type" class="col-sm-3 col-form-label premium-form-label">Institute Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="institute_type" id="institute_type">
                                    <option value="">Select Institute Type</option>
                                    @foreach ($institute_types as $institute_type)
                                        <option value="{{ $institute_type->id }}"
                                            {{ $institute->institute_type_id == $institute_type->id ? 'selected' : '' }}>
                                            {{ $institute_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="error institute_type-error text-danger"></small>
                            </div>
                        </div>

                        <div id="loadProjectTypeContent"></div>

                    </div>
                </div>

                <div class="card cioas-shell mt-4">
                    <div class="card-body d-flex justify-content-end p-3" style="gap: 15px;">
                        <a href="{{ route('institute.index') }}" class="btn btn-premium-cancel">Cancel</a>
                        <button type="submit" class="btn btn-premium-submit">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <!-- /.content -->
@endsection
@push('script')

<script>
    $(document).ready(function() {
        $(".select2").select2();

        // On page load: if division is already selected, load districts
        let existingDivision = $('#division').val();
        let existingDistrict = '{{ $institute->district_id ?? "" }}';
        let existingThana    = '{{ $institute->thana_id ?? "" }}';

        if (existingDivision) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-districts-by-division') }}/" + existingDivision,
                success: function(response) {
                    let currentDistrict = $('#district').find('option:selected').val();
                    $('#district').html(response);
                    if (existingDistrict) {
                        $('#district').val(existingDistrict);
                    }
                    $('#district').prop("disabled", false);
                    $(".select2").select2();

                    // Then load thanas for selected district
                    if (existingDistrict) {
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/get-thanas-by-district') }}/" + existingDistrict,
                            success: function(res) {
                                $('#thana').html(res);
                                if (existingThana) {
                                    $('#thana').val(existingThana);
                                }
                                $('#thana').prop("disabled", false);
                                $(".select2").select2();
                            }
                        });
                    }
                }
            });
        }

        // Division change → load districts
        $(document).on('change', '#division', function(e) {
            let divisionId = $(this).val();
            let thana = $('#thana');
            let district = $('#district');
            if (divisionId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + divisionId,
                    beforeSend: function() {
                        district.prop("disabled", true);
                        thana.html('<option value="">Select Thana</option>').prop("disabled", true);
                        $('#institute_type').prop("disabled", true);
                    },
                    success: function(response) {
                        district.html(response).prop("disabled", false);
                        $(".select2").select2();
                    },
                    error: function() {
                        district.prop("disabled", true);
                    }
                });
            } else {
                district.html('<option value="">Select District</option>').prop("disabled", true);
                thana.html('<option value="">Select Thana</option>').prop("disabled", true);
                $('#institute_type').prop("disabled", true);
            }
        });

        // District change → load thanas
        $(document).on('change', '#district', function(e) {
            let districtId = $(this).val();
            let thana = $('#thana');
            if (districtId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-thanas-by-district') }}/" + districtId,
                    beforeSend: function() {
                        thana.prop("disabled", true);
                        $('#institute_type').prop("disabled", true);
                    },
                    success: function(response) {
                        thana.html(response).prop("disabled", false);
                        $(".select2").select2();
                    },
                    error: function() {
                        thana.prop("disabled", true);
                    }
                });
            } else {
                thana.html('<option value="">Select Thana</option>').prop("disabled", true);
                $('#institute_type').prop("disabled", true);
            }
        });

        // Thana change → enable institute type
        $(document).on('change', '#thana', function() {
            $('#institute_type').prop("disabled", $(this).val() ? false : true);
        });

        // Institute Type change → load dynamic content
        $(document).on('change', '#institute_type', function(e) {
            let institute_type = $(this).val();
            let district = $("#district").val();
            if (institute_type && district) {
                $.ajax({
                    type: "post",
                    url: "{{ route('backendProjectTypeContent') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'institute_type': institute_type,
                        'district_id': district
                    },
                    success: function(response) {
                        $('#loadProjectTypeContent').html(response);
                    },
                    error: function(xhr) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            }
        });

        // Form submit
        $("#instituteForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('institute.update', $institute->id) }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        });
    });
</script>
@endpush

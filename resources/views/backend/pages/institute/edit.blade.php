@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteList'])
@push('style')
@endpush
@section('title', 'Institute Edit')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Institute Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('institute.index')}}">Institute</a></li>
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
                            <h3 class="card-title">
                                <span class="text-light">Institute Create Info |</span>
                                <a class="linked" href="{{route('instituteA.adminCreate', $institute->id)}}"><span class="text-dark">Institutional Admin |</span> </a>
                                <a class="linked" href="{{route('instituteA.imagesCreate', $institute->id)}}"> <span class="text-dark">Institutional Images</span> </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                {{-- Institute Category --}}
                                <div class="form-group row">
                                    <label for="institute_category" class="col-sm-2 col-form-label">Uses as</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="institute_category" id="institute_category">
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
                                <div class="form-group row">
                                    <label for="institute_subcategory_id" class="col-sm-2 col-form-label">Institute Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="institute_subcategory_id" id="institute_subcategory_id">
                                            <option value="">Category A/B/C</option>
                                            <option value="1" {{ $institute->institute_subcategory_id == 1 ? 'selected' : '' }}>Category A</option>
                                            <option value="2" {{ $institute->institute_subcategory_id == 2 ? 'selected' : '' }}>Category B</option>
                                            <option value="3" {{ $institute->institute_subcategory_id == 3 ? 'selected' : '' }}>Category C</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Activation Date --}}
                                <div class="form-group row">
                                    <label for="activation_time" class="col-sm-2 col-form-label">Activation Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" id="activation_time" value="{{ $institute->activation_time ?? '' }}"
                                            name="activation_time" class="form-control" required>
                                    </div>
                                </div>

                                {{-- Division --}}
                                <div class="form-group row">
                                    <label for="division" class="col-sm-2 col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="division" id="division">
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
                                <div class="form-group row">
                                    <label for="district" class="col-sm-2 col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="district" id="district">
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
                                <div class="form-group row">
                                    <label for="thana" class="col-sm-2 col-form-label">Thana / Upazila</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="thana" id="thana">
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
                                <div class="form-group row">
                                    <label for="institute_type" class="col-sm-2 col-form-label">Institute Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="institute_type" id="institute_type">
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
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('institute.index') }}" class="btn btn-default float-right">Cancel</a>
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

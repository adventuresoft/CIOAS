@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteCreate'])
@push('style')
@endpush
@section('title', 'Institute Create')
@section('content')

    <section class="content mt-4">
        <div class="container-fluid">
            <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card cioas-shell">
                    <div class="card-header cioas-panel-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-dark font-weight-bold mb-0">
                            <i class="fas fa-building text-teal mr-2" style="color: #0f766e;"></i> Institute Info
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <input type="hidden" name="institute_category" value="8">

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="activation_time" class="col-sm-3 col-form-label premium-form-label">Activation Date</label>
                            <div class="col-sm-9">
                                <input type="date" id="activation_time"
                                    value="{{ $institute->activation_time ?? '' }}" name="activation_time"
                                    class="form-control premium-form-control" required>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="division" class="col-sm-3 col-form-label premium-form-label">Division <span class="text-danger"
                                    title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="division" id="division">
                                    <option value="">Select Division</option>
                                    @if (count($divisions))
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="error division-error text-danger"></small>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="district" class="col-sm-3 col-form-label premium-form-label">District <span class="text-danger"
                                    title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select disabled required class="form-control select2 premium-form-control" name="district"
                                    id="district">
                                    <option value="">Select District</option>
                                </select>
                                <small class="error district-error text-danger"></small>
                            </div>
                        </div>



                        <div class="form-group row premium-form-group align-items-center">
                            <label for="institute_type" class="col-sm-3 col-form-label premium-form-label">Institute Type <span
                                    class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="institute_type"
                                    id="institute_type">
                                    <option value="">Select Institute Type</option>
                                    @if (count($institute_types))
                                        @foreach ($institute_types as $institute_type)
                                            <option value="{{ $institute_type->id }}">{{ $institute_type->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="error institute_type-error text-danger"></small>
                            </div>
                        </div>

                        <div class="form-group row premium-form-group align-items-center">
                            <label for="institute_subcategory_id" class="col-sm-3 col-form-label premium-form-label">Institute
                                Category</label>
                            <div class="col-sm-9">
                                <select required class="form-control select2 premium-form-control" name="institute_subcategory_id"
                                    id="institute_subcategory_id">
                                    <option value="">Category A/B/C</option>
                                    <option value="1">Category A</option>
                                    <option value="2">Category B</option>
                                    <option value="3">Category C</option>
                                </select>
                            </div>
                        </div>

                        <div id="loadProjectTypeContent">

                        </div>

                    </div>
                </div>

                <div class="card cioas-shell mt-4">
                    <div class="card-body d-flex justify-content-end p-3" style="gap: 15px;">
                        <a href="{{ route('institute.index') }}" class="btn btn-premium-cancel">Cancel</a>
                        <button type="submit" class="btn btn-premium-submit">Submit</button>
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
        })

        $(document).on('change', '#division', function(e) {
            e.preventDefault();
            let district = $('#district')
            let institute_type = $('#institute_type');
            let division = $(this).val();
            if (division) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/" + division,
                    beforeSend: function() {
                        district.prop("disabled", true);
                        institute_type.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        district.html(response)
                        district.prop("disabled", false);
                        institute_type.prop("disabled", true);
                    },
                    error: function(xhr, status, error) {
                        district.prop("disabled", true);
                        institute_type.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district.prop("disabled", true);
                institute_type.prop("disabled", true);
            }
        })

        $(document).on('change', '#district', function(e) {
            e.preventDefault();
            let districtId = $(this).val();
            if (districtId) {
                $('#institute_type').prop("disabled", false);
            } else {
                $('#institute_type').prop("disabled", true);
            }
        })



        $(document).on('change', '#institute_type', function(e) {
            e.preventDefault();
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
                    beforeSend: function() {
                        console.log("Searcing Project Type Content");
                    },
                    success: function(response) {
                        $('#loadProjectTypeContent').html(response)
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            }
        })

        $(document).on('change', '#thana', function(e) {
            e.preventDefault();
            let thana_id = $(this).val();
            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/" + thana_id,
                    beforeSend: function() {
                        $('#union').prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function(response) {
                        $('#union').html(response)
                        $('#union').prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        $('#union').prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }

                });
            } else {
                $('#union').prop("disabled", true);
            }

        })

        $(document).on('submit', '#instituteForm', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "post",
                url: "{{ route('institute.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('.error').html('');
                    thisForm.find(".loading-button").removeClass('d-none');
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function(response) {
                    toastr.success(response.message);
                    thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                        .addClass('text-success').text(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)

                },
                error: function(xhr, status, error) {
                    thisForm.find(".loading-button").addClass('d-none');
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);

                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }

            });
        })
    </script>

    <script>
        function readURL(input, preview = '') {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#left_image").change(function() {
            readURL(this, '#left_image_preview');

        });

        $("#top_image").change(function() {
            readURL(this, '#top_image_preview');

        });

        $("#right_image").change(function() {
            readURL(this, '#right_image_preview');

        });
    </script>
@endpush

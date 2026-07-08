@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Union'])

@push('style')
@endpush

@section('title', 'Edit Union')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form id="union-form" enctype="multipart/form-data" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-layer-group"></i> Edit Union Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">

                            <div class="form-group row mb-4">
                                <label for="division_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Division <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="division_id" id="division_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}" {{ (isset($union->thana->district->division_id) && $union->thana->district->division_id == $division->id) ? 'selected' : '' }}>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger error division_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="district_id" class="col-sm-3 col-form-label text-dark font-weight-bold">District <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" {{ (isset($union->thana->district_id) && $union->thana->district_id == $district->id) ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger error district_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="thana_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Thana <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="thana_id" id="thana_id" class="form-control select2" required>
                                        <option value="" disabled selected>Select Thana</option>
                                        @foreach ($thanas as $thana)
                                            <option value="{{ $thana->id }}" {{ $union->thana_id == $thana->id ? 'selected' : '' }}>{{ $thana->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger error thana_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark font-weight-bold">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" value="{{ $union->name }}" class="form-control" placeholder="Name" required>
                                    <small class="text-danger error name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Bangla Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" value="{{ $union->bn_name }}" class="form-control" placeholder="Bangla Name" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" {{ $union->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $union->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.union.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
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

            $('#division_id').on('change', function() {
                var division_id = $(this).val();
                if(division_id) {
                    $.ajax({
                        url: "{{ url('/get-districts-by-division') }}/" + division_id,
                        type: "GET",
                        success: function(data) {
                            $('#district_id').empty().html(data);
                            $('#thana_id').empty().html('<option value="" disabled selected>Select Thana</option>');
                        }
                    });
                } else {
                    $('#district_id').empty().html('<option value="" disabled selected>Select District</option>');
                    $('#thana_id').empty().html('<option value="" disabled selected>Select Thana</option>');
                }
            });

            $('#district_id').on('change', function() {
                var district_id = $(this).val();
                if(district_id) {
                    $.ajax({
                        url: "{{ url('/get-thanas-by-district') }}/" + district_id,
                        type: "GET",
                        success: function(data) {
                            $('#thana_id').empty().html(data);
                        }
                    });
                } else {
                    $('#thana_id').empty().html('<option value="" disabled selected>Select Thana</option>');
                }
            });

            $('#union-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var thisForm = $(this);
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.union.update', $union->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
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
                                location.href = "{{ route('basic-settings.union.index') }}";
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
        });
    </script>
@endpush

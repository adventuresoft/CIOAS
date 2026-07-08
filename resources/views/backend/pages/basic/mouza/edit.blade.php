@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Mouza'])

@push('style')
@endpush

@section('title', 'Edit Mouza')

@section('content')
    <section class="content cioas-page pt-3">
        <div class="container-fluid">
            <form id="mouzaForm" action="{{ route('basic-settings.mouza.update', $mouza->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-map"></i> Edit Mouza Info
                            </h3>
                        </div>
                        <div class="cioas-panel-body">

                            <div class="form-group row mb-4">
                                <label for="record" class="col-sm-3 col-form-label text-dark font-weight-bold">Record <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="record" id="record" class="form-control select2" required>
                                        <option value="" disabled>Select Record</option>
                                        @if ($land_records)
                                            @foreach ($land_records as $land_record)
                                                <option value="{{ $land_record->id }}" {{ $mouza->record == $land_record->id ? 'selected' : '' }}>{{ $land_record->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error record_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="district_id" class="col-sm-3 col-form-label text-dark font-weight-bold">District <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="district_id" id="district_id" class="form-control select2" required>
                                        <option value="" disabled>Select District</option>
                                        @if ($districts)
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}" {{ $district->id == $mouza->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error district_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="upazila_id" class="col-sm-3 col-form-label text-dark font-weight-bold">Upazila/Circle <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="upazila_id" id="upazila_id" class="form-control select2" required>
                                        <option value="" disabled>Select Upazila/Circle</option>
                                        @if ($upazilas)
                                            @foreach ($upazilas as $upazila)
                                                <option value="{{ $upazila->id }}" {{ $upazila->id == $mouza->upazila_id ? 'selected' : '' }}>{{ $upazila->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-danger error upazila_id_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="name" class="col-sm-3 col-form-label text-dark font-weight-bold">Mouza Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Mouza Name" value="{{ $mouza->name }}" required>
                                    <small class="text-danger error name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="bn_name" class="col-sm-3 col-form-label text-dark font-weight-bold">Mouza Name (Bengali) <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="bn_name" id="bn_name" class="form-control" placeholder="Mouza Name (Bengali)" value="{{ $mouza->bn_name }}" required>
                                    <small class="text-danger error bn_name_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="code" class="col-sm-3 col-form-label text-dark font-weight-bold">Code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Code" value="{{ $mouza->code }}">
                                    <small class="text-danger error code_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="order" class="col-sm-3 col-form-label text-dark font-weight-bold">Order</label>
                                <div class="col-sm-9">
                                    <input type="number" name="order" id="order" class="form-control" placeholder="Order" value="{{ $mouza->order }}">
                                    <small class="text-danger error order_error"></small>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="status" class="col-sm-3 col-form-label text-dark font-weight-bold">Status <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value="1" {{ $mouza->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $mouza->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <small class="text-danger error status_error"></small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="cioas-panel mt-3">
                        <div class="cioas-panel-body d-flex justify-content-end align-items-center">
                            <a href="{{ route('basic-settings.mouza.index') }}" class="btn btn-link text-muted font-weight-bold mr-3" style="text-decoration: none;">Cancel</a>
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

            // Dynamic upazilas loading based on district and record select
            function loadUpazilas() {
                let districtID = $('#district_id').val();
                let recordVal = $('#record').val();
                
                if (districtID && recordVal) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-upazilas-by-district') }}/" + districtID + "?record=" + encodeURIComponent(recordVal),
                        beforeSend: function() {
                            console.log("Loading upazilas");
                        },
                        success: function(response) {
                            $("#upazila_id").html(response);
                        },
                        error: function(xhr, status, error) {
                            toastr.error("Failed to load upazilas/circles");
                        }
                    });
                } else {
                    $("#upazila_id").html('<option value="" disabled selected>Select Upazila/Circle</option>');
                }
            }

            $(document).on('change', '#district_id, #record', function(e) {
                e.preventDefault();
                loadUpazilas();
            });

            $("#mouzaForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.mouza.update', $mouza->id) }}",
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
                                location.href = "{{ route('basic-settings.mouza.index') }}";
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

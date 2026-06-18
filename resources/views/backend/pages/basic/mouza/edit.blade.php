@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Mouza'])
@push('style')
@endpush
@section('title', 'Mouza')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mouza</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('basic-settings.mouza.index') }}">Mouza</a></li>
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
                            <h3 class="card-title">Mouza Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="mouzaForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="district_id" class="col-sm-2 col-form-label">District <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            @if ($districts)
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" @if($district->id == $mouza->district_id) selected @endif>{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error district_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="upazila_id" class="col-sm-2 col-form-label">Upazila/Circle <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="upazila_id" id="upazila_id">
                                            <option value="">Select Upazila/Circle</option>
                                            @if ($upazilas)
                                                @foreach ($upazilas as $upazila)
                                                    <option value="{{ $upazila->id }}" @if($upazila->id == $mouza->upazila_id) selected @endif>{{ $upazila->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error upazila_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="record" class="col-sm-2 col-form-label">Record <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="record" id="record">
                                            <option value="">Select Record</option>
                                            <option value="CS" @if($mouza->record == 'CS') selected @endif>CS</option>
                                            <option value="SA" @if($mouza->record == 'SA') selected @endif>SA</option>
                                            <option value="RS" @if($mouza->record == 'RS') selected @endif>RS</option>
                                            <option value="City/BRS" @if($mouza->record == 'City/BRS') selected @endif>City/BRS</option>
                                        </select>
                                        <small class="text-danger error record_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Mouza Name <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="name" placeholder="Mouza Name"
                                            value="{{ $mouza->name }}" class="form-control" id="name">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Mouza Name Bangla <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" placeholder="Mouza Name Bangla"
                                            value="{{ $mouza->bn_name }}" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" placeholder="Code"
                                            value="{{ $mouza->code }}" class="form-control" id="code">
                                        <small class="text-danger error code_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="order" class="col-sm-2 col-form-label">Order</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="order" placeholder="Order"
                                            value="{{ $mouza->order }}" class="form-control" id="order">
                                        <small class="text-danger error order_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="status" id="status">
                                            <option value="1" @if($mouza->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($mouza->status == 0) selected @endif>Inactive</option>
                                        </select>
                                        <small class="text-danger error status_error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('basic-settings.mouza.index') }}"
                                        class="btn btn-default float-right">Cancel</a>
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

            // Dynamic upazilas loading based on district select
            $(document).on('change', '#district_id', function(e) {
                e.preventDefault();
                let districtID = $(this).val();
                if (districtID) {
                    $.ajax({
                        type: "GET",
                        url: "{{ url('/get-upazilas-by-district') }}/" + districtID,
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
                    $("#upazila_id").html('<option value="">Select Upazila/Circle</option>');
                }
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
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href =
                                "{{ route('basic-settings.mouza.index') }}";
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
@endpush

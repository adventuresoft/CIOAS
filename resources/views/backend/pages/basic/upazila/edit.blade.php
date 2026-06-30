@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'Upazila'])
@push('style')
@endpush
@section('title', 'Upazila/Circle')
@section('content')
    

    <!-- Main content -->
    <section class="content cioas-page pt-5">
    <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="cioas-shell">
                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">Upazila/Circle Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="upazilaForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="cioas-panel-body">

                                <div class="form-group row">
                                    <label for="record" class="col-sm-2 col-form-label">Record</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="record" id="record">
                                            <option value="">Select Record</option>
                                            @if ($land_records)
                                                @foreach ($land_records as $land_record)
                                                    <option value="{{ $land_record->id }}" @if($upazila->record == $land_record->id) selected @endif>{{ $land_record->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error record_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Upazila/Circle Name <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="name" placeholder="Upazila/Circle Name"
                                            value="{{ $upazila->name }}" class="form-control" id="name">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Bengali Name <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" placeholder="Bengali Name"
                                            value="{{ $upazila->bn_name }}" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="district_id" class="col-sm-2 col-form-label">District <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            @if ($districts)
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}" @if($district->id == $upazila->district_id) selected @endif>{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error district_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 col-form-label">Code </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" placeholder="Code"
                                            value="{{ $upazila->code }}" class="form-control" id="code">
                                        <small class="text-danger error code_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="status" id="status">
                                            <option value="1" @if($upazila->status == 1) selected @endif>Active</option>
                                            <option value="0" @if($upazila->status == 0) selected @endif>Inactive</option>
                                        </select>
                                        <small class="text-danger error status_error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="cioas-actions mt-4">
                                <div class="form-group row">
                                    <a href="{{ route('basic-settings.upazila.index') }}"
                                        class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    </div>
                    <!-- /.cioas-shell -->
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
            $("#upazilaForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.upazila.update', $upazila->id) }}",
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
                                "{{ route('basic-settings.upazila.index') }}";
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

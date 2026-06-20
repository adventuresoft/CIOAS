@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'Union'])
@push('style')
@endpush
@section('title', 'Union')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Union</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.union.index')}}">Union</a></li>
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
                            <h3 class="card-title">Union Info Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="union-form" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="division_id" class="col-sm-2 col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="division_id" id="division_id">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}" {{(isset($union->thana->district->division_id) && $union->thana->district->division_id == $division->id) ? 'selected' : ''}}>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error division_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="district_id" class="col-sm-2 col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="district_id" id="district_id">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $district)
                                                <option value="{{$district->id}}" {{(isset($union->thana->district_id) && $union->thana->district_id == $district->id) ? 'selected' : ''}}>{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error district_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="thana_id" class="col-sm-2 col-form-label">Thana <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="thana_id" id="thana_id">
                                            <option value="">Select Thana</option>
                                            @foreach ($thanas as $thana)
                                                <option value="{{$thana->id}}" {{$union->thana_id == $thana->id ? 'selected' : ''}}>{{$thana->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error thana_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="name" value="{{$union->name}}" placeholder="Name" class="form-control" id="name">
                                        <small class="text-danger error name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Bangla Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" value="{{$union->bn_name}}" placeholder="Bangla Name" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="status" id="status">
                                            <option value="1" {{$union->status == 1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$union->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                        <small class="text-danger error status_error"></small>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                                <button type="reset" class="btn btn-default float-right">Cancel</button>
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
        $('#division_id').on('change', function() {
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{ url('/get-districts-by-division') }}/" + division_id,
                    type: "GET",
                    success: function(data) {
                        $('#district_id').empty().html(data);
                        $('#thana_id').empty().html('<option value="">Select Thana</option>');
                    }
                });
            } else {
                $('#district_id').empty().html('<option value="">Select District</option>');
                $('#thana_id').empty().html('<option value="">Select Thana</option>');
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
                $('#thana_id').empty().html('<option value="">Select Thana</option>');
            }
        });

        $('#union-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('basic-settings.union.update', $union->id)}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function(response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = "{{route('basic-settings.union.index')}}";
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "_error").text(val[0]);
                    });
                }
            });
        });
    });
</script>
@endpush

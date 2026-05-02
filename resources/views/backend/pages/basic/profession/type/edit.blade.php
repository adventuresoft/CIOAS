@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'ProfessionType'])
@push('style')
@endpush
@section('title', 'Profession Type')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Profession Type</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.profession-type.index')}}">Profession Type</a></li>
            <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Profession Type Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="professionCateogryForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="profession_id" class="col-sm-2 col-form-label">Profession <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="profession_id" id="profession_id">
                                            <option value="">Select Profession</option>
                                            @if ($professions)
                                                @foreach ($professions as $item)
                                                    <option value="{{$item->id}}" @if($type->profession_id == $item->id) selected @endif >{{$item->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error profession_id_error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" value="{{$type->en_name}}" placeholder="Profession Type" class="form-control" id="en_name">
                                        <small class="error en_name_error text-danger"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Type Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" value="{{$type->bn_name}}" placeholder="Profession Type Bangla" class="form-control" id="bn_name">
                                        <small class="error bn_name_error text-danger"></small>

                                    </div>
                                </div>

                            

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('basic-settings.profession-type.index')}}" class="btn btn-default float-right">Cancel</a>
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
            $("#professionCateogryForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('basic-settings.profession-type.update', $type->id)}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        $('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = "{{route('basic-settings.profession-type.index')}}";
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
            })
        })
    </script>
@endpush

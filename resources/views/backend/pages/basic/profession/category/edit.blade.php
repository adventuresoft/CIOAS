@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'ProfessionCategory'])
@push('style')
@endpush
@section('title', 'Profession Category')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profession Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.profession-category.index')}}">Profession Category</a></li>
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
                            <h3 class="card-title">Edit Profession Category Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="professionCategory" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="profession_type_id" class="col-sm-2 col-form-label">Profession Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="profession_type_id" id="profession_type_id">
                                            <option value="">Profession Type</option>
                                            @if ($types)
                                                @foreach ($types as $type)
                                                    <option value="{{$type->id}}" @if ($type->id == $category->profession_type_id) selected @endif > {{$type->profession->en_name}} - {{$type->en_name}}</option> 
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger eror profession_type_id_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Category <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="en_name" value="{{$category->en_name}}"  placeholder="Profession Category" class="form-control" id="en_name">
                                        <small class="text-danger eror en_name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Category Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" value="{{$category->bn_name}}" placeholder="Profession Category Bangla" class="form-control" id="bn_name">
                                        <small class="text-danger eror bn_name_error"></small>

                                    </div>
                                </div>
                               

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer row">
                                    <a href="{{route('basic-settings.profession-category.index')}}" class="btn btn-default float-right">Cancel</a>
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
       $("#professionCategory").on('submit', function(e) {
           e.preventDefault();
           let thisForm = $(this);
           $.ajax({
               type: "POST",
               url: "{{route('basic-settings.profession-category.update', $category->id)}}",
               data: new FormData(this),
               dataType: "json",
               contentType:false,
               cache:false,
               processData:false,
               beforeSend: function() {
                   thisForm.find('button[type="submit"]').prop("disabled",true);
                   $('.error').text();
               },
               success: function (response) {
                   thisForm.find('button[type="submit"]').prop("disabled",false);
                   toastr.success(response.message);
                   setTimeout(function() {
                       location.href = "{{route('basic-settings.profession-category.index')}}";
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
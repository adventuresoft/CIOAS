@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'OrganizationSubcategory'])
@push('style')
@endpush
@section('title', 'Organization Subcategory')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Subcategory</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.organization-subcategory.index')}}">Organization Subcategory</a></li>
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
                            <h3 class="card-title">Edit Organization Subcategory Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="organizationSubcateogryEditForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="organization_category_id" class="col-sm-3 col-form-label">Organization Category <span class="text-danger" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="organization_category_id" id="organization_category_id">
                                            <option value="">Organization Category</option>
                                            @if ($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if ($category->id == $subcategory->organization_category_id) selected @endif >{{$category->en_name}}</option> 
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error organization_category_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-3 col-form-label">Subcategory <span class="text-danger" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" value="{{$subcategory->en_name}}"  placeholder="Organization Sub-Category" class="form-control" id="en_name">
                                        <small class="text-danger error en_name_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-3 col-form-label">Subcategory Bangla <span class="text-danger" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" value="{{$subcategory->bn_name}}" placeholder="Organization Sub-Category Bangla" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>

                                

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="{{route('basic-settings.organization-subcategory.index')}}" class="btn btn-default float-right">Cancel</a>
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
       $("#organizationSubcateogryEditForm").on('submit', function(e) {
           e.preventDefault();
           let thisForm = $(this);
           $.ajax({
               type: "POST",
               url: "{{route('basic-settings.organization-subcategory.update', $subcategory->id)}}",
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
                       location.href = "{{route('basic-settings.organization-subcategory.index')}}";
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

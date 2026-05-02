@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'OrganizationWorkArea'])
@push('style')
@endpush
@section('title', 'Organization Work Area')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization  Work Area</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            {{-- {{route('death.index')}} --}}
            <li class="breadcrumb-item"><a href="{{route('basic-settings.organization-work-area.index')}}">Organization  Work Area</a></li>
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
                            <h3 class="card-title">Edit Organization Work Area</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                         <!-- form start -->
                         <form class="form-horizontal" id="organizationWorkAreaForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="organization_category_id" class="col-sm-2 col-form-label">Category <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" id="organization_category_id" name="organization_category_id">
                                            <option value="">Organization Category</option>
                                            @if ($categories)
                                                @foreach ($categories as $item)
                                                    <option value="{{$item->id}}" {{$area->organization_category_id == $item->id ? 'selected' : '' }} >{{$item->en_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error organization_category_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="organization_subcategory_id" class="col-sm-2 col-form-label">Subcategory <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" id="organization_subcategory_id" name="organization_subcategory_id">
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}" {{$area->organization_subcategory_id == $subcategory->id ? 'selected' : '' }}>{{$subcategory->en_name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger error organization_subcategory_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Work Area <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="en_name" value="{{$area->en_name}}" placeholder="Organization Work Area" class="form-control" id="en_name">
                                        <small class="text-danger error en_name_error"></small>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Work Area Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_name" value="{{$area->bn_name}}" placeholder="Organization Work Area Bangla" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>

                                    </div>
                                </div>


                               


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    
                                    <a href="{{route('basic-settings.organization-work-area.index')}}" class="btn btn-default float-right">Cancel</a>
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
       $("#organizationWorkAreaForm").on('submit', function(e) {
           e.preventDefault();
           let thisForm = $(this);
           $.ajax({
               type: "POST",
               url: "{{route('basic-settings.organization-work-area.update', $area->id)}}",
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
                       location.href = "{{route('basic-settings.organization-work-area.index')}}";
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

   $(document).on('change', '#organization_category_id', function(e){
        e.preventDefault();
        let _this_value = $(this).val();
        if(_this_value){
            $.ajax({
                type: "GET",
                url: "{{ url('organization-subcategory-options') }}/"+_this_value,
                beforeSend: function() {
                    $('#organization_subcategory_id').prop("disabled", true);
                    console.log("Searcing House");
                },
                success: function(response) {
                    $('#organization_subcategory_id').html(response)
                    $('#organization_subcategory_id').prop("disabled", false);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }

            });
        }
    })

</script>

@endpush

@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'OrganizationOwnershipType'])
@push('style')
@endpush
@section('title', 'Organization Ownership')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Ownership</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.organization-ownership-type.index')}}">Organization Ownership</a></li>
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
                            <h3 class="card-title">Organization Ownership Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="organizationOwnership" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Ownership Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="en_name" placeholder="Organization Ownership Type" class="form-control" id="en_name">
                                        <small class="text-danger error en_name_error"></small>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Ownership Type Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" placeholder="Organization Ownership Type Bangla" class="form-control" id="bn_name">
                                        <small class="text-danger error bn_name_error"></small>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('basic-settings.organization-ownership-type.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Submit</button>
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

{{-- {{ route('death.store') }} --}}
@endsection
@push('script')

    <script>
         $(document).ready(function() {
             $(".select2").select2();
            $("#organizationOwnership").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('basic-settings.organization-ownership-type.store')}}",
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
                            location.href = "{{route('basic-settings.organization-ownership-type.index')}}";
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

@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteList'])
@push('style')
@endpush
@section('title', 'Institute Edit')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Institute Edit</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('institute.index')}}">Institute</a></li>
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
                            <h3 class="card-title">
                               <a class="linked" href="{{route('institute.edit', $institute->id)}}"> <span class="text-dark">Institute Create Info |</span></a>   
                                <span class="text-light">Institutional Admin |</span> 
                                <a class="linked" href="{{route('instituteA.imagesCreate', $institute->id)}}"> <span class="text-dark">Institutional Images</span> </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="institute_id" value="{{$institute->id}}">
                            <input type="hidden" name="user_id" value="{{$institute->superUser->id ?? 0}}">



                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Admin Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" value="{{$institute->superUser->name ?? ''}}" placeholder="Institinal Super Admin Name" name="name" class="form-control" required>
                                        <small class="error name-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="email" id="email" value="{{$institute->superUser->email ?? ''}}" placeholder="Institinal Super Admin Email" name="email" class="form-control" required>
                                        <small class="error email-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="mobile" value="{{$institute->superUser->mobile ?? ''}}" placeholder="Institinal Super Admin Mobile" name="mobile" class="form-control" required>
                                        <small class="error mobile-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="password" placeholder="Keep empty to unchange" name="password" class="form-control" required>
                                        <small class="error password-error text-danger"></small>
                                    </div>
                                </div>
                            </div>
                          




                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('institute.index')}}" class="btn btn-default float-right">Cancel</a>
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
        $("#instituteForm").on('submit', function(e) {
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('instituteA.adminStore')}}",
                data: new FormData(this),
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        })
    })
</script>

<script>
    function readURL(input, preview='') {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(preview).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#left_image").change(function() {
        readURL(this, '#left_image_preview');

    });

    $("#top_image").change(function() {
        readURL(this, '#top_image_preview');

    });

    $("#right_image").change(function() {
        readURL(this, '#right_image_preview');

    });

</script>
@endpush

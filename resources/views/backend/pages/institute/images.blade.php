@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteList'])
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
                        <li class="breadcrumb-item"><a href="{{ route('institute.index') }}">Institute</a></li>
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
                            <a class="linked" href="{{route('institute.edit', $institute->id)}}"> <span class="text-dark">Institute Create Info |</span></a>   
                            <a class="linked" href="{{route('instituteA.adminCreate', $institute->id)}}"> <span class="text-dark">Institutional Admin |</span>  </a>
                             <span class="text-light">Institutional Images</span>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="institute_id" value="{{$institute->id}}">

                            <div class="card-body">
                                <div class="row">
                                    <label for="images" class="col-sm-2 col-form-label">Institute Images <span
                                            class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
    
                                    <div class="col-sm-9">
    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="left_image">Left <span class="text-danger" title="Required"
                                                        data-toggle="tooltip">*</span></label>
                                                <input type="file" required id="left_image" name="left_image">
                                                <small class="error left_image-error text-danger"></small><br>
                                                <img class="img-fluid img-thumbnail my-3" height="100" width="100"
                                                    src="{{ asset( $institute->left_image ??  'public/no-image-found.jpeg') }}" id="left_image_preview"
                                                    alt="leftImagePreview">
    
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="top_image">Top <span class="text-danger" title="Required"
                                                        data-toggle="tooltip">*</span></label>
                                                <input type="file" required id="top_image" name="top_image">
                                                <small class="error top_image-error text-danger"></small><br>
                                                <img class="img-fluid img-thumbnail my-3" height="100" width="100"
                                                    src="{{ asset($institute->top_image ?? 'public/no-image-found.jpeg') }}" id="top_image_preview"
                                                    alt="leftImagePreview">
    
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="right_image">Right <span class="text-danger" title="Required"
                                                        data-toggle="tooltip">*</span></label>
                                                <input type="file" id="right_image" required name="right_image">
                                                <small class="error right_image-error text-danger"></small><br>
                                                <img class="img-fluid img-thumbnail my-3" height="100" width="100"
                                                    src="{{ asset( $institute->right_image ?? 'public/no-image-found.jpeg') }}" id="right_image_preview"
                                                    alt="leftImagePreview">
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                            </div>

                           




                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('institute.index') }}" class="btn btn-default float-right">Cancel</a>
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
                    url: "{{ route('instituteA.imagesStore') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = "{{ route('institute.index') }}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
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
        function readURL(input, preview = '') {
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

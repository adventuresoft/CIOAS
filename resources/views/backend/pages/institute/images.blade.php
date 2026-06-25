@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' => 'InstituteList'])
@push('style')
@endpush
@section('title', 'Institute Edit')
@section('content')

    <section class="content cioas-page pt-5">
        <div class="container-fluid">
            <div class="cioas-shell">
                <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="institute_id" value="{{$institute->id}}">

                    <div class="cioas-panel">
                        <div class="cioas-panel-header">
                            <h3 class="cioas-panel-title">
                                <i class="fas fa-images"></i> 
                                <a class="linked" href="{{route('institute.edit', $institute->id)}}"> <span class="text-light">Institute Create Info |</span></a>   
                                <a class="linked" href="{{route('instituteA.adminCreate', $institute->id)}}"> <span class="text-light">Institutional Admin |</span>  </a>
                                <span class="text-light">Institutional Images</span>
                            </h3>
                        </div>

                        <div class="cioas-panel-body">
                            <div class="row">
                                <label for="images" class="col-sm-2 col-form-label">Institute Images</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <label for="left_image">Left</label><br>
                                            <input type="file" id="left_image" name="left_image" class="form-control-file mb-2">
                                            <small class="error left_image-error text-danger"></small><br>
                                            <img class="img-fluid img-thumbnail" style="height: 120px; object-fit: cover;"
                                                src="{{ asset( $institute->left_image ??  'public/no-image-found.jpeg') }}" id="left_image_preview"
                                                alt="leftImagePreview">
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <label for="top_image">Top</label><br>
                                            <input type="file" id="top_image" name="top_image" class="form-control-file mb-2">
                                            <small class="error top_image-error text-danger"></small><br>
                                            <img class="img-fluid img-thumbnail" style="height: 120px; object-fit: cover;"
                                                src="{{ asset($institute->top_image ?? 'public/no-image-found.jpeg') }}" id="top_image_preview"
                                                alt="topImagePreview">
                                        </div>
                                        <div class="col-sm-4 text-center">
                                            <label for="right_image">Right</label><br>
                                            <input type="file" id="right_image" name="right_image" class="form-control-file mb-2">
                                            <small class="error right_image-error text-danger"></small><br>
                                            <img class="img-fluid img-thumbnail" style="height: 120px; object-fit: cover;"
                                                src="{{ asset( $institute->right_image ?? 'public/no-image-found.jpeg') }}" id="right_image_preview"
                                                alt="rightImagePreview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cioas-actions">
                            <a href="{{ route('institute.index') }}" class="btn btn-default mr-2">Cancel</a>
                            <button type="submit" class="btn btn-material btn-material-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
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

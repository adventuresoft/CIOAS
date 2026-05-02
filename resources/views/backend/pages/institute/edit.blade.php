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
                                <span class="text-light">Institute Create Info |</span>   
                                <a class="linked" href="{{route('instituteA.adminCreate', $institute->id)}}"><span class="text-dark">Institutional Admin |</span> </a>
                                <a class="linked" href="{{route('instituteA.imagesCreate', $institute->id)}}"> <span class="text-dark">Institutional Images</span> </a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="institute_category" class="col-sm-2 col-form-label">Institute Category</label>
                                    <div class="col-sm-9">
                                        <select  required class="form-control select2" name="institute_category" id="institute_category">
                                            <option value="">Select Working/Monitoring</option>
                                            @if (count($institute_categories))
                                                @foreach ($institute_categories as $institute_category)
                                                    <option value="{{$institute_category->id}}" {{ isset($institute->institute_category_id) ? ($institute->institute_category_id == $institute_category->id ? 'selected' : '') : ''  }} >{{$institute_category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="institute_subcategory_id" class="col-sm-2 col-form-label">Institute Subcategory</label>
                                    <div class="col-sm-9">
                                        <select  required class="form-control select2" name="institute_subcategory_id" id="institute_subcategory_id">
                                            <option value="">Select Subcategory A/B/C</option>

                                            <option value="1" {{ isset($institute->institute_subcategory_id) ? ($institute->institute_subcategory_id == 1 ? 'selected' : '') : ''  }}>Subcategory A</option>
                                            <option value="2"  {{ isset($institute->institute_subcategory_id) ? ($institute->institute_subcategory_id == 2 ? 'selected' : '') : ''  }}>Subcategory B</option>
                                            <option value="3"  {{ isset($institute->institute_subcategory_id) ? ($institute->institute_subcategory_id == 3 ? 'selected' : '') : ''  }}>Subcategory C</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="activation_time" class="col-sm-2 col-form-label">Activation Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" id="activation_time" value="{{$institute->activation_time ?? ''}}" name="activation_time" class="form-control" required>
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
                url: "{{route('institute.update', $institute->id)}}",
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

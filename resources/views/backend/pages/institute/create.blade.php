@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteCreate'])
@push('style')
@endpush
@section('title', 'Institute Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Institute Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('institute.index')}}">Institute</a></li>
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
                            <h3 class="card-title">
                                <span class="text-light">Institute Create Info |</span>   
                                <span class="text-dark">Institutional Admin |</span> 
                                <span class="text-dark">Institutional Images</span> 
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="instituteForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
    
                                <div class="form-group row">
                                    <label for="institute_category" class="col-sm-2 col-form-label">Uses as</label>
                                    <div class="col-sm-9">
                                        <select  required class="form-control select2" name="institute_category" id="institute_category">
                                            <option value="">Working/Monitoring</option>
                                            @if (count($institute_categories))
                                                @foreach ($institute_categories as $institute_category)
                                                    <option value="{{$institute_category->id}}">{{$institute_category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                
                            
                                <div class="form-group row">
                                    <label for="activation_time" class="col-sm-2 col-form-label">Activation Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" id="activation_time" value="{{$institute->activation_time ?? ''}}" name="activation_time" class="form-control" required>
                                    </div>
                                </div>
                            
                                
                            
                               
                            
                            
                              

                                <div class="form-group row">
                                    <label for="division" class="col-sm-2 col-form-label">Division <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="division" id="division">
                                            <option value="">Select Division</option>
                                            @if (count($divisions))
                                                @foreach ($divisions as $division)
                                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error division-error text-danger"></small>
                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="district" class="col-sm-2 col-form-label">District <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select disabled required class="form-control select2" name="district" id="district">
                                            <option value="">Select District</option>
                                        </select>
                                        <small class="error district-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="institute_type" class="col-sm-2 col-form-label">Institute Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="institute_type" id="institute_type">
                                            <option value="">Select Institute Type</option>
                                            @if (count($institute_types))
                                                @foreach ($institute_types as $institute_type)
                                                    <option value="{{$institute_type->id}}">{{$institute_type->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error institute_type-error text-danger"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="institute_subcategory_id" class="col-sm-2 col-form-label">Institute Category</label>
                                    <div class="col-sm-9">
                                        <select  required class="form-control select2" name="institute_subcategory_id" id="institute_subcategory_id">
                                            <option value="">Category A/B/C</option>
                                            <option value="1">Category A</option>
                                            <option value="2">Category B</option>
                                            <option value="3">Category C</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div id="loadProjectTypeContent">
                            
                                </div>

                                
                            
                            
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('institute.index')}}" class="btn btn-default float-right">Cancel</a>
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

@endsection
@push('script')

    <script>
         $(document).ready(function() {
             $(".select2").select2();
        })

        $(document).on('change', '#division', function(e){
            e.preventDefault();
            let district = $('#district')
            let institute_type = $('#institute_type');
            let division = $(this).val();
            if (division) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/"+division,
                    beforeSend: function() {
                        district.prop("disabled", true);
                        institute_type.prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        district.html(response)
                        district.prop("disabled", false);
                        institute_type.prop("disabled", true);
                    },
                    error: function(xhr, status, error) {
                        district.prop("disabled", true);
                        institute_type.prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                district.prop("disabled", true);
                institute_type.prop("disabled", true);
            }
        })

        $(document).on('change', '#district', function(e){
            e.preventDefault();
            let district = $(this).val();
            if (district) {
                $('#institute_type').prop("disabled", false);
            } else {
                $('#institute_type').prop("disabled", true);
            }
        })

        $(document).on('change', '#institute_type', function(e){
            e.preventDefault();
            let institute_type = $(this).val();
            let district = $("#district").val();
            if (institute_type && district) {
                $.ajax({
                    type: "post",
                    url: "{{ route('backendProjectTypeContent') }}",
                    data: {
                        "_token" : "{{csrf_token()}}",
                        'institute_type' : institute_type,
                        'district_id' : district
                    },
                    beforeSend: function() {
                        console.log("Searcing Project Type Content");
                    },
                    success: function(response) {
                        $('#loadProjectTypeContent').html(response)
                    },
                    error: function(xhr, status, error) {
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            }
        })

        $(document).on('change', '#thana', function(e){
            e.preventDefault();
            let thana_id = $(this).val();
            if (thana_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-unions-by-thana') }}/"+thana_id,
                    beforeSend: function() {
                        $('#union').prop("disabled", true);
                        console.log("Searcing Unions");
                    },
                    success: function(response) {
                        $('#union').html(response)
                        $('#union').prop("disabled", false);
                    },
                    error: function(xhr, status, error) {
                        $('#union').prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }

                });
            } else {
                $('#union').prop("disabled", true);
            }

        })

        $(document).on('submit', '#instituteForm', function(e){
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "post",
                url: "{{ route('institute.store') }}",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    thisForm.find('.error').html('');
                    thisForm.find(".loading-button").removeClass('d-none');
                    thisForm.find('button[type="submit"]').prop("disabled", true);
                },
                success: function(response) {
                    toastr.success(response.message);
                    thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                        .addClass('text-success').text(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)

                },
                error: function(xhr, status, error) {
                    thisForm.find(".loading-button").addClass('d-none');
                    thisForm.find('button[type="submit"]').prop("disabled", false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);

                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("."+key+"_error").text(val[0]);
                    });
                }

            });
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

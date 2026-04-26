@extends('backend.master', ['mainMenu' => 'Institute', 'subMenu' =>'InstituteType'])
@push('style')
@endpush
@section('title', 'Institute Type Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Institute Type Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('institute-type.index')}}">Institute Type</a></li>
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
                            <h3 class="card-title">Institute Create Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="Form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Institute Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Institute Name" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_death" class="col-sm-2 col-form-label">Name Bangla</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="date_of_death" placeholder="Name Bangla" class="form-control" id="date_of_death">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Type (UP/Miuni/City)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Categorye(A/B/C)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Division</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Division</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select District</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Thana</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="user_id" id="">
                                            <option value="">Select Thana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Logo (Left)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img class="img-fluid img-thumbnail" src="{{asset('public/no-image-found.jpeg')}}" id="preview" alt="Preview" width="3" height="3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Logo (Right)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img class="img-fluid img-thumbnail" src="{{asset('public/no-image-found.jpeg')}}" id="preview" alt="Preview" width="3" height="3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Logo (Top)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img class="img-fluid img-thumbnail" src="{{asset('public/no-image-found.jpeg')}}" id="preview" alt="Preview" width="3" height="3">
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    {{-- {{route('death.index')}} --}}
                                    <a href="" class="btn btn-default float-right">Cancel</a>
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
            $("#deathCertificateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "",
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
@endpush

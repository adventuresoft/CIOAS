@extends('backend.master', ['mainMenu' => 'People', 'subMenu' =>'Create'])
@section('title', 'People Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>People Information</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('people.index')}}">People</a></li>
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
                            <h3 class="card-title">Personal Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peoplePersonalForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger" title="Required" data-toggle="tooltip" >*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        <small class="text-danger error name_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date_of_birth" class="form-control" id="dob">
                                        <small class="text-danger error date_of_birth_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="birth_place" class="col-sm-2 col-form-label">Birth Place</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="birth_place" class="form-control" id="birth_place">
                                        <small class="text-danger error birth_place_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <small class="text-danger error gender_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="religion" class="col-sm-2 col-form-label">Religion</label>
                                    <div class="col-sm-9">
                                        <select name="religion_id" class="form-control" id="religion">
                                            @if ($religions)
                                                @foreach ($religions as $religion)
                                                    <option value="{{$religion->id}}">{{$religion->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="text-danger error religion_id_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="blood_group" class="col-sm-2 col-form-label">Blood Group</label>
                                    <div class="col-sm-9">
                                        <select name="blood_group" class="form-control" id="blood_group">
                                            <option value="A+" selected>A+</option><option value="A-">A-</option>
                                            <option value="B+">B+</option><option value="B-">B-</option>
                                            <option value="O+">O+</option><option value="O-">O-</option>
                                            <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                        </select>
                                        <small class="text-danger error blood_group_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="mobile" placeholder="Mobile" class="form-control" id="mobile">
                                        <small class="text-danger error mobile_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" placeholder="Email" class="form-control" id="email">
                                        <small class="text-danger error email_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="birth_certificate" class="col-sm-2 col-form-label">Birth Certificate No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="birth_certificate" placeholder="Birth Certificate No." class="form-control" id="birth_certificate">
                                        <small class="text-danger error birth_certificate_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nid" class="col-sm-2 col-form-label">NID No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nid" placeholder="NID No." class="form-control" id="nid">
                                        <small class="text-danger error nid_error"></small>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="image" id="image">
                                        <small class="text-danger error image_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <img src="" id="preview" alt="Preview" width="200" height="200">
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('people.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Sumit</button>
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
            $("#peoplePersonalForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.store') }}",
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
                        // setTimeout(function() {
                        //     location.href = "/";
                        // }, 2000)
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>
@endpush

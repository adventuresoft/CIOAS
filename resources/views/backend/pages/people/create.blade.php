@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'Create'])
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
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
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
                            @include('backend.pages.people.tabs.tab_header', ['user' => $user ?? false, 'active_tab' => 'personal'])
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="peoplePersonalForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- Row 1: Name and Bangla Name -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="name">Name <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                        <input type="text" required value="" class="form-control" name="name" id="name" placeholder="Name English">
                                        <small class="error name-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="bn_name">Name Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                        <input type="text" required value="" class="form-control" name="bn_name" id="bn_name" placeholder="Name Bangla">
                                        <small class="error bn_name-error text-danger"></small>
                                    </div>
                                </div>

                                <!-- Row 2: Date of Birth, Age, Birth Place -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" value="" name="date_of_birth" class="form-control" id="date_of_birth">
                                        <small class="error date_of_birth-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="age">Age</label>
                                        <input type="text" value="" class="form-control" id="age" readonly placeholder="Auto calculated">
                                        <small class="error age-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="birth_place">Birth Place</label>
                                        <select name="birth_place" class="form-control" id="birth_place">
                                            <option value="">Select Birth Place</option>
                                            @if (count($districts))
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error birth_place-error text-danger"></small>
                                    </div>
                                </div>

                                <!-- Row 3: Gender, Religion, Blood Group -->
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            @if (count(people_constant_option('gender')))
                                                @foreach (people_constant_option('gender') as $key => $item)
                                                    <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error gender-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="religion">Religion</label>
                                        <select name="religion" class="form-control" id="religion">
                                            <option value="">Select Religion</option>
                                            @if (count($religions))
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error religion-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="blood_group">Blood Group</label>
                                        <select name="blood_group" class="form-control" id="blood_group">
                                            <option value="">Select Blood Group</option>
                                            @if (count(people_constant_option('blood_group')))
                                                @foreach (people_constant_option('blood_group') as $key => $item)
                                                    <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error blood_group-error text-danger"></small>
                                    </div>
                                </div>

                                <!-- Row 4: Birth Reg. No., NID No. -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="birth_certificate">Birth Reg. No.</label>
                                        <input type="text" value="" name="birth_certificate" placeholder="Birth Reg. No." class="form-control" id="birth_certificate">
                                        <small class="error birth_certificate-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nid">NID No.</label>
                                        <input type="text" value="" name="nid" placeholder="NID No." class="form-control" id="nid">
                                        <span class="error nid-error text-danger"></span>
                                    </div>
                                </div>

                                <!-- Row 5: Mobile No., Email -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="mobile">Mobile No.</label>
                                        <input type="tel" value="" name="mobile" placeholder="Mobile" class="form-control" id="mobile">
                                        <small class="error mobile-error text-danger"></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">Email</label>
                                        <input type="email" required value="" name="email" placeholder="Email" class="form-control" id="email">
                                        <small class="error email-error text-danger"></small>
                                    </div>
                                </div>

                                <!-- Row 6: Photo -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="image">Photo</label>
                                        <input type="file" name="image" class="image form-control-file" id="image">
                                        <span class="error image-error text-danger"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('no-image-found.jpeg') }}" id="preview" alt="Preview" width="100" height="100">
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{ route('people.index') }}" class="btn btn-default">Cancel</a>
                                        <button type="submit" class="btn btn-info ml-2">Save & Next</button>
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
            // Age calculation
            $('#date_of_birth').on('change', function() {
                let dob = $(this).val();
                if (dob) {
                    let birthDate = new Date(dob);
                    let today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    let monthDiff = today.getMonth() - birthDate.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    $('#age').val(age + ' years');
                } else {
                    $('#age').val('');
                }
            });

            // Form submission
            $("#peoplePersonalForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('.error').html('')
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = response.redirect_url;
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
            });

            // Birth place change handler
            $('#birth_place').on('change', function(e) {
                e.preventDefault();
            });
        });

        // Image preview
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

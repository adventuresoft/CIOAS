@extends('authenticate.master')
@section('title', 'Register')
@push('style')
@endpush
@section('content')
    <div class="" style="width: 500px">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="h1"><b>UPMS</b></a>
            </div>
            <div class="card-body">
                <form id="registerForm" method="post">
                    <p class="login-box-msg">Register to start your session</p>
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" placeholder="Email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" placeholder="Password" name="password" id="password" class="form-control">
                            </div>
                        </div>
                    </div>

                   
  
                    

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="division">Select Division</label>
                              <select required name="division" id="division" class="form-control">
                                  <option value="">Select Division</option>
                                  @if (count($divisions))
                                      @foreach ($divisions as $division)
                                          <option value="{{$division->id}}">{{$division->name}}</option> 
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="district">Select District</label>
                            <select disabled required name="district" id="district" class="form-control">
                              <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                  </div>

                  

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="institute_type">Select Institute Type</label>
                        <select id="institute_type" required disabled class="form-control" name="institute_type">
                          <option value="">Select Type</option>
                          @if (count($institute_types))
                              @foreach($institute_types as $institute_type)
                                <option value="{{$institute_type->id}}">{{$institute_type->name}}</option>
                              @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                  </div>

                  <div id="loadProjectTypeContent">

                  </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <a href="{{ route('login') }}" class="text-center">Already have an account?</a>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Register
                                <span class="loading-button d-none">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#registerForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('register.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find(".loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .text('Register to start your session');

                    },
                    success: function(response) {
                        toastr.success(response.message);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .addClass('text-success').text(response.message);
                        setTimeout(function() {
                            location.href = "{{ route('login') }}";
                        }, 2000)

                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .addClass('text-danger').text(responseText.message);


                        $.each(responseText.errors, function(key, val) {
                            thisForm.find(".error-" + key).text(val[0]);
                        });
                    }

                });

            })
        })

        $(document).on('change', '#division', function(e){
            e.preventDefault();
            let division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-districts-by-division') }}/"+division_id,
                    beforeSend: function() {
                        $('#district').prop("disabled", true);
                        $('#project_type').prop("disabled", true);
                        console.log("Searcing Districts");
                    },
                    success: function(response) {
                        $('#district').html(response)
                        $('#district').prop("disabled", false);
                        $('#project_type').prop("disabled", true);
                    },
                    error: function(xhr, status, error) {
                        $('#district').prop("disabled", true);
                        $('#project_type').prop("disabled", true);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
            } else {
                $('#district').prop("disabled", true);
                $('#project_type').prop("disabled", true);
            }
        })

        $(document).on('change', '#district', function(e){
            e.preventDefault();
            let district_id = $(this).val();
            if (district_id) {
                $('#institute_type').prop("disabled", false);
            } else {
                $('#institute_type').prop("disabled", true);
            }
        })

        $(document).on('change', '#institute_type', function(e){
            e.preventDefault();
            let institute_type = $(this).val();
            let district_id = $("#district").val();
            if (institute_type && district_id) {
                $.ajax({
                    type: "post",
                    url: "{{ url('/load-project-type-content') }}",
                    data: {
                        "_token" : "{{csrf_token()}}",
                        'institute_type' : institute_type,
                        'district_id' : district_id
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
                    }

                });
            } else {
                $('#union').prop("disabled", true);
            }

        })

        
    </script>
@endpush

@extends('authenticate.master')
@section('title', 'Login')

@push('style')

@endpush

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="h1"><b>UPMS</b></a>
            </div>
            <div class="card-body">
                <form id="loginForm" method="post">
                    @csrf
                    <p class="login-box-msg">Login to start your session</p>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="Email or Mobile">

                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append" id="showPassword" role="button">
                            <div class="input-group-text">
                                <span class="fas fa-eye"></span>
                            </div>
                        </div>
                        <div class="input-group-append d-none" id="hidePassword" role="button">
                            <div class="input-group-text">
                                <span class="fas fa-eye-slash"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" value="1" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                                <span class="loading-button d-none">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Register a new account</a>
                </p>
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
            $("#loginForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "POST",
                    url: "{{ route('login.check') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find(".loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .text('Login to start your session');

                    },
                    success: function(response) {
                        toastr.success(response.message);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .addClass('text-success').text(response.message);
                        setTimeout(function() {
                            location.href = "{{ route('dashboard') }}";
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

            $("#showPassword").on('click', function(e) {
                $("#password").attr("type", "text");
                $("#showPassword").addClass("d-none");
                $("#hidePassword").removeClass("d-none");
            })

            $("#hidePassword").on('click', function(e) {
                $("#password").attr("type", "password");
                $("#hidePassword").addClass("d-none");
                $("#showPassword").removeClass("d-none");
            })
        })
    </script>
@endpush

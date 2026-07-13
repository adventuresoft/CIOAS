@extends('authenticate.master')
@section('title', 'Login')

@push('style')
    <style>
        .gov-login-box {
            width: 100%;
            max-width: 450px;
            margin: 5vh auto;
        }

        .login-card {
            max-height: 400px;
            overflow-y: auto;
            border-top: 4px solid #046307;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: #fff;
        }

        /* Scrollbar for login card */
        .login-card::-webkit-scrollbar {
            width: 6px;
        }

        .login-card::-webkit-scrollbar-thumb {
            background: #046307;
            border-radius: 3px;
        }

        .gov-logo {
            width: 70px;
            height: auto;
            margin-bottom: 10px;
        }

        .btn-gov-primary {
            background-color: #046307;
            border-color: #046307;
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gov-primary:hover {
            background-color: #034a05;
            border-color: #034a05;
            color: #ffffff;
        }

        .gov-title {
            color: #046307;
            font-weight: 700;
            font-size: 1.6rem;
            margin-bottom: 0px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control:focus {
            border-color: #046307;
            box-shadow: 0 0 0 0.2rem rgba(4, 99, 7, 0.25);
        }

        .input-group-text {
            color: #046307;
            background-color: #f8f9fa;
        }

        .icheck-primary input:checked+label::before {
            background-color: #046307 !important;
            border-color: #046307 !important;
        }

        .text-gov {
            color: #046307;
            font-weight: 600;
            text-decoration: none;
        }

        .text-gov:hover {
            color: #034a05;
            text-decoration: underline;
        }

        .login-box-msg {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 15px;
            padding: 0;
        }
    </style>
@endpush

@section('content')
    <div class="gov-login-box">
        <div class="card login-card">
            <div class="card-header text-center border-bottom-0 pt-4 pb-0">
                <img src="{{ asset('images/dhaka.png') }}" alt="Government Logo" class="gov-logo">
                <h1 class="gov-title">CIOAS</h1>
            </div>
            <div class="card-body pt-2">
                <form id="loginForm" method="post">
                    @csrf
                    <p class="login-box-msg text-center">Secure Login Portal</p>

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

                    <div class="row align-items-center mb-3">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" value="1" id="remember">
                                <label for="remember" style="font-weight: 500; color: #555; font-size: 0.95rem;">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-gov-primary btn-block">
                                Login
                                <span class="loading-button d-none ml-1">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-2">
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-gov">Register a new account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $("#loginForm").on('submit', function (e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "POST",
                    url: "{{ route('login.check') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        thisForm.find(".loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .text('Login to start your session');

                    },
                    success: function (response) {
                        toastr.success(response.message);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .addClass('text-success').text(response.message);
                        setTimeout(function () {
                            location.href = "{{ route('dashboard') }}";
                        }, 2000)

                    },
                    error: function (xhr, status, error) {
                        thisForm.find(".loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        thisForm.find('.login-box-msg').removeClass('text-danger text-success')
                            .addClass('text-danger').text(responseText.message);


                        $.each(responseText.errors, function (key, val) {
                            thisForm.find(".error-" + key).text(val[0]);
                        });
                    }

                });

            })

            $("#showPassword").on('click', function (e) {
                $("#password").attr("type", "text");
                $("#showPassword").addClass("d-none");
                $("#hidePassword").removeClass("d-none");
            })

            $("#hidePassword").on('click', function (e) {
                $("#password").attr("type", "password");
                $("#hidePassword").addClass("d-none");
                $("#showPassword").removeClass("d-none");
            })
        })
    </script>
@endpush
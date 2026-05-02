@extends('backend.layouts.login', ['title' => 'লগইন'])
@push('style')
    <style>
        .bottom-div img {
            max-width: 200px;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="container p-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-flex justify-content-between align-items-start flex-column "
                            style="background: #bbe5d1">

                            <div class="top-div mx-auto text-left mt-5">
                                <h6 class="fw-normal" style="letter-spacing: 1px;">Welcome to</h6>
                                <h3 style="color: #253f99">UMS</h3>
                                <h4 class="text-danger">LA Section, Dhaka</h4>
                            </div>
                            <div class="bottom-div mx-auto text-center mb-5">
                                <h5>Powered by:</h5>
                                <img src="{{ asset('frontend/img/company-logo.png') }}" alt="adventure-soft.jpg">
                            </div>


                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center" style="background: #e2eef7">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <form class="login-form" id="loginForm" method="POST">
                                    @csrf
                                    <div class="text-center mb-3 pb-1">

                                        <img height="80" width="80" src="{{ asset('frontend/img/govt-logo.png') }}"
                                            alt="govt-logo.png">
                                        <h6 class="fw-normal my-3 pb-2" style="letter-spacing: 1px; color:#12a14d">Upazila Management System</h6>
                                        <h3 style="color: #253f99">Admin Login Panel</h3>
                                        <p><strong class="text-success">{{ Session::get('success') }}</strong> <strong
                                                class="text-danger">{{ Session::get('error') }}</strong></p>
                                    </div>


                                    <div class="form-outline mb-2">
                                        <label class="form-label font-weight-bold font-italic" for="email">Email</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-user"></i></div>
                                            </div>
                                            <input type="email" name="email" id="email" placeholder="Email"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label font-weight-bold font-italic"
                                            for="password">Password</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text password-show-hide"><i class="fa fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>

                                    <div class="pt-1 mb-2">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <p class="mb-2 pb-lg-2" style="color: #393f81;">
                                        <a class="small text-muted" style="color: #393f81;" href="#">Forgot
                                            password?</a>
                                    </p>


                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
  <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

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
                        .text('');

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

@endsection

@push('script')

  <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

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
                        .text('');

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

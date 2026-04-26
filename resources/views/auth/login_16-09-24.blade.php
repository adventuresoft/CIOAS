<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
 <link rel="shortcut icon" href="{{asset('public/clientAdmin/img/favicon.png')}}">

  <title>Login</title>

  <!-- Bootstrap CSS -->
  <!-- <link href="{{asset('public/clientAdmin/css/bootstrap.min.css')}}" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- bootstrap theme -->
  <link href="{{asset('public/clientAdmin/css/bootstrap-theme.css')}}" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="{{asset('public/clientAdmin/css/elegant-icons-style.css')}}" rel="stylesheet" />
  <link href="{{asset('public/clientAdmin/css/font-awesome.min.css')}}" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="{{asset('public/clientAdmin/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('public/clientAdmin/css/style-responsive.css')}}" rel="stylesheet" />

</head>

<body class="login-img3-body">
  <div class="container">
    <form class="login-form" id="loginForm" method="POST">
       @csrf
      <div class="login-wrap" style="background-color: #feeef6 !important">
        <p class="login-img">
          <a href="{{route('home')}}">
            <img src="{{ asset('frontend/img/govt-logo.svg') }}" alt="" height="100px" width="100px">
          </a>
        </p>
        <h3 style="text-align: center;">Welcome <br>To</h3>
        <a href="{{route('home')}}"><h3 style="text-align: center; color: #43a568; margin-top: auto; margin-bottom: 10px;"><b>Union Parishad Management System</b></h3></a>
        <p class="login-box-msg"></p>

        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail or Mobile') }}" required autofocus>
          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
            @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
            @endif
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Remember Me') }} </label>
                {{-- <span class="pull-right"> <a href="{{ route('password.request') }}">  {{ __('Forgot Your Password?') }}</a></span> --}}
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #43a568 !important; color: #ffffff"> {{ __('Login') }}</button>

        <div style="text-align: center; margin-top: 20px;">
          <h4 style="text-align: center;">Design Develop & Maintenance by:</h4>
          <img src="{{ asset('frontend/img/jatri-logo.png') }}" alt="" height="50px" width="50px" style="margin-left: auto; margin-right: auto; display: block;">
          <img src="{{ asset('frontend/img/jatr-2-logo.png') }}" alt="" height="20px" style="margin-left: auto; margin-right: auto; display: block; margin-top:10px">
        </div>

        <div style="margin-top: 15px; background-color: black; margin-left: -20px; margin-right: -20px;height: 2px;"></div>

        <div style="margin-top: 10px; background-color: #1e2892; margin-left: -20px; margin-right: -20px; margin-bottom: -20px; height: 25px;"></div>
        
      </div>
    </form>
  </div>

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
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPMS | {{$title  ?? ''}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.mmenu.all.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/mstyle.css')}}">
    @stack('css')
    @stack('style')
</head>

<body class="login-img3-body">
    <div class="container">
        @yield('content')
    </div>


      <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/js/jquery.mmenu.all.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('frontend/js/script.js') }}"></script>

    @stack('js')
    @stack('script')
</body>
</html>

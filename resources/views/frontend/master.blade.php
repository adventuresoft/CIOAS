<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>UPMS | @yield('title') </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.mmenu.all.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/mstyle.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins')}}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style type="text/css">
        body {
            background: #eeeeee;
        }
        .breadcrumb {
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
            height: 34px;
            position: relative;
            margin: 0 0 19px 0;
            overflow: hidden;
        }

        .application-link:hover{
            color: #fff !important;
        }
    </style>

    @stack('style')

</head>
<body>
    @auth()
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth

    <div class="wrap">
        @include('frontend.layouts.header')
        <!-- Main Content Section -->
        <section id="main-content">
            @yield('content')
        </section>
        <!-- Footer Top Section-->
    </div>

    <nav class="main-menu" id="mmmenu">
        <ul>
            <li><a href="{{route('home')}}">হোম</a></li>
            <li><a href="{{route('home')}}">আমাদের সম্পর্কে</a></li>
            <li><a href="{{route('home')}}">ইউনিয়ন আইন</a></li>
            <li><a href="{{route('home')}}">প্রকল্প</a></li>
            <li><a href="{{route('home')}}">নোটিশ</a></li>

            <li class="has-sub"><a href="#">অন্যান্য</a>
                <ul>
                    <li><a href="#">আবেদনের নিয়ম</a></li>
                    <li><a href="#">সনদ প্রাপ্তির নিয়ম</a></li>
                </ul>
            </li>

            <li><a href="#">ছবির গ্যালারী</a></li>
            <li><a class="btn btn-outline-success application-link"
                style="margin: 0px 0px 0px 10px; border-radius:0"
                 href="{{url('/')}}/application">আবেদন করুন</a></li>
        </ul>
    </nav>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('frontend/js/jquery.mmenu.all.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('frontend/js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('frontend/js/script.js')}}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins')}}/select2/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#mmmenu").mmenu({
                navbar: {
                    title: "SUKTAIL UNION PARISHAD"
                }
            });
            var API = $("#mmmenu").data("mmenu");
            $("#mmmenu").click(function() {
                API.open();
            });
        });
    </script>

<script type="text/javascript">
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>

    @stack('script')
</body>
</html>

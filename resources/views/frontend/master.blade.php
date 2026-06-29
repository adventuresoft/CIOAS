<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>CIOAS | @yield('title') </title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins')}}/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/mstyle.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins')}}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
     <script src="https://cdn.tailwindcss.com"></script>

    
    <link rel="stylesheet" href="{{ asset('assets/style/global.css') }}" />
    <style type="text/css">
        html,body{
            overflow-x: hidden!important;
        }
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
        .custom-select {
            display: inline-block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: .375rem 1.75rem .375rem .75rem;
            line-height: 1.5;
            color: #495057;
            vertical-align: middle;
            background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            appearance: none;
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
        <section id="main-content" class="max-w-7xl mx-auto">
            @yield('content')
        </section>
        <!-- Footer Top Section-->
        @include('frontend.layouts.footer')
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('frontend/js/jquery.steps.min.js')}}"></script>
    <script src="{{asset('frontend/js/script.js')}}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins')}}/select2/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {

            // Map Bootstrap 4 data attributes to Bootstrap 5
            function mapBS4toBS5(context) {
                let selectors = ['toggle', 'target', 'dismiss', 'slide', 'slide-to', 'parent', 'reference', 'offset', 'spy', 'ride', 'content', 'trigger', 'placement'];
                selectors.forEach(function (attr) {
                    $(context).find('[data-' + attr + ']').each(function () {
                        let $el = $(this);
                        let val = $el.attr('data-' + attr);
                        if (!$el.attr('data-bs-' + attr)) {
                            $el.attr('data-bs-' + attr, val);
                        }
                    });
                });
            }

            // Map on initial load
            mapBS4toBS5(document);

            // Handle dynamically added content (e.g. AJAX or modals)
            $(document).on('DOMNodeInserted', function (e) {
                mapBS4toBS5(e.target);
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

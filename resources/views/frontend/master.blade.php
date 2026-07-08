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
    
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-bootstrap.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/style/global.css') }}" />
    <style type="text/css">
        html,body{
            overflow-x: hidden!important;
        }
        body {
            background: #eeeeee;
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

        /* --- Frontend Form & Table Global Styles --- */
        .section-title {
            font-size: 14px !important;
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            font-weight: 600 !important;
            color: #333;
            margin-bottom: 1rem;
            border-bottom: 2px solid #10b981;
            display: inline-block;
            padding-bottom: 4px;
        }

        /* Labels and Radios */
        label, input[type="radio"], .form-label, .form-check-label {
            font-size: 14px !important;
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            color: #495057;
            font-weight: 500;
        }
        
        /* Ensure proper spacing for form rows */
        .frontend-form-row, .form-group.row {
            margin-bottom: 1.5rem !important; /* mb-4 equivalent */
        }

        /* Input styling for modern look */
        .form-control, .form-select, .custom-select {
            font-size: 14px !important;
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 0.5rem 0.75rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.025);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus, .form-select:focus, .custom-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }

        /* Professional Bootstrap 5 Table Look */
        .table-responsive {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            margin-bottom: 1.5rem;
            border: 1px solid #f1f5f9;
        }
        .table {
            margin-bottom: 0;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table thead th {
            background-color: #f8fafc;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 16px;
            white-space: nowrap;
        }
        .table tbody td {
            font-size: 14px;
            font-family: 'Roboto', Arial, 'Kalpurush', sans-serif !important;
            color: #475569;
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr:hover {
            background-color: #f8fafc;
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

    <div style="background-color: #f4faeb;">
        @include('frontend.layouts.header')
        <!-- Main Content Section -->
        <section id="main-content" class="container pt-3">
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

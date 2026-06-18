<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>CIOAS | @yield('title')</title>

  <!-- Google Fonts: Inter, Open Sans, Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&family=Source+Sans+Pro:300;400;400i;700&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css')}}">
  <!-- Bootstrap 5.3 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets') }}/style/cioas.css">
  <style type="text/css">
        /* Bootstrap 4 to 5 Spacing and Utility Compatibility Bridge */
        .mr-1 { margin-right: 0.25rem !important; }
        .mr-2 { margin-right: 0.5rem !important; }
        .mr-3 { margin-right: 1rem !important; }
        .mr-4 { margin-right: 1.5rem !important; }
        .mr-5 { margin-right: 3rem !important; }
        .mr-auto { margin-right: auto !important; }

        .ml-1 { margin-left: 0.25rem !important; }
        .ml-2 { margin-left: 0.5rem !important; }
        .ml-3 { margin-left: 1rem !important; }
        .ml-4 { margin-left: 1.5rem !important; }
        .ml-5 { margin-left: 3rem !important; }
        .ml-auto { margin-left: auto !important; }

        .pr-1 { padding-right: 0.25rem !important; }
        .pr-2 { padding-right: 0.5rem !important; }
        .pr-3 { padding-right: 1rem !important; }
        .pr-4 { padding-right: 1.5rem !important; }
        .pr-5 { padding-right: 3rem !important; }

        .pl-1 { padding-left: 0.25rem !important; }
        .pl-2 { padding-left: 0.5rem !important; }
        .pl-3 { padding-left: 1rem !important; }
        .pl-4 { padding-left: 1.5rem !important; }
        .pl-5 { padding-left: 3rem !important; }

        .float-left { float: left !important; }
        .float-right { float: right !important; }
        .text-right { text-align: right !important; }
        .text-left { text-align: left !important; }
  </style>
  @stack('style')

</head>
<body class="hold-transition login-page">

@yield('content')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 5.3 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{asset('public/backend/js/adminlte.min.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  </script>
<script>
    $(document).ready(function () {
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
        mapBS4toBS5(document);
    });
</script>
@stack('script')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>UPMS | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins') }}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend') }}/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/summernote/summernote-bs4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 17px !important;
        }

        .select2 {
            width: 100% !important;
        }

        .table-action {
            display: flex;
            gap: 8px;
        }
    </style>
    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @auth()
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center"> --}}
        {{-- <h3 class="animation__shake"><i class="fas fa-tachometer-alt"></i>UPMS</h3> --}}
        {{-- <img class="animation__shake" src="{{ asset('backend')}}/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> --}}
        {{-- </div> --}}

        <!-- Navbar -->
        @include('backend.layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('backend.layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    {{-- <script src="{{ asset('plugins')}}/jquery/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins') }}/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins') }}/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins') }}/sparklines/sparkline.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/jszip/jszip.min.js"></script>
    <script src="{{ asset('plugins') }}/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('plugins') }}/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins') }}/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins') }}/moment/moment.min.js"></script>
    <script src="{{ asset('plugins') }}/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}">
        < /scrip <!--Summernote-- > <
        script src = "{{ asset('plugins') }}/summernote/summernote-bs4.min.js" >
    </script>
    <!-- Select2 -->
    <script src="{{ asset('plugins') }}/select2/js/select2.full.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend') }}/js/adminlte.js"></script>

    <script src="{{ asset('backend') }}/js/demo.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#FormSubmit").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                let url = $(this).data('url');
                let red_url = $(this).data('redirect-url');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = red_url;
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })

            // delete item
            $(".deleteData").on('submit', function(e) {
                e.preventDefault();
                var thisForm = $(this);
                var formData = $(this).serialize();
                var deleteUrl = $(this).find(".deleteUrl").val();
                var redirectUrl = $(this).find(".redirect-url").val();

                
                $("#toast-container").show();
                toastr.success(
                    "<br /><button type='button' id='confirmationRevertNo' class='btn clear'>No</button><br /><button type='button' id='confirmationRevertYes' class='btn clear'>Yes</button>",
                    'Are you sure, you want to delete it?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationRevertYes").click(function() {
                                $.ajax({
                                    type: "DELETE",
                                    url: deleteUrl,
                                    data: formData,
                                    beforeSend: function() {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", true);
                                    },
                                    success: function(response) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        toastr.success(response.message);
                                        setTimeout(function() {
                                            location.href = redirectUrl;
                                        }, 2000)
                                    },
                                    error: function(xhr, status, error) {
                                        thisForm.find('button[type="submit"]')
                                            .prop("disabled", false);
                                        var responseText = jQuery.parseJSON(xhr
                                            .responseText);
                                        toastr.error(responseText.message);
                                        $.each(responseText.errors, function(
                                            key, val) {
                                            thisForm.find("." + key +
                                                "-error").text(val[
                                                0]);
                                        });
                                    }
                                });



                            });

                            $("#confirmationRevertNo").click(function() {
                                $("#toast-container").hide();
                            })
                        }
                    });
            })
        })
    </script>

    @stack('script')



</body>

</html>

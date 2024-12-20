<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/home/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/home/css/sb-admin-2.min.css')}}" rel="stylesheet">

    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- JQUERY 3.7.1 --}}
    <script src="{{ asset('assets/home/js/jquery.min.js') }}"></script>

    {{-- SELECT2 --}}
    <link href="{{ asset('assets/home/vendor/select2/select2.min.css') }}" rel="stylesheet" />

    {{-- TRIX --}}
    <link rel="stylesheet" href="{{ asset('assets/home/vendor/trix/trix.css') }}">

    <style>
        @font-face {
            font-family: 'Delicious Handrawn';
            src: url("{{ asset('assets/fonts/DeliciousHandrawn-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Delicious Handrawn', cursive;
            height: auto;
        }
        
        .shadow{
            box-shadow: 0 .5rem 1rem rgba($black, .15);
            box-shadow-sm: 0 .125rem .25rem rgba($black, .075);
            box-shadow-lg: 0 1rem 3rem rgba($black, .175);
            box-shadow-inset: inset 0 1px 2px rgba($black, .075);
        }
        .select2-container {
            z-index: 99;
        }

        .select2-selection {
            padding-top: 4px !important;
            height: 38px !important;
        }

        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('partials.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('partials.navbar')

                <!-- Begin Page Content -->
                <div class="container">
                    @yield('container')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Blog Site <script>document.write(new Date().getFullYear());</script></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/home/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/home/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/home/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('assets/home/vendor/chart.js/Chart.min.js')}}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('assets/home/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('assets/home/js/demo/chart-pie-demo.js')}}"></script> --}}

    {{-- SWEET ALERT --}}
    <script src="{{ asset('assets/home/vendor/sweetalert/sweetalert.js') }}"></script>

    {{-- SELECT2 --}}
    <script src="{{ asset('assets/home/vendor/select2/select2.min.js') }}"></script>

    {{-- TRIX --}}
    <script src="{{ asset('assets/home/vendor/trix/trix.js') }}"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>
</html>
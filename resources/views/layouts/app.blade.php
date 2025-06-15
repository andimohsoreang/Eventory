<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title> @yield('title', 'Default') | Eventory UPA TIK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

    @stack('links')
    <!-- App css -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <!-- Top Bar Start -->
    @include('components.topbar')
    <!-- Top Bar End -->

    <!-- leftbar-tab-menu -->
    @include('components.sidebar')
    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
                <!--Start Footer-->
                @include('components.footer')

                <!--end footer-->
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        <!-- Javascript  -->
        <!-- vendor js -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @stack('scripts')
        <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
        <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>

        <script src="{{ asset('dist/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
        <script src="{{ asset('dist/assets/js/pages/index.init.js') }}"></script>
        <script src="{{ asset('dist/assets/js/app.js') }}"></script>

</body>
<!--end body-->

</html>

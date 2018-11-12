<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sebelas</title>
    <meta name="description" content="Sebelas">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-touch-icon-60x60.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">

    <link rel="stylesheet" href="{{ asset('sufee/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sufee/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('sufee/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
	@stack('styles')
</head>

<body>

    @include('admin.layouts.sidebar')

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">			
		@include('admin.layouts.header')
		@yield('breadcrumb')
		@yield('content')
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('sufee/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('sufee/assets/js/main.js') }}"></script>


    <script src="{{ asset('sufee/vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <!--<script src="{{ asset('sufee/assets/js/dashboard.js') }}"></script>-->
    <!--<script src="{{ asset('sufee/assets/js/widgets.js') }}"></script>-->
    <script src="{{ asset('sufee/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('sufee/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('sufee/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('sufee/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
	@stack('scripts')
</body>

</html>

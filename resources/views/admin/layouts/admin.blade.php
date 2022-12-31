<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Focus Admin: Creative Admin Dashboard</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ url('dashboard/css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ url('dashboard/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ url('dashboard/css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('dashboard/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.1/datatables.min.css"/>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
</head>

<body>
    @include('admin.layouts.sidebar')
    @include('admin.layouts.header')
    @yield('content')

    <!-- jquery vendor -->
    <script src="{{ url('dashboard/js/lib/jquery.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <!-- nano scroller -->
    <script src="{{ url('dashboard/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ url('dashboard/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ url('dashboard/js/scripts.js') }}"></script>
    <!-- bootstrap -->

    <script src="{{ url('dashboard/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/calendar-2/pignose.init.js') }}"></script>


    <script src="{{ url('dashboard/js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/weather/weather-init.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/chartist/chartist.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('dashboard/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ url('dashboard/js/dashboard2.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.13.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script>
        window.showToast = function(message){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: message
    })
    }
    @if(session('message'))
        showToast('{{ session('message') }}')
    @endif
    </script>
    @stack('script')
</body>

</html>

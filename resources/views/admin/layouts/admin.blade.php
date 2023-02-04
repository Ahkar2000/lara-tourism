<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Miki TSM</title>
    <!-- ================= Favicon ================== -->
  <link href="{{ url('userdashboard/assets/img/logo.png') }}" rel="icon">
  <link href="{{ url('userdashboard/assets/img/logo.png') }}" rel="apple-touch-icon">

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
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="{{ url('userdashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.css">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.js"></script>
    

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

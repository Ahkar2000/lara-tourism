<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Thet Phoo Wai Tourism</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <!-- Favicons -->
  <link href="{{ url('userdashboard/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ url('userdashboard/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('userdashboard/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ url('userdashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ url('userdashboard/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('userdashboard/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ url('userdashboard/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

  <!-- Template Main CSS File -->
  <link href="{{ url('userdashboard/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

  @include('layouts.header')

  @yield('content')

  @include('layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ url('userdashboard/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ url('userdashboard/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ url('userdashboard/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ url('userdashboard/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ url('dashboard/js/lib/jquery.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('userdashboard/assets/js/main.js') }}"></script>
  @stack('script')
</body>

</html>
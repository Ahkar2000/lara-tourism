<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Miki TSM</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link href="{{ url('userdashboard/assets/img/logo.png') }}" rel="icon">
    <link href="{{ url('userdashboard/assets/img/logo.png') }}" rel="apple-touch-icon">
    <!-- Styles -->
    <link href="{{ url('dashboard/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ url('dashboard/css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-primary">

    @yield('content')

</body>

</html>
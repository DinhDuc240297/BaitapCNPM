<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin') }}</title>

      <!-- Bootstrap CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- bootstrap theme -->
    <link href="{{asset('css/bootstrap-theme.css')}}" rel="stylesheet">
      <!--external css-->
      <!-- font icon -->
    <link href="{{asset('css/elegant-icons-style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" />
      <!-- Custom styles -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="login-img3-body">
    <div id="app">


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

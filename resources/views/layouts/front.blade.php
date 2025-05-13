<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Campaign') }}</title>

    <!-- Fonts -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('css/frontpage.css')}}" rel="stylesheet">
  <link href="{{asset('css/fonts.css')}}" rel="stylesheet">

    <!-- Scripts -->
</head>
<body>
    

    @yield('content')
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>

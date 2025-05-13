<!doctype html>
<html lang="en" class="dark-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/bootstrap-extended.css')}}" rel="stylesheet" />
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('css/icons.css')}}" rel="stylesheet">
  <link href="{{asset('css/fonts.css')}}" rel="stylesheet">
  <link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">

  <!-- loader-->
	<link href="{{asset('css/pace.min.css')}}" rel="stylesheet" />

  <title>{{ config('app.name', 'Campaign Login') }}</title>
</head>

<body>

  <!--start wrapper-->
  <div class="wrapper">
    
       <!--start content-->
        <main class="authentication-content">
                @yield('content')
        </main>
        
       <!--end page main-->

  </div>
  <!--end wrapper-->


  <!--plugins-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/pace.min.js')}}"></script>


</body>

</html>
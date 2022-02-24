<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content="Manuel García"/>
  <title>Pokédex</title>
  <!--favicon-->
  <link rel="icon" href="{{url('assets/images/pokeball.png')}}" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="{{url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="{{url('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="{{url('assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{url('assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{url('assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{url('assets/css/app-style.css')}}" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme13">
 
<!-- Start wrapper-->
 <div class="my-authcontainer">
	
      @yield('content')
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{url('assets/js/jquery.min.js')}}"></script>
  <script src="{{url('assets/js/popper.min.js')}}"></script>
  <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
	
 <!-- simplebar js -->
  <script src="{{url('assets/plugins/simplebar/js/simplebar.js')}}"></script>
  <!-- sidebar-menu js -->
  <script src="{{url('assets/js/sidebar-menu.js')}}"></script>
  <!-- loader scripts -->
  <script src="{{url('assets/js/jquery.loading-indicator.js')}}"></script>
  <!-- Custom scripts -->
  <script src="{{url('assets/js/app-script.js')}}"></script>
  <!-- Chart js -->
  
  <script src="{{url('assets/plugins/Chart.js/Chart.min.js')}}"></script>
 
  <!-- Index js -->
  <script src="{{url('assets/js/index.js')}}"></script>

  
</body>
</html>
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
  
  <style>
  
      @font-face {
          font-family: pokemon;
          src: url({{url('assets/fonts/PokemonSolid.ttf')}});
      }
  
  </style>
  
</head>

<body class="bg-theme bg-theme13">

<!-- Start logout modal--> 
<div id="my-logoutcontainer" class="my-logoutcontainer">
  <div class="my-logoutcontainer-inner">
    <div class="my-logoutcontainer-text">
      <div>¿Estás seguro que quieres cerrar sesión?</div>
    </div>
    <div class="my-logoutbar"></div>
    <div class="my-logoutcontainer-btns">
      <div id="my-logoutbtn-cancelar" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #8a8a8a">
        <div>Cancelar</div>
      </div>
      <div id="my-logoutbtn-aceptar" class="my-loginbtn" style="color: white; font-size: 1.3em; border: none; outline: none; width: 150px; padding-left: 20px; padding-right: 20px; cursor: pointer; background-color: #db1a09">
        <div>Aceptar</div>
      </div>
    </div>
  </div>
</div>
<!-- End logout modal-->

<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo" style="border-bottom: 0">
      <a href="{{url('/base')}}">
       <img src="{{ url('assets/images/pokedex.png') }}" class="logo-icon" alt="logo icon">
       <h5 class="logo-text" style="font-family: pokemon; font-size: 1.3em;">Pokédex</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li style="margin-top: 30px !important; margin-bottom: 30px !important">
        <a href="{{url('pokemon')}}">
          <img src="{{url('assets/images/pokemonicon.png')}}" class="my-sidebaricons"> <span style="color: white !important">&nbsp;&nbsp;Pokémon</span>
        </a>
      </li>
    @if(auth()->user()->rol != 'Usuario')
      <li style="margin-top: 30px !important; margin-bottom: 30px !important">
        <a href="{{url('pokemontype')}}">
          <img src="{{url('assets/images/typeicon.png')}}" class="my-sidebaricons"> <span style="color: white !important">&nbsp;&nbsp;Tipos</span>
        </a>
      </li>

      <li style="margin-top: 30px !important; margin-bottom: 30px !important">
        <a href="{{url('pokemonability')}}">
          <img src="{{url('assets/images/abilityicon.png')}}" class="my-sidebaricons"> <span style="color: white !important">&nbsp;&nbsp;Habilidades</span>
        </a>
      </li>
      @endif
      @if(auth()->user()->rol == 'Admin')
      <li style="margin-top: 30px !important; margin-bottom: 30px !important">
        <a href="{{url('user')}}">
          <img src="{{url('assets/images/signinicon.png')}}" class="my-sidebaricons"> <span style="color: white !important">&nbsp;&nbsp;Usuarios</span>
        </a>
      </li>
      @endif
      
       <li style="margin-top: 30px !important; margin-bottom: 30px !important">
        <a href="{{url('/perfil')}}">
          <img src="{{url('assets/images/proficon.png')}}" class="my-sidebaricons"> <span style="color: white !important">&nbsp;&nbsp;Perfil</span>
        </a>
      </li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top" style="background-color: #cf3239 !important; box-shadow: 0 0 4px #a8282e">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    @if(\Request::route()->getName() == 'pokemon')
      @if(auth()->user()->rol != 'Usuario')
        <li class="nav-item">
          <a class="my-addnewpokemonbtn" href="{{url('pokemon/create')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
            <div>
              &nbsp;Nuevo Pokémon
            </div>
          </a>
        </li>
      @endif
    @endif
  </ul>

  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="{{url('assets/images/ashicon.jpg')}}" class="img-circle" alt="user avatar" style="border: 3px solid rgba(0, 0, 0, .75); box-sizing: content-box;"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a>
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="{{url('assets/images/ashicon.jpg')}}" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">{{auth()->user()->name}}</h6>
            <p class="user-subtitle">{{auth()->user()->email}}</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <div style="cursor: pointer;" id="my-logoutbtn">
            <li class="dropdown-item"><i class="icon-power mr-2"></i> Cerrar sesión</li>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper" style="padding: 0">
    <div class="container-fluid">

      @if(\Request::route()->getName() == 'base.base')
          <div class="mybase-container">
            <div style="background: url('{{url('assets/images/pokedex.png')}}') center center no-repeat; background-size: contain;
                    width: 200px; height: 200px; margin-top: -150px">
            </div>
            <div style="font-family: pokemon; font-size: 4.75em; color: #e6c120; text-shadow: 2px 2px 2px #e69020; margin-top: -200px">
              Pokédex
            </div>
          </div>
      @endif
      
      @if(\Request::route()->getName() != 'base.base')
          @yield('content')
      @endif
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button -->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
   
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
  <script src="{{url('assets/js/my-ownscript.js')}}"></script>
  
  @yield('js')
  
</body>
</html>
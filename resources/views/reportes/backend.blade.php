<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminlte/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <style>
    .user-menu>.dropdown-menu>.user-header {
      height: 175px;
      padding: 10px;
      text-align: center;
    }
    .info{
      width: 100%;
    }
    .user-menu .user-header {
      background-color: #3c8dbc;
    }
    .user-menu>.dropdown-menu>.user-footer {
      background-color: #f9f9f9;
      display: flex;
      justify-content: space-between;
      padding: 10px;
    }
    .user-menu>.dropdown-menu>.user-body a {
      color: #444;
    }
    #logoDashBor{
        background-size: 100% 100%;
        /* width: 50%; */
        height: auto;
        max-width: 100%;
        height: 30px;
        background-repeat: no-repeat;
        background-size: contain;
        margin: auto;
    }
    #logofavi{
        background-size: 100% 100%;
        /* width: 50%; */
        max-width: 100%;
        height: 30px;
        background-repeat: no-repeat;
        background-size: contain;
        margin: auto;
    }
    #logoletra{
        background-size: 100% 100%;
        width: 50%;
        max-width: 100%;
        height: 30px;
        background-repeat: no-repeat;
        background-size: contain;
        margin: auto;
    }
  </style>
  @stack('styles')
  <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links | Notifications | User info -->
    <ul class="navbar-nav ml-auto">
      <!-- Profile Dropdown Menu -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link" data-toggle="dropdown">
          <i class="fa fa-user-circle"></i>
          <span class="position">Gerente </span>{{ auth()->user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-item user-header text-white">
            <i class="fa fa-user fa-2x"></i>
            <p>
              {{ auth()->user()->name }} - Gerente
              <small class="d-block">Pequeña descripción de algo...</small>
            </p>
          </div>
          <div class="user-body">
            <div class="dropdown-item">
              <a href="#">Perfil</a>
            </div>
            <div class="dropdown-item">
              <a href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Salir
              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
          <img id="logofavi" src="{{ asset('img/favicon.png') }}" alt="AVCA Icono">
        <div class="info">
          <img id="logoletra" src="{{ asset('img/letras.png') }}" alt="AVCA Icono">
        </div>
      </div>
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image text-white">
          <i class="fa fa-user-circle"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      @include('reportes.nav')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          @yield('content')
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 <a href="{{ route('dashboard') }}">AVCA Reporte y Estadisticas</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Vue App -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!--Sweetalert-->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script src="{{ asset('js/reportar/main.js') }}"></script>

@stack('scripts')
</body>
</html>

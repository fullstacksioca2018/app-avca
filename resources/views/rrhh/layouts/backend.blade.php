<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }} | @yield('title')</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminlte/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
  <style>
    .user-menu>.dropdown-menu>.user-header {
      height: 175px;
      padding: 10px;
      text-align: center;
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
  </style>
  @stack('styles')
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
      <!-- Messages Dropdown Menu -->
      {{--@include('rrhh.layouts.partials.messages')--}}
      <!-- Notifications Dropdown Menu -->
      {{--@include ('rrhh.layouts.partials.notifications')--}}
      <!-- Profile Dropdown Menu -->
      @include('rrhh.layouts.partials.profile')
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('img/favicon.png') }}" alt="AVCA Icono" class="brand-image img-circle"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image text-white">
          <i class="fa fa-user-circle"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      {{-- Admin menu --}}
      @role('admin')
      @include('rrhh.layouts.partials.admin_nav')
      @endrole

      {{-- Gerente Menu --}}
      @role('gerente')
      @include('rrhh.layouts.partials.nav')
      @endrole

      {{-- Gerente de sucursal Menu --}}
      @role('gerente.sucursal')
      @include('rrhh.layouts.partials.sucursal_nav')
      @endrole

      {{-- Analista de area --}}
      @role('analista.area')
      @include('rrhh.layouts.partials.analista_nav')
      @endrole

      {{-- Analista de nómina --}}
      @role('analista.nomina')
      @include('rrhh.layouts.partials.nomina_nav')
      @endrole

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @yield('breadcrumb')
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" style="margin-left: 0; min-height: 100vh;">
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

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <strong>Copyright &copy; 2018 <a href="{{ route('dashboard') }}">AVCA RRHH</a>.</strong> Todos los derechos reservados.
    </div>
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
@stack('scripts')
</body>
</html>

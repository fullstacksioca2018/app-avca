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
    <nav class="navbar navbar-expand bg-dark navbar-light border-bottom">
        <a class="brand-link" href="#">
            <img src="{{ asset('img/favicon.png') }}" alt="Logo" class="brand-image img-circle">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
    </nav>
    @yield('content')
</body>
</html>
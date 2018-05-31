<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AVCA RRHH | @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fa-svg-with-js.css') }}">
  {{--<link rel="stylesheet" href="{{ asset('css/rrhh.css') }}">--}}
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <style type="text/css">
    ul.navbar-nav.ml-auto.mt-2.mt-lg-0.smooth-scroll{
      vertical-align: bottom;
      bottom: 0px;
      padding-top: 15px;
    
    }
    .header nav.navbar.navbar-expand-lg.fixed-top.header__navbar{
        padding: 16px;
        height: 84px;
        box-shadow: 0px 6px 9px 0px rgba(0, 0, 0, 0.36);
    }
    .header a.nav-link{
        padding: 10px 8px;
        text-decoration: none;
        display: inline-block;
        color: #fff;
        font-family: "Arial", "Geneva", sans-serif;
        font-weight: 700;
        font-size: 20px;
        outline: none;
    }
    .header svg.svg-inline--fa {
        margin-right: 5px;
   }
   li.nav-item.active {
        margin-left: 10px;
    }
    .btn-outline-primary{
      border: 0px;
    }
  a.nav-link.btn.btn-outline-light:hover{
    color: #000;
  }
  </style>
  @yield('styles')
</head>
<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg fixed-top header__navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="{{ asset('img/rrhh/logo-avca.png') }}" alt="Logo Avca" class="img-fluid" width="128">
        </a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 smooth-scroll">
            @if(\Illuminate\Support\Facades\Request::routeIs('home'))
            <li class="nav-item active">
              <a class="nav-link" href="#application">
                <i class="fas fa-briefcase"></i>
                Oportunidades <span class="sr-only">(Oportunidades)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#about">
                <i class="fas fa-child"></i>
                Nosotros <span class="sr-only">(¿Quienes sómos?)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#selection">
                <i class="fas fa-users"></i>
                Captación <span class="sr-only">(Captación)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#contact">
                <i class="fas fa-address-book"></i>
                Contáctenos <span class="sr-only">(Contáctenos)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-outline-light" href="/login">
                <i class="fas fa-lock"></i>
                Acceder <span class="sr-only">(Acceder al sistema)</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main id="app">
    @yield('content')
  </main>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
  @yield('scripts')
</body>
</html>
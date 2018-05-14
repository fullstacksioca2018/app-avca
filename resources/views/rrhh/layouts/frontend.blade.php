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
  @yield('styles')
</head>
<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg fixed-top header__navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="#start">
          <img src="{{ asset('img/rrhh/logo-avca.png') }}" alt="Logo Avca" class="img-fluid" width="128">
        </a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 smooth-scroll">
            <li class="nav-item active">
              <a class="nav-link" href="#application">Oportunidades <span class="sr-only">(Oportunidades)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#about">¿Quienes sómos? <span class="sr-only">(¿Quienes sómos?)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#selection">Captación <span class="sr-only">(Captación)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#contact">Contáctenos <span class="sr-only">(Contáctenos)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-info" href="/login">
                Acceder <span class="sr-only">(Acceder al sistema)</span>
                <i class="fas fa-lock"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main id="rrhh">
    @yield('content')
  </main>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
  @yield('scripts')
</body>
</html>
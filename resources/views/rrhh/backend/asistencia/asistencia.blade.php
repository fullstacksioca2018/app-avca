<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">  
  <link rel="stylesheet" href="/adminlte/plugins/font-awesome/css/font-awesome.min.css">
</head>
<body>
  <nav class="navbar navbar-expand bg-dark navbar-light border-bottom">
    <a class="brand-link text-center mx-auto" href="#">
      <img src="{{ asset('img/favicon.png') }}" alt="Logo" class="brand-image img-circle mx-auto">
      <span class="brand-text font-weight-bold ml-2">AVCA</span>
    </a>
  </nav>
  <main id="app" style="min-height: 100vh;">
    <div class="container my-5">
      <div class="row">
        <div class="col-md-10 offset-md-1">

          <div class="card">
            <div class="card-header bg-info-gradient d-flex justify-content-between">
              <span>Registro de asistencia</span>
              <span class="date ml-auto">
                {{-- \Carbon\Carbon::now()->format('d/m/Y H:i:s') --}}                
              </span>
            </div>
            <div class="card-body">
              <empleado></empleado>
            </div>
            <div class="card-footer">
              <reloj></reloj>            
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
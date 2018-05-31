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
</head>
<body>

  <main id="app" style="min-height: 100vh;">
    <div class="container my-5">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="card">
            <div class="card-header bg-info-gradient">Registro de asistencia</div>
            <div class="card-body">
              <empleado></empleado>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    var vm =  new Vue({

    })
  </script>
</body>
</html>
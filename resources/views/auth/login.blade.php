<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>Avca - Modulo Operativo</title>

    <!-- Icons-->
    <link href="{{asset('flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">

    
    <link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">
   

    <!-- Bootstrap and necessary plugins-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/coreui.min.js')}}"></script>

   
    <!-- Datepicker-->
    
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>

    <script src="{{asset('js/plus.js')}}"></script>

  </head>
 <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <h1>Inicio de Sesión</h1>
                <p class="text-muted">Iniciar sesión en su cuenta</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>                
                   <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary px-4">Entrar</button>
                  </div>
                  <div class="col-6 text-right">
                  
                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ __('No recuerdo mi clave?') }}
                                </a>
                  </div>
                </div>
            </form>
              </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Registrarse</h2>
                  <p>Todo registro debe quedara en espera, y deberá ser parobado por el personal de Recursos Humanos</p>
                  <button type="button" class="btn btn-primary active mt-3">Solicitar Registro!</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
</html>




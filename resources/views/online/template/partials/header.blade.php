 <!--==========================
    Header
  ============================-->
<header id="header">
    <div class="container-fluid">

   <div id="logo" class="pull-left"><img src="{{ asset('online/img/logo.png') }}" height="50" class="d-inline-block align-top" alt="AVCA">
       
      </div>

      <nav id="nav-menu-container" class="navbar navbar-trans navbar-expand-lg justify-content-end">
        <ul class="nav-menu">
          <li class="nav-item"><i class="fa fa-home"></i><a href="{{ route('cliente.index1') }}">Inicio</a></li>
          <li><i class="fa fa-group"></i><a href="{{ URL::to('rrhh/frontend') }}">Nosotros</a></li>
          <li><i class="fa fa-globe"></i><a href="#portfolio">Destinos</a></li>
          <li class="menu-has-children"><i class="fa fa-briefcase"></i></i><a href="">Guía al Pasajero</a>
            <ul>
              <li><a href="{{ route('cliente.equipaje') }}">Equipaje</a></li>
              <li><a href="{{ route('cliente.documentacion') }}">Documentación</a></li>
            
            </ul>
          </li>
          @if (Auth::guest())
           <li><i class="ion-person"></i><a href="#" data-toggle="modal" data-target="#Login"> Iniciar sesión</a></li>
          <li><i class="ion-person-add"></i><a href="#" data-toggle="modal" data-target="#Register"> Registrarse</a></li>
          @else
          <li class="dropdown" class="nav-item">
            <a class="nav-link" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="nav-item">
                <a class="dropdown-item mr-2" href="{{ url('/online/logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Salir
                </a>
                <form id="logout-form" action="{{ route('online.logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
              <li class="nav-item"><a class="dropdown-item" href="#">Mi cuenta</a></li>
            </ul>
          </li>
          @endif
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
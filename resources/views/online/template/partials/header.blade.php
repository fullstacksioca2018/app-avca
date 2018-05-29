 <!--==========================
    Header
  ============================-->
<header id="header">
    <div class="container-fluid">

   <div id="logo" class="pull-left"><a href="{{ route('cliente.index1') }}" title="inicio"><img src="{{ asset('online/img/logo.png') }}" height="50" class="d-inline-block align-top" alt="AVCA"></a>
       
      </div>

      <nav id="nav-menu-container" class="navbar navbar-trans navbar-expand-lg justify-content-end">
        <ul class="nav-menu">
          <li class="nav-item"><i class="fa fa-home"></i><a href="{{ route('cliente.index1') }}">Inicio</a></li>
          <li><i class="fa fa-group"></i><a href="{{ URL::to('rrhh/frontend') }}">Nosotros</a></li>
          <li><i class="fa fa-globe"></i><a href="#portfolio">Destinos</a></li>
          <li class="menu-has-children"><i class="fa fa-briefcase"></i></i><a href="">Guía al Pasajero</a>
            <ul>
            
            @if (Auth::guest())

              <li><a href="{{ route('cliente.equipaje') }}">Equipaje</a></li>
              <li><a href="{{ route('cliente.documentacion') }}">Documentación</a></li>

            @else
              
              <li><a href="{{ URL::to('/online/cliente/equipaje') }}">Equipaje</a></li>
              <li><a href="{{ URL::to('/online/cliente/documentacion') }}">Documentación</a></li>
            
            @endif

            
            </ul>
          </li>
          

          @if (Auth::guest())
          <li class="menu-has-children"></i><i class="fa fa-lock"></i><a href="">Acceder</a>
            <ul>
              <li><a href="#" data-toggle="modal" data-target="#Login"> Iniciar sesión</a></li>
              <li><a href="#" data-toggle="modal" data-target="#Register"> Registrarse</a></li>
            </ul>
          </li>
          @else



          <li><i></i><a href="#" data-toggle="modal" data-target="#Checkin"> Check-in</a></li>
          {{-- <li><i></i><a href=" {{ URL::to('/online/cliente/ConsultarBoleto') }}"> Mis Boletos</a></li> --}}
          <li class="menu-has-children">
             <a href="#"> {{ Auth::guard('online')->user()->name }} <span class="caret"></span>
            </a>
            <ul {{-- class="dropdown-menu" --}}>
              <li><a  href="{{ URL::to('/online/cliente/MiPerfil', Auth::guard('online')->user()->id) }}">Mi perfil</a></li>
              <li><a href="{{ URL::to('/online/cliente/ModificarPerfil', Auth::guard('online')->user()->id) }}">Modificar perfil</a></li>
              <li>
                <a href="{{ url('/online/logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
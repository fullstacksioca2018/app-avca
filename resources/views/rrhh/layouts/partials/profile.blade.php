<li class="nav-item dropdown user-menu">
  <a href="#" class="nav-link" data-toggle="dropdown">
    <i class="fa fa-user-circle"></i>
    {{ auth()->user()->name }}
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <div class="dropdown-item user-header text-white">
      <i class="fa fa-user fa-2x"></i>
      <p>
        {{ auth()->user()->name }} -
        @if(auth()->user()->isRole('admin'))
          <span class="position">Administrador </span>
          <small class="d-block">Administrador de RRHH</small>
        @elseif(auth()->user()->isRole('gerente'))
          <span class="position">Gerente </span>
          <small class="d-block">Gerente de RRHH</small>
        @elseif(auth()->user()->isRole('analista.area'))
          <span class="position">Analista </span>
          <small class="d-block">Analista de área</small>
        @elseif(auth()->user()->isRole('gerente.sucursal'))
          <span class="position">Gerente </span>
          <small class="d-block">Gerente de sucursal</small>
        @elseif(auth()->user()->isRole('analista.nomina'))
          <span class="position">Analista </span>
          <small class="d-block">Analista de nómina</small>
        @elseif(auth()->user()->isRole('empleado'))
          <span class="position">Empleado </span>
          <small class="d-block">Empelado de AVCA</small>
        @endif
      </p>
    </div>
    <div class="user-body">
      {{--<div class="dropdown-item">
        <a href="#">Acción 1</a>
      </div>
      <div class="dropdown-item">
        <a href="#">Acción 2</a>
      </div>--}}
    </div>
    <div class="dropdown-divider"></div>
    <div class="dropdown-item user-footer">
      {{--<a href="{{ route('dashboard.empleado') }}" class="btn btn-default">Perfil</a>--}}
      <span></span>
      {{--<a href="#" class="btn btn-default">Salir</a>--}}
      <a class="btn btn-default pull-right" href="{{ route('logout') }}"
         onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i>{{ __('Salir') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </div>
</li>
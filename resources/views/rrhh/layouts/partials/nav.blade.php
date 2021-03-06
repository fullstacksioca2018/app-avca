<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia de RRHH
          <i class="right fa fa-angle-down"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        @if(request()->is('rrhh/backend/seleccion/*')))
        <li class="nav-item has-treeview menu-open">
        @else
        <li class="nav-item has-treeview">
        @endif
          <a href="#" class="{{ request()->route('dashboard') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-users nav-icon"></i>
            <p>Captación <i class="right fa fa-angle-down"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @if (request()->is('rrhh/backend/vacante/*'))
            <li class="nav-item has-treeview menu-open">
            @else
            <li class="nav-item has-treeview">
            @endif
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Reclutamiento Externo <i class="right fa fa-angle-down"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('vacante.create') }}" class="{{ request()->routeIs('vacante.create') ? 'nav-link active' : 'nav-link' }}">
                    <p style="padding-left: 3rem;">Vacantes</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('aspirantes.areas') }}" class="{{ request()->routeIs('aspirantes.areas') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Selección</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('contratacion.form') }}" class="{{ request()->routeIs('contratacion.form') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Contratación</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('empleados.list') }}" class="{{ request()->routeIs('empleados.list') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Contrato laboral</p>
              </a>
            </li>
          </ul>
        </li>        
        <li class="nav-item">
          <a href="{{ route('perfil.empleados') }}" class="{{ request()->routeIs('perfil.empleados') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-user nav-icon"></i>
            <p>Datos del empleado</p>
          </a>
        </li>
        {{--Administracion de nominas--}}
        @if(request()->is('rrhh/backend/nomina/*'))
        <li class="nav-item has-treeview menu-open">
        @else
        <li class="nav-item has-treeview">
        @endif
          <a href="#" class="nav-link">
            <i class="fa fa-file nav-icon"></i>
            <p>Nóminas <i class="right fa fa-angle-down"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('nomina.consult') }}" class="{{ request()->routeIs('nomina.consult') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Consultar</p>
              </a>
            </li>            
          </ul>
        </li>
        {{--Modulo de mantenimiento--}}
        @if(request()->is('rrhh/backend/mantenimiento/*'))
        <li class="nav-item has-treeview menu-open">
        @else
        <li class="nav-item has-treeview">
        @endif
          <a href="#" class="nav-link">
            <i class="fa fa-cog nav-icon"></i>
            <p>Mantenimiento <i class="right fa fa-angle-down"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cargo.list') }}" class="nav-link">
                <p style="padding-left: 1.5rem;">Cargos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Calendario feriado</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('parametros.list') }}" class="{{ request()->routeIs('parametros.list') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Parámetros de nóminas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sucursal.list') }}" class="{{ request()->routeIs('sucursal.list') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Sucursales</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('reportes.rrhh') }}" class="{{ request()->routeIs('reportes.rrhh') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fa fa-bar-chart"></i>
            <p>
              Reportes y estadísticas
            </p>
          </a>
        </li>

        {{--  Opcion para el gerente de la sucursal  --}}
      <!--  <li class="nav-item">
          <a href="{{ route('asistencia.register') }}" class="{{ request()->routeIs('asistencia.register') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fa fa-clock-o"></i>
            <p>
              Asistencia
            </p>
          </a>
        </li>-->


      </ul>
    </li>
  </ul>
</nav>
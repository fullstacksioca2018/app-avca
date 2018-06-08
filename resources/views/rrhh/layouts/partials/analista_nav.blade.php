<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-cogs"></i>
        <p>
          Analista de área
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
            <li class="nav-item">
              <a href="{{ route('aspirantes.areas') }}" class="{{ request()->routeIs('aspirantes.areas') ? 'nav-link active' : 'nav-link' }}">
                <p style="padding-left: 1.5rem;">Selección</p>
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
          <a href="{{ route('empleado.profile') }}" class="{{ request()->routeIs('empleado.profile') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-user nav-icon"></i>
            <p>Datos del empleado</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('empleado.profile') }}" class="{{ request()->routeIs('empleado.profile') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-user-secret nav-icon"></i>
            <p>Empleados</p>
          </a>
        </li>        
      </ul>
    </li>
  </ul>
</nav>
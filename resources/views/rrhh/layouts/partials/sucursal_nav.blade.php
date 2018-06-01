<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-cogs"></i>
        <p>
          Sucursal
          <i class="right fa fa-angle-down"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('empleados.sucursal', auth()->user()->empleado->sucursal_id) }}" class="{{ request()->routeIs('empleados.sucursal') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-users nav-icon"></i>
            <p>Personal</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('empleados.sucursal.asistentes', auth()->user()->empleado->sucursal_id) }}" class="{{ request()->routeIs('empleados.sucursal.asistentes') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-clock-o nav-icon"></i>
            <p>Asistencia</p>
          </a>
        </li>
        {{--Calendario feriado--}}
        <li class="nav-item">            
          <a href="{{ route('calendario.feriado', auth()->user()->empleado->sucursal_id) }}" class="{{ request()->routeIs('calendario.feriado') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-calendar nav-icon"></i>
            <p>Calendario feriado</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
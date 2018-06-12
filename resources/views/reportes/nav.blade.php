<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia General
          <i class="right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview menu-open">
          <a href="{{ URL::to('/reportes')}}" id="reportesnav" class="nav-link">
            <i class="fa fa-home nav-icon"></i>
            <p>Inicio <i class="right"></i></p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="{{ URL::to('/reportes/panel') }}" id="panelnav" class="nav-link">
            <i class="fa  fa-line-chart nav-icon"></i>
            <p>Reportes y Estadísticas<i class="right"></i></p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="{{ URL::to('/reportes/pronostico') }}" id="panelpronostico" class="nav-link">
            <i class="fa  fa-bar-chart nav-icon"></i>
            <p>Proyección y Pronóstico<i class="right"></i></p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
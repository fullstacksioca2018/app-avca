<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia General
          <i class="right fa fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview menu-open">
          <a href="{{ URL::to('/reportes')}}" class="nav-link">
            <i class="fa fa-users nav-icon"></i>
            <p>Inicio <i class="right fa fa-angle-left"></i></p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="{{ URL::to('/reportes/panel') }}" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>Reportes y Estadisticas<i class="right fa fa-angle-left"></i></p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
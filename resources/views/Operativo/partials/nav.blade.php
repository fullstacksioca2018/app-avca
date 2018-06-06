<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia de Sucursales
          <!-- <i class="right fa fa-angle-left"> --></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <!-- INICIO DE TAQUILLA -->
        <li class="nav-item has-treeview">
          <a href="{{ URL::to('/taquilla') }}" class="nav-link">
            <i class="fa fa-users nav-icon"></i>
            <p>Taquilla <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="{{ URL::to('/taquilla') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Gestionar Taquilla  <i class="right fa fa-angle-left"></i></p>
              </a>
            </li>
            <!-- <ul class="nav nav-treeview"> -->
                <li class="nav-item">
                  <a href="{{ URL::to('/check') }}" class="nav-link">
                    <i class="fa fa-check nav-icon"></i>
                    <p>Chequear Boleto</p>
                  </a>
                </li>
              <!-- </ul> -->
          </ul>
        </li>
        <!-- HASTA AQUI TAQUILLA -->
        <!--   INICIO DE VUELOS -->
        <li class="nav-item has-treeview">
          <a href="{{ URL::to('/vuelos') }}" class="nav-link">
            <i class="fa fa-plane nav-icon"></i>
            <p>Administracion de Vuelo <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ URL::to('/vuelos') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p> Planificar Vuelos</p>
              </a>
            </li>
          </ul>
        </li>
       <!--  FINAL DE VUELOS  -->
        <!-- INICIO DE RUTAS  -->
        <li class="nav-item has-treeview">
          <a href="{{ URL::to('/rutas') }}" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>Admin. de Rutas <i class="right fa fa-angle-left"> </i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ URL::to('/rutas') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Planificar Rutas</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- FINAL DE RUTAS  -->
      <!--  INICIO DE MANTENIMIENTO  -->
        <li class="nav-item has-treeview">
          <a  class="nav-link">
            <i class="fa fa-gear nav-icon"></i>
            <p>Mantenimiento <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ URL::to('/aeronave') }}" class="nav-link">
                <i class="fa fa-fighter-jet nav-icon"></i>
                <p>Planificar Aeronave</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ URL::to('/sucursales') }}" class="nav-link">
                <i class="fa fa-map-marker nav-icon"></i>
                <p>Planificar Sucursales</p>
              </a>
            </li>
          </ul>
        </li>
       <!--  FINAL DE Mantenimiento  -->
       <!-- INICIO DE REPORTES Y ESTADISTICAS  -->
        <li class="nav-item">
          <a href="{{ URL::to('/reporte/operativo') }}" class="nav-link">
            <i class="nav-icon fa fa-bar-chart"></i>
            <p>
              Reportes y estadísticas
            </p>
          </a>
        </li>
        <!-- FINAL DE REPORTES Y ESTADISTICAS  -->
      </ul>
    </li>
  </ul>
</nav>
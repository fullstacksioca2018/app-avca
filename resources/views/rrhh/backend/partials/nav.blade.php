<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia de RRHH
          <i class="right fa fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link active">
            <i class="fa fa-users nav-icon"></i>
            <p>Captación <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Reclutamiento <i class="right fa fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Interno</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Externo</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('seleccion.list') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Selección</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Contratación</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>Datos del empleado <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Datos personales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Carga familiar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Datos laborales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Cargar oficios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Beneficios laborales</p>
              </a>
            </li>
          </ul>
        </li>
        {{--Administracion de nominas--}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa fa-file nav-icon"></i>
            <p>Nóminas <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Cesta ticket</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Especiales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Regulares</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Pasivos laborales</p>
              </a>
            </li>
          </ul>
        </li>
        {{--Modulo de mantenimiento--}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa fa-cog nav-icon"></i>
            <p>Mantenimiento <i class="right fa fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('cargo.list') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Cargos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Calendario feriado</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Parámetros de nóminas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Dependencias</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Sucursales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('vacante.create') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Vacantes</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-bar-chart"></i>
            <p>
              Reportes y estadísticas
            </p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
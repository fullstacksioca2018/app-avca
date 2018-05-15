<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-dashboard"></i>
        <p>
          Gerencia de RRHH
          <i class="right fa fa-angle-down"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link active">
            <i class="fa fa-users nav-icon"></i>
            <p>Captación <i class="right fa fa-angle-down"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Reclutamiento Interno</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Reclutamiento Externo <i class="right fa fa-angle-down"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('vacante.create') }}" class="nav-link">
                    <p style="padding-left: 3rem;">Vacantes</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('seleccion.list') }}" class="nav-link">
                <p style="padding-left: 1.5rem;">Selección</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('contratacion.form') }}" class="nav-link">
                <p style="padding-left: 1.5rem;">Contratación</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('empleado.profile') }}" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>Datos del empleado</p>
          </a>
        </li>
        {{--Administracion de nominas--}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fa fa-file nav-icon"></i>
            <p>Nóminas <i class="right fa fa-angle-down"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Cesta ticket</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Especiales</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Regulares</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Pasivos laborales</p>
              </a>
            </li>
          </ul>
        </li>
        {{--Modulo de mantenimiento--}}
        <li class="nav-item has-treeview">
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
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Parámetros de nóminas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Dependencias</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p style="padding-left: 1.5rem;">Sucursales</p>
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
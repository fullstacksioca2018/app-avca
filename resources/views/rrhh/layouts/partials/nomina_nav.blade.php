<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fa fa-cogs"></i>
                <p>
                    Analista de nómina
                    <i class="right fa fa-angle-down"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
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
                                <p style="padding-left: 1.5rem;">
                                    <i class="fa fa-search"></i> Consultar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nomina.generate') }}" class="{{ request()->routeIs('nomina.generate') ? 'nav-link active' : 'nav-link' }}">
                                <p style="padding-left: 1.5rem;">
                                    <i class="fa fa-plus"></i> Generar
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nomina.generadas') }}" class="{{ request()->routeIs('nomina.generadas') ? 'nav-link active' : 'nav-link' }}">
                                <p style="padding-left: 1.5rem;">
                                    <i class="fa fa-eye"></i> Generadas
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>       
                <li class="nav-item">
                    <a href="{{ route('nomina.empleados') }}" class="{{ request()->routeIs('nomina.empleados') ? 'nav-link active' : 'nav-link' }}">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Empleados</p>
                    </a>
                </li>   
            </ul>
        </li>
    </ul>
  </nav>
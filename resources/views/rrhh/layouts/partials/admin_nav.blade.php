<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item has-treeview menu-open">
      <a href="#" class="nav-link active">
        <i class="nav-icon fa fa-cogs"></i>
        <p>
          Administración
          <i class="right fa fa-angle-down"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">        
          <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-users nav-icon"></i>
            <p>Usuarios</p>
          </a>
        </li>
        {{--Roles--}}
        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index') ? 'nav-link active' : 'nav-link' }}">
            <i class="fa fa-users nav-icon"></i>
            <p>Roles</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
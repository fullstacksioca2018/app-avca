<header class="app-header navbar">

<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
  <span class="navbar-toggler-icon"></span>
</button>

<a class="navbar-brand" href="#"></a>

<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
  <span class="navbar-toggler-icon"></span>
</button>

<ul class="nav navbar-nav d-md-down-none">
  <li class="nav-item px-3">
    <a class="nav-link" href="#">RRHH</a>
  </li>
  <li class="nav-item px-3">
    <a class="nav-link" href="#">Analisis de Datos</a>
  </li>
</ul>

<ul class="nav navbar-nav ml-auto">
 

  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-header text-center">
        <strong> {{ Auth::user()->name }}</strong>
      </div>
      <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
      <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
   
       <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  <i class="fa fa-lock"></i>{{ __('Logout') }}
                              </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
    </div>
  </li>
</ul>
<button class="navbar-toggler aside-menu-toggler" type="button">
  <span class="navbar-toggler-icon"></span>
</button>
</header>
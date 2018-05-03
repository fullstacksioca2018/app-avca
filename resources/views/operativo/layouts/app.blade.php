
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>Avca - Modulo Operativo</title>

    <!-- Icons-->
    <link href="{{asset('flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">

    
    <link href="{{asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('css/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-chosen.css')}}" rel="stylesheet">

   

    <!-- Bootstrap and necessary plugins-->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <script src="{{asset('js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/coreui.min.js')}}"></script>
    <script src="{{asset('js/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/jspersonal.js')}}"></script>
   

   
    <!-- Datepicker-->
    
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('js/vue-select.js')}}"></script>

   

    

  </head>

  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    @include('operativo.layouts.header')

    <div class="app-body">
      @include('operativo.layouts.menu')
      <main class="main">
        
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Inicio</li>
          <li class="breadcrumb-item">
            <a href="#">Principal</a>
          </li>
          <li class="breadcrumb-item active">Tablero</li>
          <!-- Breadcrumb Menu-->
         
        </ol>
        
        @yield('content')

            
            

           

           
      

       
      </main>
    
    </div>
    <footer class="app-footer">
      <div>
        <a href="#">Modulo Operativo</a>
        <span>&copy; 2018 Avca.</span>
      </div>
     
    </footer>

    



  </body>
</html>




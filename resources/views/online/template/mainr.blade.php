<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AVCA</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

 <!--Datepicker funcional -->
  <link rel="stylesheet" href="{{ asset('plugins/lib/datepicker/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
 
  <script src="{{ asset('plugins/lib/jquery/jquery.min.js') }}"></script>
  
  <script src="{{ asset('plugins/lib/datepicker/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('plugins/lib/datepicker/jquery-ui-1.12.1.custom/datepicker-es.js') }}"></script>
  <script src="{{ asset('plugins/lib/datepicker/jquery-ui-1.12.1.custom/maindatepicker.js') }}"></script>

<link rel="stylesheet" href="{{ asset('plugins/lib/font-awesome/css/font-awesome.min.css') }}">
<!-- Bootstrap CSS File -->
  <link href="{{ asset('plugins/lib/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

  <!-- Materail-Bootstrap CSS File -->
  <link href="{{ asset('plugins/lib/MDB/css/mdb.css') }}" rel="stylesheet">
  <script src="{{ asset('plugins/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/MDB/js/mdb.js') }}"></script>
  <script src="{{ asset('plugins/lib/MDB/js/popper.min.js') }}"></script>

<!-- Libraries CSS Files -->
  <link href="{{ asset('plugins/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
   <link href="{{ asset('plugins/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/css/equipaje.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/css/destinos.css') }}" rel="stylesheet">


  <!-- Main Stylesheet File -->
  
  <script src="{{ asset('plugins/lib/jquery/jquery-migrate.min.js') }}"></script>

<script src="{{ asset('plugins/lib/lightbox/js/lightbox.min.js') }}"></script>

  <script src="{{ asset('plugins/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ asset('plugins/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/lightbox/lightbox.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('plugins/lib/sticky/sticky.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('plugins/contactform/contactform.js') }}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('plugins/js/main.js') }}"></script>

<!--Lo del selcet de la busqueda para las compra boleto-->
<link rel="stylesheet" href="{{ asset('plugins/lib/chosen/chosen.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/lib/chosen/bootstrap-chosen.css') }}">
<script src="{{ asset('plugins/lib/chosen/prueba.js') }}"></script>
<script src="{{ asset('plugins/lib/chosen/chosen.jquery.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
  $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: false });
      });
</script></script>
<!--Lo del Select de la busqueda para las compra boleto -->


<!--Lo del Select niños en brazos y esas cosas Main JS-->
<script src="{{ asset('js/prueba.js') }}"></script>
<script src="{{ asset('js/jspersonal.js') }}"></script>
  <script src="{{ asset('js/formulario.js') }}"></script>
<!--Lo del Select niños en brazos y esas cosas Main JS -->

</head>

<body id="body">
  
  @include('cliente.template.partials.ModalLogin') 
  @include('cliente.template.partials.ModalRegister')
  @include('cliente.template.partials.topbar')
  @include('cliente.template.partials.header')
  @include('cliente.template.partials.erros')
  @yield('content')
  @include('cliente.template.partials.footer')


   <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


</body>
</html>

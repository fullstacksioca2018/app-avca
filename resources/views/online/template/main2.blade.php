<!DOCTYPE html>
<html lang="es">
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
{{--   <link rel="stylesheet" href="{{ asset('online/plugins/lib/datepicker/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}"> --}}
 
  <script src="{{ asset('online/plugins/lib/jquery/jquery.min.js') }}"></script>
  {{-- 
  <script src="{{ asset('online/plugins/lib/datepicker/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
 <script src="{{ asset('online/plugins/lib/datepicker/jquery-ui-1.12.1.custom/datepicker-es.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/datepicker/jquery-ui-1.12.1.custom/maindatepicker.js') }}"></script> --}}

<link rel="stylesheet" href="{{ asset('online/plugins/lib/font-awesome/css/font-awesome.css') }}">
<!-- Bootstrap CSS File -->
  <link href="{{ asset('online/plugins/lib/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

  <!-- Materail-Bootstrap CSS File -->
  <link href="{{ asset('online/plugins/lib/MDB/css/mdb.css') }}" rel="stylesheet">
  <script src="{{ asset('online/plugins/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/MDB/js/mdb.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/MDB/js/popper.min.js') }}"></script>

<!-- Libraries CSS Files -->
  <link href="{{ asset('online/plugins/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('online/plugins/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('online/plugins/lib/wowalerta/css/wow-alert.css') }}">

  <!-- Main Stylesheet File -->
  <link href="{{ asset('online/css/estilomod.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/destinos.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/estilocompras.css') }}" rel="stylesheet">
   <link href="{{ asset('online/css/estilomodallogin.css') }}" rel="stylesheet">
   <link href="{{ asset('online/css/userconsulta.css') }}" rel="stylesheet">
@yield('style')


  <!-- Main Stylesheet File -->
  
  <script src="{{ asset('online/plugins/lib/jquery/jquery-migrate.min.js') }}"></script>

<script src="{{ asset('online/plugins/lib/lightbox/js/lightbox.min.js') }}"></script>

  <script src="{{ asset('online/plugins/lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/wow/wow.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/isotope/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/lightbox/lightbox.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('online/plugins/lib/sticky/sticky.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <script src="{{ asset('online/plugins/lib/wowalerta/js/wow-alert.js') }}" type="text/javascript"></script> 
  <!-- Contact Form JavaScript File -->
  <script src="{{ asset('online/plugins/contactform/contactform.js') }}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ asset('online/plugins/js/main.js') }}"></script>

<!--Lo del selcet de la busqueda para las compra boleto-->
<link rel="stylesheet" href="{{ asset('online/plugins/lib/chosen/chosen.css') }}">
<link rel="stylesheet" href="{{ asset('online/plugins/lib/chosen/bootstrap-chosen.css') }}">
<script src="{{ asset('online/plugins/lib/chosen/prueba.js') }}"></script>
<script src="{{ asset('online/plugins/lib/chosen/chosen.jquery.js') }}" type="text/javascript" charset="utf-8"></script>
<script>
  $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: false });
      });
</script>
<!--Lo del Select de la busqueda para las compra boleto -->


<!--Lo del Select niños en brazos y esas cosas Main JS-->
<script src="{{ asset('online/js/prueba.js') }}"></script>
<script src="{{ asset('online/js/jspersonal.js') }}"></script>
<script src="{{ asset('online/js/formulario.js') }}"></script>
<script src="{{ asset('online/js/multidestino.js') }}"></script>

<!--Lo del Select niños en brazos y esas cosas Main JS -->

{{--======================================================
                        scritp propios 
    ======================================================--}}



</head>

<body id="body">
  
  @include('online.template.partials.ModalLogin') 
  @include('online.template.partials.ModalRegister')
  @include('online.template.partials.ModalCheckin')
  @include('online.template.partials.header')
  @include('online.template.partials.erros')
  @include('flash::message')
  @yield('content')
  @include('online.template.partials.footer')


   <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  
  <style type="text/css">
  .oculta{
    display: none;
  }
</style>
@yield('scripts')

  <script>
    $('div.alert').delay(5000).fadeOut(350);
  </script>
</body>
</html>

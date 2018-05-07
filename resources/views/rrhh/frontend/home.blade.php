@extends ('rrhh.layouts.frontend')

@section('styles')
  {{-- Owl Carousel --}}
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
@endsection

@section('content')
  {{-- Cabecera --}}
  @include('rrhh.frontend.partials.hero')

  {{-- Seccion de postulaciones --}}
  <!-- @include('rrhh.frontend.partials.applications') -->

  {{-- About --}}
  @include('rrhh.frontend.partials.about')

  {{-- Proceso de seleccion --}}
  @include('rrhh.frontend.partials.selection')

  {{-- Contactenos --}}
  @include('rrhh.frontend.partials.contact')

@endsection

@section('scripts')
  <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      // Select all links with hashes
      $('a[href*="#"]')
      // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
          // On-page links
          if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
          ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
              // Only prevent default if animation is actually gonna happen
              event.preventDefault();
              $('html, body').animate({
                scrollTop: target.offset().top
              }, 1000, function() {
                // Callback after animation
                // Must change focus!
                var $target = $(target);
                $target.focus();
                if ($target.is(":focus")) { // Checking if the target was focused
                  return false;
                } else {
                  $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                  $target.focus(); // Set focus again
                };
              });
            }
          }
        });

      //  Carousel
      $(".owl-carousel").owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:2
          },
          1000:{
            items:4
          }
        }
      });
    });
  </script>
  <!-- Include this after the sweet alert js file -->
  <!-- @ include('sweet::alert') -->
@endsection

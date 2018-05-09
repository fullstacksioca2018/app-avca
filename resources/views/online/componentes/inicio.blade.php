@extends('online.template.main2')
@section('title','Home')
@section('content')
    <!--==========================
    Intro Section
  ============================-->

  <section id="intro">

    <div class="intro-content">
      
<!-- ==============================
      INICIO DEL FORMULARIO COMPRAS
================================ -->      
<div class="card transparente " >

<div class="btn-group align-items-center" role="group" aria-label="Basic example">
  <!-- <button href="#" type="button" class="btn btn-primary btn-lg active"> Sin Retorno</button> -->

  @if(Auth::guest())
    <a href="{{ route('cliente.index1') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">solo ida</a>
    <a href="{{ route('cliente.index2') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">ida y vuelta</a>
    <a href="{{ route('cliente.index3') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">multi-destino</a>
  @else
    <a href="{{ URL::to('/online/inicio') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">solo ida</a>
    <a href="{{ URL::to('/online/inicio2') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">ida y vuelta</a>
    <a href="{{ URL::to('/online/inicio3') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">multi-destino</a>
  @endif
  
  
</div>

    <!-- Card body -->
    <div class="card-body">
  <!-- ======================
    INICIO DEL HASTA
  ======================= -->
  @if (Auth::guest())
    {!! Form::open(['route' => ['cliente.DetalleVuelo'], 'method' => 'GET', 'onsubmit' => 'myFunction()']) !!}
  @else
    <form method="get" onsubmit="myFunction()" action="{{ URL::to('/online/cliente/DetalleVuelo') }}">
    @endif
      <input type="hidden" name="ninosbrazos" id="ninosbrazos" value="0"> 
      
    <div class="form-row">
      

       <div class="col col-md-4  col-lg-3">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" name="origen_id" class="chosen-select impout3" class="form-control impout3" tabindex="2">
              <option value="#">Cuidad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
            
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col col-md-4  col-lg-3">
        <label for="exampleFormControlSelect1" class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto"  name="destino_id" class="chosen-select impout3" class="form-control impout3" tabindex="2"> 
              <option value="#">Cuidad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>


    
    </div> <!-- fin de form-row -->

    <!-- Grd row -->

<!-- ======================
    FIN DEL DESDE
  ======================= -->

<!-- ======================
    INICIO DEL Calendario
  ======================= -->

 <div class="form-row">


    <div class="col-md-2 ">
      <label for="coñooo" class="h">Fecha ida:</label>
      <input type="date" name="fecha_salida" class="form-control impout3" placeholder="DD/MM/YYY">
      <i class="fa fa-calendar prefix icocalendario"></i>
    </div>

    <div class="col col-md-1 col-lg-1">
      <label for="exampleFormControlSelect1" class="h">Adultos:</label>
      <div class="form-group">
        <input type="number" id="inputadultos" min="1" max="5" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos')">
      </div>
    </div>

    <div class="col col-md-1 col-lg-1">
      <label for="exampleFormControlSelect1" class="h">Niños:</label>
      <div class="form-group">
        <input type="number" id="inputninos" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos')">
      </div>
    </div>



 </div>

{{-- ====================================== 
                Contador de personas
     ====================================== --}}
<div id="contenedorPersonas">
</div>

  <div class="form-row">
    <input type="submit" value="BUSCAR" class="btn btn-success">
  </div>


  

<!-- ======================
    FIN DEL Calendario
  ======================= -->

{!! Form::close() !!} <!-- ======================
    FIN DEL Form
  ======================= -->

      </div>
    <!-- fin del Card body -->

</div>

 <!-- ============================
    FIN DEL FORMULARIO DE COMPRAS
  ==============================-->


    </div>

    <div id="intro-carousel" class="owl-carousel" >
      <div class="item" style="background-image: url('{{ asset('online/img/intro-carousel/1.jpg') }} ');"></div>
      <div class="item" style="background-image: url('{{ asset('online/img/intro-carousel/2.jpg') }}');"></div>
      <div class="item" style="background-image: url('{{ asset('online/img/intro-carousel/3.jpg') }}');"></div>
      <div class="item" style="background-image: url('{{ asset('online/img/intro-carousel/4.jpg') }}');"></div>
      <div class="item" style="background-image: url('{{ asset('online/img/intro-carousel/5.jpg') }}');"></div>
    </div>



  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Services Section
    ============================-->
    <br><br>
   
    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2><i class="ion-android-contact"></i> Servicios</h2>
          <p>El 29 de mayo del 2018, AVCA firmó el Documento de Compromiso de Servicio con los Clientes. Dicho documento ha sido desarrollado en el Plan de Calidad adjunto, cuya finalidad es proporcionar a los clientes información detallada sobre las condiciones básicas de la oferta de servicio, para que puedan tener una base sólida en la que soportar sus decisiones de compra.</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box wow fadeInLeft">
              <div class="icon"><i class="ion-ios-people"></i></div>
              <h4 class="title"><a href="">Atención al pasajeros.</a></h4>
              <p class="description">Nuestro objetivo es establecer con usted y con todos nuestros clientes una relación perdurable, profesional y satisfactoria. Cualquier comentario sobre nuestros servicios lo interpretamos como una prueba de su confianza; dandonos una oportunidad de hacer mejoras.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight">
              <div class="icon"><i class="ion-android-walk"></i></div>
              <h4 class="title"><a href="">Condiciones de discapacidad</a></h4>
              <p class="description">Te ofrecemos un servicio acorde a tus condiciones especiales que facilitará tu desplazamiento durante las etapas de tu vuelo. Debes informarnos de todos tus requerimientos, cuanta más información puedas brindarnos ​mejor será el servicio que podremos ofrecerte.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="ion-briefcase"></i></div>
              <h4 class="title"><a href="">Respecto a su equipaje.</a></h4>
              <p class="description">Nuestra organización en los aeropuertos tiene entre sus principales objetivos garantizar el cuidado de su equipaje durante el vuelo y de su entrega en el menor tiempo posible al llegar a su destino, de tal manera que tras su desembarque no incurra en esperas adicionales innecesarias. </p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="ion-ios-body-outline"></i></div>
              <h4 class="title"><a href="">Menores sin acompañantes</a></h4>
              <p class="description">Te ofrecemos asistencia y acompañamiento antes, durante y después del vuelo para niños desde los 5 hasta los 17 años. La asistencia al menor sin acompañar comienza en el momento en que es recibido en el aeropuerto y finaliza cuando es entregado a la persona designada como responsable en su destino final.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #services -->


    <!--==========================
      Destinos Section
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div class="container">

       <div class="section-header">
          <h2><i class="icon ion-plane"></i> destinos que puedes acudir con AVCA </h2>
          <p>No pierda la oportunidad de visitar los destinos a los cuales le podemos hacer llegar de manera rapida y reconfortante</p>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/barcelona.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/barcelona.jpg') }}" data-lightbox="portfolio" data-title="La Casa Fuerte, Barcelona - Estado Anzoategui" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="barcelona.html" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Barcelona</a></h4>
                <p>Anzoategui</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/web3.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/web3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Barquisimeto</a></h4>
                <p>Lara</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/cumana.png') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/cumana.png') }}" class="link-preview" data-lightbox="portfolio" data-title="Monumento, Cumaná - Estado Sucre" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Cumaná</a></h4>
                <p>Sucre</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/card2.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/card2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Caracas</a></h4>
                <p>Distrito Capital</p>

              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/web2.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/web2.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="Web 2" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Coro</a></h4>
                <p>Falcón</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="{{ asset('online/img/portfolio/app3.jpg') }}" class="img-fluid" alt="">
                <a href="{{ asset('online/img/portfolio/app3.jpg') }}" class="link-preview" data-lightbox="portfolio" data-title="App 3" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Porlamar</a></h4>
                <p>Nueva Esparta</p>
              </div>
            </div>
          </div>

        </div>
          <h6 class="float-md-right"><a href="#"><b>+DESTINOS</b></a></h6>
      </div>

      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </section><!-- #portfolio -->
    <!--==========================
      Contact Section
    ============================-->
  

  </main>

 
@endsection
  
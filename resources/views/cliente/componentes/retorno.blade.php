@extends('cliente.template.main2')
@section('title','Detalle Vuelo')
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
  <a href="{{ route('cliente.index1') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">solo ida</a>
  <a href="{{ route('cliente.index2') }}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ida y vuelta</a>
  <a href="{{ route('cliente.index3') }}" class="btn btn-elegant btn-lg" role="button" aria-pressed="true">Multi-destino</a>
  
  
</div>

    <!-- Card body -->
    <div class="card-body">
  <!-- ======================
    INICIO DEL HASTA
  ======================= -->
      {!! Form::open(['route' => 'cliente.DetalleRetorno', 'method' => 'GET', 'onsubmit' => 'myFunction()']) !!}
          <div class="form-row">
  
        <input type="hidden" name="ninosbrazos" id="ninosbrazos" value="0"> 

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
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" name="destino_id" class="chosen-select impout3" class="form-control impout3" tabindex="2">
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
            <label for="from" class="h">Fecha de ida:</label>           
            <input type="date" class="form-control impout3" name="fecha_salida">       
             <i class="fa fa-calendar prefix icocalendario"></i>
                 
        </div>

<div class="col-md-2 ">            
            <label for="to" class="h">De regreso:</label>           
            <input type="date" class="form-control impout3" name="fecha_retorno">       
             <i class="fa fa-calendar prefix icocalendario"></i>                 
        </div>

<script>
    $.datepicker.setDefaults( $.datepicker.regional[ "es" ] );
    $( function() {
    var dateFormat = "dd/mm/yy",
    from = $( "#from" )
    .datepicker({
    minDate:1,
    defaultDate: "+1",
    //changeMonth: true,
    showAnim: 'drop',
    numberOfMonths: 2,
    maxDate:"+3M",
    })
    .on( "change", function() {
    to.datepicker( "option", "minDate", getDate( this ) );
    }),
    to = $( "#to" ).datepicker({

    defaultDate: "+1",
    //changeMonth: true,
    showAnim: 'drop',
    numberOfMonths: 2,
    maxDate:"+3M",
    minDate:1,
    })
    .on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
    });
    function getDate( element ) {
    var date;
    try {
    date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
    date = null;
    }
    return date;
    }
    } );
</script>

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
      <div class="item" style="background-image: url('img/intro-carousel/1.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/2.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/3.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/4.jpg');"></div>
      <div class="item" style="background-image: url('img/intro-carousel/5.jpg');"></div>
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
          <h2>Services</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="row">

          <div class="col-lg-6">
            <div class="box wow fadeInLeft">
              <div class="icon"><i class="fa fa-bar-chart"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight">
              <div class="icon"><i class="fa fa-picture-o"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata nodera clas.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-shopping-bag"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trinige zareta lobur trade.</p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="box wow fadeInRight" data-wow-delay="0.2s">
              <div class="icon"><i class="fa fa-map"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum rideta zanox satirente madera</p>
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
                <img src="img/portfolio/barcelona.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/barcelona.jpg" data-lightbox="portfolio" data-title="La Casa Fuerte, Barcelona - Estado Anzoategui" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
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
                <img src="img/portfolio/web3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/web3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 3" title="Preview"><i class="ion ion-eye"></i></a>
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
                <img src="img/portfolio/cumana.png" class="img-fluid" alt="">
                <a href="img/portfolio/cumana.png" class="link-preview" data-lightbox="portfolio" data-title="Monumento, Cumaná - Estado Sucre" title="Preview"><i class="ion ion-eye"></i></a>
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
                <img src="img/portfolio/card2.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/card2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 2" title="Preview"><i class="ion ion-eye"></i></a>
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
                <img src="img/portfolio/web2.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/web2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 2" title="Preview"><i class="ion ion-eye"></i></a>
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
                <img src="img/portfolio/app3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/app3.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 3" title="Preview"><i class="ion ion-eye"></i></a>
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
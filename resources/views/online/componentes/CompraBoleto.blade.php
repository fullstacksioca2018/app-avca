@extends('online.template.main2')
@section('title','Detalle Vuelo')
  
@section('content')
    <!--==========================
    Intro Section
  ============================-->
    <!--==========================
      Contact Section
    ============================-->
   
    <!--==========================
     DESDEEEEE AKIIIII COÑOOOOO Con todo y comentario
    ============================-->


    <div class="container col-md-12 col-lg-12">
<div class="card border-primary border-bottom-0 mb-3">
      <div class="card-header view overlay" id="grad1" id="joder" >
        <div class="py-2 text-center box wow flipInX" data-wow-duration="0.8s">
          <img class=" mx-auto img-fluid" src="{{ asset('online/img/logo.png') }}" width="150px" height="100px">
          <h2>ESTA A UN SOLO PASO DE VIAJAR</h2>
          <p class="lead">Por favor se le agradece rellenar todos los campos encontrados en el formulario</p>
          
        </div>
        
      </div>

  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
    <br> <br>
     
  @if(!isset($vuelo))

     @if(isset($objMultidestinos))
     {{-- {{ dd($objMultidestinos) }} --}}
          @php
              $costoP=0;
             for($i=0;$i<(count($objMultidestinos));$i++){
                $costoP=$costoP+$objMultidestinos[$i]->ruta->tarifa_vuelo;
             }
          @endphp 
    
      <div class="row">
        <div class="col-md-5 order-md-2 mb-4 box wow bounceInUp" data-wow-duration="3.4s">
          <div class="container kieto">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Precio: </span>
            {{-- ENTERIOR
                <span class="badge badge-primary badge-pill">{{ $cantidad*(count($objMultidestinos)) }} Boletos</span>
             --}}
            <span class="badge badge-primary badge-pill">{{ $cantidad }} Boletos</span>
          </h4>

          <ul class="list-group mb-3">
            @for ($i = 0; $i < ($cantidad-$ninosbrazos); $i++) 
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div class="row">
                      <h6 class="my-0">Pasajero {{ ($i+1) }}: 

                 <div id="accordion" class="mt-3 pl-0"> 

                <h5 class="mb-0">
                    <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1) }}" aria-expanded="false" aria-controls="collapseThree">
                       Tasas <i class="fa fa-angle-double-down"></i>
                    </a>
                </h5>

                 <div id="collapseThree{{ ($i+1) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
                    <h6 class="my-0">Vuelo: <span class="text-muted der">Bs </span></h6>
                            
                    <h6 class="my-0">Cargos:<span class="text-muted der">Bs </span></h6>

                    <h6 class="my-0">Impuesto:<span class="text-muted der1">Bs </span></h6>  

                </div> 
                </div>   
                                 </h6>
                <br>
              
                   </div>
                 <span class="text-muted">{{ $costoP }}Bs</span>  


              </li>
          @endfor

          @for ($i = 0; $i <$ninosbrazos ; $i++)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pasajero {{ ($i+1+$cantidad-$ninosbrazos) }} Niño en brazos:
                    <div id="accordion" class="mt-3 pl-0">   
                          <h5 class="mb-0">
                        <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" aria-expanded="false" aria-controls="collapseThree">
                         Tasas <i class="fa fa-angle-double-down"></i>
                        </a>
                      </h5>  
                       <div id="collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
                         <h6 class="my-0">Vuelo: <span class="text-muted der">0Bs</span></h6>
                                
                         <h6 class="my-0">Cargos:<span class="text-muted der">0Bs </span></h6>

                         <h6 class="my-0">Impuesto:<span class="text-muted der1">0Bs </span></h6>   
                        </div> 
                  </div> 
                </h6>
              </div>
              <span class="text-muted">0Bs</span>
            </li>
           @endfor 

            <li class="list-group-item d-flex justify-content-between border-primary">
              <span>Total a PagarBs</span>
              <strong>{{ $costoP * ($cantidad-$ninosbrazos)}}Bs</strong>
            </li>
          </ul>
          </div>
        </div> 
   @else

        <div class="row">
        <div class="col-md-5 order-md-2 mb-4 box wow bounceInUp" data-wow-duration="3.4s">
          <div class="container kieto">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Precio: </span>
            <span class="badge badge-primary badge-pill">{{ $cantidad }} Boletos</span>
          </h4>

          <ul class="list-group mb-3">
            @for($i = 0; $i < ($cantidad-$ninosbrazos); $i++)
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                      <h6 class="my-0">Pasajero {{ ($i+1) }}:

       <div id="accordion" class="mt-3 pl-0">   
          <h5 class="mb-0">
          <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1) }}" aria-expanded="false" aria-controls="collapseThree">
         Tasas <i class="fa fa-angle-double-down"></i>
        </a>
      </h5>  
       <div id="collapseThree{{ ($i+1) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
         <h6 class="my-0">Vuelo: <span class="text-muted der">0Bs</span></h6>
                
         <h6 class="my-0">Cargos:<span class="text-muted der">0Bs </span></h6>

         <h6 class="my-0">Impuesto:<span class="text-muted der1">0Bs </span></h6>   
        </div> 
      </div> 

        </h6>
                  </div>
                <span class="text-muted">{{ $tarifa_vuelo }}Bs</span>
              </li>
      @endfor

            @for ($i = 0; $i <$ninosbrazos ; $i++)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pasajero {{ ($i+1+$cantidad-$ninosbrazos) }} Niño en brazos:
                    <div id="accordion" class="mt-3 pl-0">   
                          <h5 class="mb-0">
                        <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" aria-expanded="false" aria-controls="collapseThree">
                         Tasas <i class="fa fa-angle-double-down"></i>
                        </a>
                      </h5>  
                       <div id="collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
                         <h6 class="my-0">Vuelo: <span class="text-muted der">0Bs</span></h6>
                                
                         <h6 class="my-0">Cargos:<span class="text-muted der">0Bs </span></h6>

                         <h6 class="my-0">Impuesto:<span class="text-muted der1">0Bs </span></h6>   
                        </div> 
                  </div> 
                </h6>
              </div>
              <span class="text-muted">0Bs</span>

            </li>
            @endfor

            <li class="list-group-item d-flex justify-content-between">
              <span>Total a PagarBs</span>
              <strong>{{ $tarifa_vuelo * ($cantidad-$ninosbrazos)}}Bs</strong>
            </li>
          </ul>
        </div>
        </div>

  @endif 
  
  @else

        <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Precio: </span>
            {{-- ANTERIOR
                <span class="badge badge-secondary badge-pill">{{ $cantidad*2 }} Boletos</span>
              --}}
            <span class="badge badge-secondary badge-pill">{{ $cantidad }} Boletos</span>
          </h4>

          <ul class="list-group mb-3">
            @for($i = 0; $i < ($cantidad-$ninosbrazos); $i++)
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                      <h6 class="my-0">Pasajero {{ ($i+1) }}:
                        <div id="accordion" class="mt-3 pl-0">   
                          <h5 class="mb-0">
                        <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" aria-expanded="false" aria-controls="collapseThree">
                         Tasas <i class="fa fa-angle-double-down"></i>
                        </a>
                      </h5>  
                       <div id="collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
                         <h6 class="my-0">Vuelo: <span class="text-muted der">0Bs</span></h6>
                                
                         <h6 class="my-0">Cargos:<span class="text-muted der">0Bs </span></h6>

                         <h6 class="my-0">Impuesto:<span class="text-muted der1">0Bs </span></h6>   
                        </div> 
                  </div> 
                      </h6>
                  </div>
                <span class="text-muted">{{ $tarifa_vuelo*2 }}Bs</span>
              </li>

            @endfor

            @for ($i = 0; $i <$ninosbrazos ; $i++)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Pasajero {{ ($i+1+$cantidad-$ninosbrazos) }} Niño en brazos:
                    <div id="accordion" class="mt-3 pl-0">   
                          <h5 class="mb-0">
                        <a herf="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" aria-expanded="false" aria-controls="collapseThree">
                         Tasas <i class="fa fa-angle-double-down"></i>
                        </a>
                      </h5>  
                       <div id="collapseThree{{ ($i+1+$cantidad-$ninosbrazos) }}" class="collapse mt-1 ml-1" aria-labelledby="headingThree" data-parent="#accordion">    
                         <h6 class="my-0">Vuelo: <span class="text-muted der">0Bs</span></h6>
                                
                         <h6 class="my-0">Cargos:<span class="text-muted der">0Bs </span></h6>

                         <h6 class="my-0">Impuesto:<span class="text-muted der1">0Bs </span></h6>   
                        </div> 
                  </div> 
                </h6>
              </div>
              <span class="text-muted">0Bs</span>
            </li>
            @endfor

            <li class="list-group-item d-flex justify-content-between">
              <span>Total a PagarBs</span>
              <strong>{{ $tarifa_vuelo * ($cantidad-$ninosbrazos)*2}}Bs</strong>
            </li>
          </ul>
        </div>
  @endif



        <div class="col-md-7 order-md-1">
          <h3 class="mb-4 ml-5">Formulario de Boletos</h3>
           
{{-- SEEEE aki el Formulario compra=============
              ===================================== 

 Descomenta --}}

            @if(isset($objMultidestinos))
            <form method="post" name="FormReserva" action="{{ URL::to('/online/cliente/BoletoVendido') }}" onsubmit="ComBoleto()">

                        {{ csrf_field() }} 

                 @php
                  for($i=0;$i<(count($objMultidestinos));$i++){
                @endphp
                  <input type="hidden" name="tipo_vuelo" value="MultiDestino">
                  <input type="hidden" name="vuelos[]" value="{{ $objMultidestinos[$i]->vuelo->id }}">
                 @php
                   }
                 @endphp
            @else
              @if(isset($vuelo))
              <form method="post" name="FormReserva" action="{{ URL::to('/online/cliente/BoletoVendidoRetorno') }}" onsubmit="ComBoleto()">
              
                        {{ csrf_field() }} 
                  <input type="hidden" name="tipo_vuelo" value="IdaVuelta">
                  <input type="hidden" name="vuelo" id="vuelo_id">
                  <input type="hidden" name="vuelta" id="vuelo_id2" value="{{ $vuelo }}">
              @else
              <form method="post" name="FormReserva" action="{{ URL::to('/online/cliente/BoletoVendido') }}" onsubmit="ComBoleto()">
                        {{ csrf_field() }} 

                  <input type="hidden" name="tipo_vuelo" value="SoloIda">    
                  <input type="hidden" name="vuelo" id="vuelo_id">
              @endif
            @endif

      
            <input type="hidden" name="nino" id="nino">
            <input type="hidden" name="adulto" id="adulto">
            <input type="hidden" name="brazo" id="brazo">
           @for ($i = 0; $i < ($cantidad-$ninosbrazos); $i++)   

            <input type="hidden" name="tipo_boleto[]" id="tipo_boleto" value="{{ "adulto" }}">
             @if(!isset($vuelo))
                  @if(isset($objMultidestinos))
                      <input type="hidden" name="importe_facturado" value="{{ $costoP * ($cantidad-$ninosbrazos)}}">
                      
                  @else
                      <input type="hidden" name="importe_facturado" value="{{ $tarifa_vuelo * ($cantidad-$ninosbrazos)}}">

                  @endif
            @else
                <input type="hidden" name="importe_facturado" value="{{ $tarifa_vuelo *2* ($cantidad-$ninosbrazos)}}">
            
            @endif 
       


 <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.4s">
            <h4 class="mb-3">PASAJERO  {{ ($i+1) }}  </h4>
              <!-- JODAAAA PASAJEROS NORMALES -->
                                        
            <div class="row">
              <div class="col-md-4 mb-2" >
                <label for="firstName">Primer Nombre:</label>
                <input type="text" class="form-control" name="primerNombre[]" id="firstName¨[]" placeholder="Primer nombre" required="">
                <div class="invalid-feedback">
                  Valide su primer nombre es necesario.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Segundo Nombre:</label>
                <input type="text" class="form-control" name="segundoNombre[]" id="lastNameÑ[]" placeholder="Segundo nombre">                
              </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" class="form-control" name="apellido[]" id="lastName[]" placeholder="Apellido(s)"  required="">
                <div class="invalid-feedback">
                  Valide su primer Apellido es necesario.
                </div>
              </div>
            </div>
            

          <div class="row">

              <div class="col-md-5 mb-3">
          <div class="form-group">
            <label for="documento[]"><span class="hidden-xs">Documentacion:</span> </label>
          <div class="form-inline">
          <select class="form-control" name="tipo_documento[]" style="width:25%">
            <option value="Venezolano/a">V</option>
            <option value="Extranjero">P</option>
          </select>
              <span style="width:6%; text-align: center">-</span>
          <input type="text" class="form-control" style="width:65%" name="documento[]" id="documento[]" placeholder="***********" minlength="5" maxlength="8" required="">
                <div class="invalid-feedback" >
                  Es necesario.
                </div>
          </div>
        </div>
      </div>

            <div class="col-md-4 ">
              <label for="coñooo">Fecha de nacimiento:</label>
              <input type="date" name="fecha_nacimiento[]" class="form-control impout3">
              <i class="fa fa-calendar prefix icocalendario3"></i>
            </div>
              <div class=" col col-md-2 mb-2">
              <label for="genero[]">Sexo:</label>
                <select name="genero[]" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
            </div>

            </div>    


            {{-- <div class="row">

              ============= Discapacidad ==================

              <div class="col-md-5 mb-3">
                <label for="Enfermedad">Discapacidad</label>
                <select class="custom-select d-block w-100" name="detalles_salud[]" id="Enfermedad[]" required="">
                  <option value="Ninguna"> Ninguna</option>
                  <option value="Discapacidad motriz"> Discapacidad motriz</option>
                  <option value="Discapacidad visual"> Discapacidad visual</option>
                  <option value="Disminución visual y esquema corporal"> Disminución visual y esquema corporal</option>
                  <option value="Discapacidad visual">Discapacidad visual</option>
                  <option value="Disminuidos visuales"> Disminuidos visuales</option>
                  <option value="Discapacidad auditiva"> Discapacidad auditiva</option>
                  <option value="Discapacidad mental"> Discapacidad mental</option>
                  <option value="Parálisis cerebral">Parálisis cerebral</option>
                </select>
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
              </div> 
              
              ============= Puesto preferencial ==================

              <div class="col-md-4 mb-3">
                <label for="Puesto">Puesto preferenciales</label>
                <select class="custom-select d-block w-100" name="asiento[]" id="Puesto[]" required="">
                  <option value="Pasillo">Pasillo</option>
                  <option value="Ventana">Ventana</option>
                </select>
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
              </div>
            
            </div> --}}
                </div>
<!-- FIN JODAAAA PASAJEROS NORMALES -->
            
            <hr class="mb-4">           
            
         
         @endfor  {{--===== FIN DE FOR =====--}}
          

 


                    
        @for ($i = 0; $i <$ninosbrazos; $i++)

        <div class="container pasajero box wow fadeInLeft" data-wow-duration="2.4s">
  

          <input type="hidden" name="tipo_boleto[]" id="tipo_boleto[]" value="{{ "bebe en brazos" }}">

            <h4 class="mb-3">PASAJERO  {{ ($i+1+$cantidad-$ninosbrazos) }} <span>Bebé en brazos</span>  </h4>
            
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">Primer Nombre:</label>
                <input type="text" class="form-control" name="primerNombre[]" id="firstName[]" placeholder="Primer nombre" required="">
                <div class="invalid-feedback">
                  Valide su primer nombre es necesario.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Segundo Nombre:</label>
                <input type="text" class="form-control" name="segundoNombre[]" id="lastName[]" placeholder="Segundo nombre">                
              </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" class="form-control" name="apellido[]" id="lastName[]" placeholder="Apellido(s)" required="">
                <div class="invalid-feedback">
                  Valide su primer Apellido es necesario.
                </div>
              </div>
            </div>

          <div class="row">
              
           <div class="col-md-5 mb-3">
          <div class="form-group">
            <label for="documento[]"><span class="hidden-xs">Documentacion:</span> </label>
          <div class="form-inline">
            <select name="tipo_documento[]" class="form-control" style="width:25%">
          <option value="Venezolano/a">V</option>
          <option value="Extranjero">P</option>
          </select>
              <span style="width:6%; text-align: center">-</span>
          <input type="text" class="form-control" style="width:65%" name="documento[]" id="documento[]" placeholder="***********" minlength="5" maxlength="8" required>
                <div class="invalid-feedback" >
                  Es necesario.
                </div>
          </div>
        </div>
        </div>

            <div class="col-md-4 ">
              <label for="coñooo">Fecha de nacimiento:</label>
              <input type="date" name="fecha_nacimiento[]" class="form-control impout3">
              <i class="fa fa-calendar prefix icocalendario3"></i>
              
            </div>


            <div class=" col col-md-2 mb-2">
              <label for="genero[]">Sexo:</label>
                <select name="genero[]" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
            </div>

            </div>
            </div>
      @endfor

        <button class="btn btn-primary btn-lg " 
            data-toggle="modal" data-target="#exampleModal" type="submit">Comprar boletos
        </button>
        @php
          $url='/online/cliente/BoletoReservado';
        @endphp
        <button type="button" class="btn btn-danger btn-lg " onclick="document.FormReserva.action='{{ URL::to($url) }}';document.FormReserva.submit();" onkeypress="document.FormReserva.action='{{ URL::to($url) }}';document.FormReserva.submit();">Reservar boleto</button>
      

    </div>
            
<!-- ===================== -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Proceso de pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<!-- <article class="card"> -->
<div class="card-body">
<p> <img src="{{ asset('online/img/pago/pay-visa.png') }}"> 
   <img src="{{ asset('online/img/pago/pay-mastercard.png') }}"> 
   <img src="{{ asset('online/img/pago/pay-american-ex.png') }}">
   <img src="{{ asset('online/img/pago/pay-visa-el.png') }}">
</p>
<!-- <p class="alert alert-success">ingrese los datos correctamnete</p> -->

<div class="form-group">
<label for="username">Nombre completo (El que tiene en la tarjeta)</label>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-user"></i></span>
  </div>
   <input type="text" class="form-control" name="usernam" id="cc-name" placeholder="" required="">
                <small class="text-muted"></small>
                <div class="invalid-feedback">
                  nombre requerido
                </div>
</div> <!-- input-group.// -->
</div> <!-- form-group.// -->

<div class="form-group">
<label for="cardNumber">Numero de la Tarjeta</label>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
  </div>
  <input type="text" class="form-control" name="numero_tarjeta" id="cc-number" placeholder="">
  <div class="invalid-feedback">
                  Requiere el numero de tarjeta
                </div>
</div> <!-- input-group.// -->
</div> <!-- form-group.// -->

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <label><span class="hidden-xs">Fecha de Vencimiento</span> </label>
          <div class="form-inline"  id="cc-expiration">
        <select class="form-control" name="fecha_vencimiento" style="width:45%" required>
          <option>MM</option>
          <option value="01 - Enero">01 - Enero</option>
          <option value="02 - Febrero">02 - Febrero</option>
          <option value="03 - Marzo">03 - Marzo</option>
          <option value="04 - Abril">04 - Abril</option>
          <option value="05 - Mayo">05 - Mayo</option>
          <option value="06 - Junio">06 - Junio</option>
          <option value="07 - Julio">07 - Julio</option>
          <option value="08 - Agosto">08 - Agosto</option>
          <option value="09 - Septiembre">09 - Septiembre</option>
          <option value="10 - Octubre">10 - Octubre</option>
          <option value="11 - Noviembre">11 - Noviembre</option>
          <option value="12 - Diciembre">12 - Diciembre</option>
        </select>
              <span style="width:10%; text-align: center"> / </span>
              <select class="form-control" style="width:45%" required>
          <option>YY</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
        </select>
          </div>
          <div class="invalid-feedback">
                  requiere la fecha de Vencimiento
                </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
            <input type="password" class="form-control" name="csc" id="cc-cvv" minlength="3" maxlength="3" placeholder="***" required>
        </div> <!-- form-group.// -->
        <div class="invalid-feedback">
                 es necesario el CVV
        </div>
    </div>
</div> <!-- row.// -->
<button class="subscribe btn btn-primary" type="submit"> Confirmar </button>

</div> <!-- card-body.// -->
<!-- </article>  card.// -->


    </div>
      <div class="modal-footer">
<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>  -->
      </div>
    </div>
  </div>
</div>

<!-- FIN DEL MODAL -->
      </div>
          <br> <br>


  </div>
</div>
</div>
    </form>

<script type="text/javascript">
  $(document).ready(function(){
    alert("message?: DOMString");
document.getElementById('nino').value = sessionStorage.getItem('ninos');
  document.getElementById('adulto').value = sessionStorage.getItem('adultos');
  document.getElementById('brazo').value = sessionStorage.getItem('brazos');
  document.getElementById('vuelo_id').value = sessionStorage.getItem('vuelo');
  
  });
</script>

@endsection
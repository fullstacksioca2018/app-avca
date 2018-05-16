@extends('operativo.layouts.backend')
@section('title','Detalle Vuelo')
  
@section('content')
   
<div class="container-fluid">
      <div class="animated fadeIn">
    <div class="container col-md-12 col-lg-12">

      
  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
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
            <span class="badge badge-primary badge-pill">{{ $cantidad*(count($objMultidestinos)) }} Boletos</span>
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
            <span class="badge badge-secondary badge-pill">{{ $cantidad*2 }} Boletos</span>
          </h4>

          <ul class="list-group mb-3">
            @for($i = 0; $i < ($cantidad-$ninosbrazos); $i++)
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                      <h6 class="my-0">Pasajero {{ ($i+1) }}:</h6>
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
            <form method="post" action="{{ URL::to('compra/Operativo/BoletoVendido') }}" onsubmit="ComBoleto()">

                        {{ csrf_field() }} 

                 @php
                  for($i=0;$i<(count($objMultidestinos));$i++){
                @endphp
                  <input type="hidden" form="myForm" name="vuelos[]" value="{{ $objMultidestinos[$i]->vuelo->id }}">
                 @php
                   }
                 @endphp
            @else
              @if(isset($vuelo))
              <form method="post" action="{{ URL::to('compra/Operativo/BoletoVendido') }}" onsubmit="ComBoleto()">
              
                        {{ csrf_field() }} 
                  <input type="hidden" form="myForm" name="vuelo" id="vuelo_id">
                  <input type="hidden" form="myForm" name="vuelta" id="vuelo_id2" value="{{ $vuelo }}">
              @else
            
              <form method="post" id="myForm" action="{{ URL::to('compra/Operativo/BoletoVendido') }}" onsubmit="ComBoleto()">
                        {{ csrf_field() }} 

              
                  <input type="hidden" form="myForm" name="vuelo" id="vuelo_id">
              @endif
            @endif

      
            <input type="hidden" form="myForm" name="nino" id="nino">
            <input type="hidden" form="myForm" name="adulto" id="adulto">
            <input type="hidden" form="myForm" name="brazo" id="brazo">
           @for ($i = 0; $i < ($cantidad-$ninosbrazos); $i++)   

            <input type="hidden" form="myForm" name="tipo_boleto[]" id="tipo_boleto" value="{{ "adulto" }}">
             @if(!isset($vuelo))
                  @if(isset($objMultidestinos))
                      <input type="hidden" form="myForm" name="importe_facturado" value="{{ $costoP * ($cantidad-$ninosbrazos)}}">
                      
                  @else
                      <input type="hidden" form="myForm" name="importe_facturado" value="{{ $tarifa_vuelo * ($cantidad-$ninosbrazos)}}">

                  @endif
            @else
                <input type="hidden" form="myForm" name="importe_facturado" value="{{ $tarifa_vuelo *2* ($cantidad-$ninosbrazos)}}">
            
            @endif 
       


 <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.4s">
            <h4 class="mb-3">PASAJERO  {{ ($i+1) }}  </h4>
              <!-- JODAAAA PASAJEROS NORMALES -->
                                        
            <div class="row">
              <div class="col-md-4 mb-2" >
                <label for="firstName">Primer Nombre:</label>
                <input type="text" form="myForm" class="form-control" name="primerNombre[]" id="firstName¨[]" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valide su primer nombre es necesario.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Segundo Nombre:</label>
                <input type="text" form="myForm" class="form-control" name="segundoNombre[]" id="lastNameÑ[]" placeholder="" value="" required="">                
              </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" form="myForm" class="form-control" name="apellido[]" id="lastName[]" placeholder="" value="" required="">
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
            <select class="form-control" form="myForm" name="tipo_documento[]" style="width:25%">
          <option value="Venezolano/a">V</option>
          <option value="Extranjero">P</option>
          </select>
              <span style="width:6%; text-align: center">-</span>
          <input type="text" form="myForm" class="form-control" style="width:65%" name="documento[]" id="documento[]" placeholder="######" required="">
                <div class="invalid-feedback" >
                  Es necesario.
                </div>
          </div>
        </div>
      </div>

            <div class="col-md-4 ">
              <label for="coñooo">Fecha de nacimiento:</label>
              <input type="date" form="myForm" name="fecha_nacimiento[]" class="form-control">
            </div>
              <div class=" col col-md-2 mb-2">
              <label for="genero[]">Sexo:</label>
                <select name="genero[]" form="myForm" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
            </div>

            </div>    


            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="Enfermedad">Enfermedad</label>
                <select class="custom-select d-block w-100" form="myForm" name="detalles_salud[]" id="Enfermedad[]" required="">
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
              <div class="col-md-4 mb-3">
                <label for="Puesto">Puesto</label>
                <select class="custom-select d-block w-100" form="myForm" name="asiento[]" id="Puesto[]" required="">
                  <option value="Pasillo">Pasillo</option>
                  <option value="Ventana">Ventana</option>
                </select>
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
              </div>
            
            </div>
                </div>
<!-- FIN JODAAAA PASAJEROS NORMALES -->
            
            <hr class="mb-4">           
            
         
         @endfor  {{--===== FIN DE FOR =====--}}
          

 


                    
        @for ($i = 0; $i <$ninosbrazos; $i++)

        <div class="container pasajero box wow fadeInLeft" data-wow-duration="2.4s">
  

          <input type="hidden" form="myForm" name="tipo_boleto[]" id="tipo_boleto[]" value="{{ "bebe en brazos" }}">

            <h4 class="mb-3">PASAJERO  {{ ($i+1+$cantidad-$ninosbrazos) }} <span>Bebé en brazos</span>  </h4>
            
            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="firstName">Primer Nombre:</label>
                <input type="text" form="myForm" class="form-control" name="primerNombre[]" id="firstName[]" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valide su primer nombre es necesario.
                </div>
              </div>
               <div class="col-md-4 mb-3">
                <label for="lastName">Segundo Nombre:</label>
                <input type="text" form="myForm" form="myForm" class="form-control" name="segundoNombre[]" id="lastName[]" placeholder="" value="" required="">                
              </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" form="myForm" class="form-control" name="apellido[]" id="lastName[]" placeholder="" value="" required="">
                <div class="invalid-feedback">
                  Valide su primer Apellido es necesario.
                </div>
              </div>
            </div>

          <div class="row">
              
           <div class="col-md-5 mb-3">
          <div class="form-group">
            <label for="documento[]" form="myForm"><span class="hidden-xs">Documentacion:</span> </label>
          <div class="form-inline">
            <select name="tipo_documento[]" form="myForm" class="form-control" style="width:25%">
          <option value="Venezolano/a">V</option>
          <option value="Extranjero">P</option>
          </select> 
              <span style="width:6%; text-align: center">-</span>
          <input type="text" form="myForm" class="form-control" style="width:65%" name="documento[]" id="documento[]" placeholder="######" required="">
                <div class="invalid-feedback" >
                  Es necesario.
                </div>
          </div>
        </div>
        </div>

            <div class="col-md-4 ">
              <label for="coñooo">Fecha de nacimiento:</label>
              <input type="date" form="myForm" name="fecha_nacimiento[]" class="form-control impout3">
              <i class="fa fa-calendar prefix icocalendario3"></i>
              
            </div>


            <div class=" col col-md-2 mb-2">
              <label for="genero[]" form="myForm">Sexo:</label>
                <select name="genero[]" form="myForm" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
            </div>

            </div>
            </div>
      @endfor


      

        <button class="btn btn-primary btn-lg " data-toggle="modal" data-target="#exampleModal" type="button">Comprar boletos
        </button>

      

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
   <input type="text" class="form-control" form="myForm"   name="usernam" id="cc-name" placeholder="" required="">
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
  <input type="text" class="form-control" form="myForm" name="numero_tarjeta" id="cc-number" placeholder="">
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
            <select class="form-control" name="fecha_vencimiento" form="myForm" style="width:45%">
          <option>MM</option>
          <option>01 - Enero</option>
          <option>02 - Febrero</option>
          <option>03 - Marzo</option>
          <option>04 - Abril</option>
          <option>05 - Mayo</option>
          <option>06 - Junio</option>
          <option>07 - Julio</option>
          <option>08 - Agosto</option>
          <option>09 - Septiembre</option>
          <option>10 - Octubre</option>
          <option>11 - Noviembre</option>
          <option>12 - Diciembre</option>
        </select>
              <span style="width:10%; text-align: center"> / </span>
              <select class="form-control" style="width:45%">
          <option>YY</option>
          <option>2018</option>
          <option>2019</option>
          <option>2020</option>
          <option>2019</option>
          <option>2020</option>
          <option>2021</option>
          <option>2022</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
          <option>2026</option>
          <option>2027</option>
          <option>2028</option>
          <option>2029</option>
          <option>2030</option>
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
            <input class="form-control" required type="text" form="myForm" name="csc" id="cc-cvv">
        </div> <!-- form-group.// -->
         <div class="invalid-feedback">
                 es necesario el CVV
                </div>
    </div>
</div> <!-- row.// -->
<button class="subscribe btn btn-primary" type="submit" form="myForm"> Confirmar  </button>

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
</div>
</div>

    @push('styles')
 <link href="{{ asset('online/css/estilomod.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/destinos.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/estilocompras.css') }}" rel="stylesheet">
@endpush
@endsection
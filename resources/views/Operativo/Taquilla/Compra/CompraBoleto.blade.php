@extends('operativo.layouts.backend')
@section('title','Detalle Vuelo')
  
@section('content')
   @php
   
   $Contbrazo=0;
   $tarifaT=0;
   //contador de niños en brazo 
  
   for($i=0;$i<$ninos;$i++){             
    if(($brazo[$i] != null) && ($brazo[$i] != 'En asiento') ){$Contbrazo++;}
     }
    //contador de tarifas multivuelo
    if($tipo==3){
        for($i=0;$i<$cantidadV;$i++)
        {
          $tarifaT=$tarifaT+$tarifas_multidestino[$i];
        }
        
    }
   @endphp
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="container col-md-12 col-lg-12">
      <div class="card-body">
        <div class="row">
          <div class="col-md-5 order-md-2 mb-4 box wow bounceInUp" data-wow-duration="3.4s">
            <div class="container kieto">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Precio: </span>
                  @if($tipo==1)
                <span class="badge badge-primary badge-pill">{{ ($adultos + $ninos) - $Contbrazo }} Boleto(s)</span>
                 @endif 
                 @if($tipo==2)
                <span class="badge badge-primary badge-pill">{{ (($adultos + $ninos) - $Contbrazo)*2 }} Boleto(s)</span>
                 @endif
                  @if($tipo==3)
                <span class="badge badge-primary badge-pill">{{ ($adultos + $ninos) - $Contbrazo }} Boleto(s) </span>
                 @endif
              </h4>
              <ul class="list-group mb-3">
                <!-- MOSTRAR LAS TASAS PARA CADA PASAJERO -->
                @for($i=0; $i < ($adultos+($ninos - $Contbrazo)); $i++) 
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
                            <h6 class="my-0">Vuelo: <span class="text-muted der">BsS </span></h6>
                            <h6 class="my-0">Cargos:<span class="text-muted der">BsS </span></h6>
                            <h6 class="my-0">Impuesto:<span class="text-muted der1">BsS </span></h6>
                          </div>
                        </div>
                      </h6>
                      <br>
                    </div>
                      @if($tipo==1)
                      <span class="text-muted">{{ $tarifa }}BsS</span>
                      @endif
                      @if($tipo==2)
                      <span class="text-muted">{{ $tarifa+$tarifa_regreso }}BsS</span>
                      @endif
                      @if($tipo==3)
                      <span class="text-muted">{{ $tarifaT }}BsS</span>
                      @endif
                  </li>
                @endfor <!-- FIN TASAS -->
                <li class="list-group-item d-flex justify-content-between border-primary">
                  <span>Total a Pagar: </span>
                  @if($tipo==1)
                  <strong>{{ $tarifa * ($adultos+($ninos-$Contbrazo))}} BsS</strong>
                  @endif
                  @if($tipo==2)
                  <strong>{{ ($tarifa+$tarifa_regreso) * ($adultos+($ninos-$Contbrazo))}} BsS</strong>
                  @endif
                  @if($tipo==3)
                  <strong>{{ $tarifaT * ($adultos+($ninos-$Contbrazo))}} BsS</strong>
                  @endif
                </li>
              </ul>
            </div>
            <!--iNICIO DE DATOS DE LOS VUELOS -->
          <div class="col-md-12 order-md-6 mb-9 box wow bounceInUp" data-wow-duration="3.4s">
            <!-- <h3 class="mb-7 ml-7">Datos de Vuelos</h3> -->
              <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.4s">
              @if($tipo==1)
                <div class="form-control">
                  <strong> Vuelo:</strong> {{$dv->vuelo->n_vuelo}} 
                <br>
                 <strong> Origen:</strong>  {{$dv->origen->ciudad}} - [{{$dv->origen->sigla}}]
                <br>
                  <strong>Destino:</strong> {{$dv->destino->ciudad}} - [{{$dv->destino->sigla}}]
                <br>
                  {{$dv->vuelo->fecha_salida}}
                </div>
                
              @endif

              @if($tipo==2)
              <div class="form-control">
                  <strong> Vuelo de Ida:</strong> {{$dv[0]->vuelo->n_vuelo}} 
                <br>
                 <strong> Origen:</strong>  {{$dv[0]->origen->ciudad}} - [{{$dv[0]->origen->sigla}}]
                <br>
                  <strong>Destino:</strong> {{$dv[0]->destino->ciudad}} - [{{$dv[0]->destino->sigla}}]
                <br>
                  {{$dv[0]->vuelo->fecha_salida}}
                </div>
                <hr>
                <div class="form-control">
                    <strong> Vuelo de Regreso:</strong> {{$dv[1]->vuelo->n_vuelo}} 
                  <br>
                   <strong> Origen:</strong>  {{$dv[1]->origen->ciudad}} - [{{$dv[1]->origen->sigla}}]
                  <br>
                    <strong>Destino:</strong> {{$dv[1]->destino->ciudad}} - [{{$dv[1]->destino->sigla}}]
                  <br>
                    {{$dv[1]->vuelo->fecha_salida}}
                  </div>
               @endif

              @if($tipo==3)
                @for($i=0;$i<$cantidadV;$i++)
                <div class="form-control">
                    <strong>Segmento {{$i+1}}:</strong> {{$dv[$i]->vuelo->n_vuelo}} 
                  <br>
                   <strong> Origen:</strong>  {{$dv[$i]->origen->ciudad}} - [{{$dv[$i]->origen->sigla}}]
                  <br>
                    <strong>Destino:</strong> {{$dv[$i]->destino->ciudad}} - [{{$dv[$i]->destino->sigla}}]
                  <br>
                    {{$dv[$i]->vuelo->fecha_salida}}
                </div>
                  <hr>
                @endfor             
              @endif
              
              
              </div>         
          </div>
          <!-- FIN  DATOS VUELOS -->
          </div>
          

          <!- COMIENZO DE FORMULARIOS ->
          <div class="col-md-7 order-md-1">
            <h3 class="mb-4 ml-5">Formulario de Boletos</h3>
            <!-- FORMULARIOS DE COMPRA -->
            <form method="post" id="myForm" action="{{ URL::to('taquilla/BoletoVendido') }}">{{ csrf_field() }} 
              <input type="hidden" form="myForm" name="NinosBrazos_cant" id="NinosBrazos_cant" value="{{ $Contbrazo }}">
              <input type="hidden" form="myForm" name="tipo" id="tipo" value="{{ $tipo }}">
              <input type="hidden" form="myForm" name="adultos" id="adultos" value="{{ $adultos }}">
              <input type="hidden" form="myForm" name="ninos" id="ninos" value="{{ $ninos }}" >
              @if($tipo==1)
              <input type="hidden" form="myForm" name="importe_facturado" value="{{ $tarifa * ($adultos+($ninos-$Contbrazo))}}">
              <input type="hidden" form="myForm" name="vuelo" id="vuelo" value="{{ $vuelo }}">
              @endif
              @if($tipo==2)
              <input type="hidden" form="myForm" name="vuelo" id="vuelo" value="{{ $vuelo }}">
              <input type="hidden" form="myForm" name="vuelo_regreso" id="vuelo_regreso" value="{{ $vuelo_regreso }}">
              <input type="hidden" form="myForm" name="importe_facturado" value="{{ ($tarifa + $tarifa_regreso) * ($adultos+($ninos-$Contbrazo))}}">
              @endif
              @if($tipo==3)
              <input type="hidden" form="myForm" name="cantidadV" id="cantidadV" value="{{ $cantidadV }}">
              @for($i=0;$i<$cantidadV;$i++)
              <input type="hidden" form="myForm" name="vuelo[]" id="vuelo{{$i}}" value="{{ $vuelos[$i] }}">
              @endfor
              <input type="hidden" form="myForm" name="importe_facturado" value="{{ $tarifaT * ($adultos+($ninos-$Contbrazo))}}">
              @endif
              @for($i=0; $i < ($adultos+($ninos-$Contbrazo)); $i++)
              <input type="hidden" form="myForm" name="tipo_boleto[]" id="tipo_boleto[]" value="adulto">
              <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.4s">
                  <div class="col-sm-12">
                <div class="row">
                  <h4 class="mb-3">PASAJERO  {{ ($i+1) }}</h4>&nbsp;&nbsp;&nbsp; <!-- ADULTOS -- LOS NIÑOS Y BEBES EN ASIENTO SE CUENTAN COMO ADULTOS Y PAGAN -->
                      <div class="form-group">
                     <input type="text" class=" " id="Buscarci{{$i}}" name="Buscarci" placeholder="Cedula..."> 
                          <button type="button" class="btn btn-primary btn-sm" id="btnbuscar{{$i}}" onClick="BuscarCedula({{$i}})")><i class="fa fa-search"></i></button>
                    </div>
                  
                  </div>
                </div>
                  
                  <div class="row">
                  <div class="col-md-4 mb-2" >
                    <label for="firstName">Primer Nombre:</label>
                    <input type="text" form="myForm" class="form-control" name="primerNombre[]" id="firstName{{$i}}" placeholder="Nombre" required>
                    <div class="invalid-feedback">Valide su primer nombre es necesario.</div>
                  </div> 
                  <div class="col-md-4 mb-3">
                <label for="lastName">Segundo Nombre:</label>
                <input type="text" class="form-control" name="segundoNombre[]" id="segundoName{{$i}}" placeholder="Segundo nombre">                
              </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" form="myForm" class="form-control" name="apellido[]" id="lastName{{$i}}" placeholder="Apellido"  required>
                <div class="invalid-feedback">Valide su primer Apellido es necesario.</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 mb-3">
                <div class="form-group">
                  <label for="documento[]"><span class="hidden-xs">Documentacion:</span> </label>
                  <div class="form-inline">
                    <select class="form-control" form="myForm" name="tipo_documento[]" id="tipo_documento{{$i}}" style="width:25%">
                      <option value="Venezolano/a">V</option>
                      <option value="Extranjero">P</option>
                    </select>
                    <span style="width:6%; text-align: center">-</span>
                    <input type="number" form="myForm" class="form-control" style="width:65%" name="documento[]" id="documento{{$i}}" placeholder="######" required >
                    <div class="invalid-feedback" >Es necesario.</div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 ">
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" form="myForm" name="fecha_nacimiento[]" id="fecha_nacimiento{{$i}}" class="form-control" require >
              </div>
              <div class=" col col-md-2 mb-2">
                <label for="genero[]">Sexo:</label>
                <select name="genero[]" id="genero{{$i}}" form="myForm" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
              </div>
            </div>
          </div>
          <!-- FIN  PASAJEROS ADULTOS -->
          <hr class="mb-4">
      @endfor  <!-- FIN FOR PASAJEROS ADULTOS -->
      <!-- DATOS DE LOS BEBES -->
    @for($i=0; $i <$Contbrazo; $i++)
      <div class="container pasajero box wow fadeInLeft" data-wow-duration="2.4s">
        <input type="hidden" form="myForm" name="tipo_boleto[]" id="tipo_boleto[]" value="bebe en brazos">
        <h4 class="mb-3">PASAJERO  {{ ($i+1+$adultos+($ninos-$Contbrazo)) }} <span>Bebé en brazos</span></h4>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="firstName">Primer Nombre:</label>
            <input type="text" form="myForm" class="form-control" name="primerNombre[]" id="firstName" placeholder="Primer Nombre"  required>
            <div class="invalid-feedback">Valide su primer nombre es necesario.</div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="lastName">Segundo Nombre:</label>
            <input type="text" form="myForm" form="myForm" class="form-control" name="segundoNombre[]" id="lastName[]" placeholder="Segundo Nombre"  required=>
          </div> 
              <div class=" col col-md-4 mb-3">
                <label for="lastName">Apellido(s):</label>
                <input type="text" form="myForm" class="form-control" name="apellido[]" id="lastName[]" placeholder="Apellido(s)"  required>
                <div class="invalid-feedback">Valide su primer Apellido es necesario.</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 mb-3">
                <div class="form-group">
                  <label for="documento[]" form="myForm"><span class="hidden-xs" require>Documentacion:</span></label>
                  <div class="form-inline">
                    <select name="tipo_documento[]" form="myForm" class="form-control" style="width:25%" require>
                      <option value="Venezolano/a">V</option>
                      <option value="Extranjero">P</option>
                    </select>
                    <span style="width:6%; text-align: center">-</span>
                    <input type="text" form="myForm" class="form-control" style="width:65%" name="documento[]" id="documento[]" placeholder="######" required >
                    <div class="invalid-feedback" >Es necesario.</div>
                  </div>
                </div>
              </div>

            <div class="col-md-4 ">
              <label for="coñooo">Fecha de nacimiento:</label>
              <input type="date" form="myForm" name="fecha_nacimiento[]" class="form-control impout3" require>
            </div>
            <div class=" col col-md-2 mb-2">
              <label for="genero[]" form="myForm">Sexo:</label>
              <select name="genero[]" form="myForm" class="form-control">
                <option value="masculino"> M</option>
                <option value="femenino">F</option>
              </select>
            </div>
          </div>
        </div>
     @endfor
     <button class="btn btn-success btn-md " data-toggle="modal" data-target="#exampleModal" type="button">Comprar boletos</button>
     <input class="btn btn-primary" type="submit" form="myForm" id="reservar" name="reservar" value="Reservar">
    </div>
<!-- ===================== -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de Pago</h5>
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
          <img src="{{ asset('online/img/pago/pay-maestro.png') }}">
        </p>
        <div class="form-group">
          <label for="username">Nombre</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" form="myForm"   name="usernam" id="cc-name" autofocus >
            <small class="text-muted"></small>
            <div class="invalid-feedback">nombre requerido</div>
          </div> <!-- input-group.// -->
        </div> <!-- form-group.// -->
        <div class="form-group">
          <label for="cardNumber">Numero de Referencia</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
            </div>
            <input type="number" class="form-control" form="myForm" name="numero_tarjeta" id="cc-number"  autocomplete="off" minlength="4" maxlength="8" >
            <div class="invalid-feedback">Requiere el numero de referencia</div>
          </div> <!-- input-group.// -->
        </div> <!-- form-group.// -->
       
       
       
       
        <div class="row col-sm-10 offset-1">
          <div class="col-sm-5">
            <div class="form-group">
              <label>Tipo de Pago </label>
                <select class="form-control" name="tipo_pago" id="tipo_pago" form="myForm" onchange="cambiartarjeta()">
                  <option>Débito</option>
                  <option>Crédito</option>
                </select>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">   
               <label>Tipo de Tarjeta </label>
                <select class="form-control" name="tipo_tarjeta"  id="tipo_tarjeta">
                  <option>Mestro</option>
                </select>
              </div>
            </div>
        </div> <!-- row.// -->
        <button class="subscribe btn btn-primary" type="submit" form="myForm" id="pagar" name="pagar"> Registrar Pago  </button>
      </div> <!-- card-body.// -->
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
  @push('script')
  <script src="{{ asset('online/plugins/contactform/contactform.js') }}"></script>

<!-- Template Main Javascript File -->
<script src="{{ asset('online/plugins/js/main.js') }}"></script>

<!--Lo del selcet de la busqueda para las compra boleto-->



  @endpush
    @push('styles')
 <link href="{{ asset('online/css/estilomod.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/destinos.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/estilocompras.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('online/plugins/lib/chosen/chosen.css') }}">
 <link rel="stylesheet" href="{{ asset('online/plugins/lib/chosen/bootstrap-chosen.css') }}">
@endpush

@push('scripts')
<script src="{{asset('js/Operativo/compraboleto.js')}}"></script>

@endpush
@endsection
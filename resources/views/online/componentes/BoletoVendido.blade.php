@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')

	<div class="container-detalles"> 
      <div class="titulo-detalles">
         <p> Revisa los detalles de tu viaje</p>
      </div><!--titulo detalles-->
      <div class="row">
<div class="card-detalles">
<div class="w-100 ">
  


  <table class="table-sm ">
    <thead>
            <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }} " height="40" class="d-inline-block align-right" alt="AVCA"></div>
            
          </thead>
    
   
   @foreach ($datos_vuelos as $dato_vuelo)

      @php
        $salida = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $fecha = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $hora=Carbon::parse($dato_vuelo->ruta->duracion);
        $llegada=$salida->copy();
        $llegada->addHours($hora->hour);
        $llegada->addMinutes($hora->minute);
      @endphp

    <tr>
      <th class="thresumen">{{ $dato_vuelo->origen->sigla }}-{{ $dato_vuelo->destino->sigla }}</th>
      <th class="thresumen">{{ $salida->format('h:i A') }}-{{ $llegada->format('h:i A') }}</th>
      <th class="thresumen">{{ $fecha->format('d/m/Y') }}</th>
      <th class="thresumen">Costo: {{ $dato_vuelo->ruta->tarifa_vuelo }}</th>
    </tr>
    @endforeach
    <tr class="table-detalles">
    @foreach($facturas as $fac)  
      <th class="thresumen">Cantidad pasajeros: {{ $fac->ninos_cant + $fac->adultos_cant }}</th>
      <th class="thresumen">Costo Total: {{ $fac->importe_facturado }}</th>
    @endforeach
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th></th>

    </tr>


  </table>


</div>




   </div><!--w75-->  

   <div class="col-sm-1"></div>

   <div class="col-sm-3 p-1">
    <div class="card-resumen">
      <!--VER MAS-->
      {{--<p class="pthsiglas">Resumen de tu viaje</p>
       <div class="vermas">
          <a data-toggle="collapse" href="#resumen" role="button" aria-expanded="false" aria-controls="#resumen">Resumen costo del viaje <i class="ion-android-arrow-dropdown"></i></a>
        </div>

        <div class="collapse" id="resumen">
          <table class="table table-sm content-right">

            <tr>
              <th><a class="aresumen" data-toggle="collapse" href="#Pasajero1" role="button" aria-expanded="false" aria-controls="#Pasajero1">Pasajero 1: Adulto <i class="ion-android-arrow-dropdown"></i></a></th>
              <th>250.000bs</th>
            </tr>
            <tr class="collapse" id="Pasajero1">
              <th class="thresumen">Costo de vuelo: 225.000bs</th>
              <th class="thresumen2">Impuestos: 25.000bs</th>
              <th class="thresumen">Total: 250.000bs</th>
            </tr>
            
            <tr>
              <th><a class="aresumen" data-toggle="collapse" href="#Pasajero2" role="button" aria-expanded="false" aria-controls="#Pasajero2">Pasajero 2: Adulto <i class="ion-android-arrow-dropdown"></i></a></th>
              <th>250.000bs</th>
            </tr>
            <tr class="collapse" id="Pasajero2">
              <th class="thresumen">Costo de vuelo: 225.000bs</th>
             
              
            </tr>
            <tr>
               <th class="thresumen2">Impuestos: 25.000bs</th>
            </tr>
            <tr>
              <th class="thresumen">Total: 250.000bs</th>
            </tr>
            
            <tr>
              <th colspan="2" class="thresumen3">COSTO TOTAL DEL VIAJE
              : 500.000bs</th>
            </tr>
              
            
          </table>
        </div>--}} <!--FIN VER MAS-->
      
    
     <p class="ion-android-alert thresumen"> Información importante sobre el vuelo</p>

     <div class="card-text">
        <li class="thresumen2">Los boletos no son reembolsables ni transferibles.</li>
        <li class="thresumen2">Si se imposibilita para viajar, los boletos tienen una duración de 1 año desde su compra</li>
        <li class="thresumen2">Las tarifas de AVCA permiten viajar de un destino a otro con un artículo de mano, de llevar otro se cobrará sobrecargo; de igual manera se aplicará sobrecargo a maletas con más de 23kgs</li>
        
      </div>

     </div>
   </div> 
   </div>
  </div><!--container detalles-->


@endsection
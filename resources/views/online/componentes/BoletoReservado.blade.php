@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')

	<div class="container-detalles"> 
      <div class="titulo-detalles">
         <p> Revisa los detalles de tu boleto reservado</p>
      </div><!--titulo detalles-->
      <div class="row">
<div class="card-detalles">
<div class="w-100 ">
  


  <table class="table-sm">
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

      @for($i = 0; $i < $factura->ninos_cant + $factura->adultos_cant; $i++)
        <tr>

          <th class="thresumen">Pasajero: {{ $boletos[$i]->primerNombre }} {{ $boletos[$i]->apellido }}</th>

          <th class="thresumen">Localizador: {{ $boletos[$i]->localizador }} </th>

        </tr>
            
      @endfor
    

    @endforeach
    <tr class="table-detalles">
      <th class="thresumen">Costo Total: {{ $factura->importe_facturado }}</th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
      <th class="thresumen2"></th>
    </tr>


  </table>


</div>

      <div class="titulo-detalles">
 <p> La informacion de su boleto ha sido enviada a su correo</p>
      </div><!--titulo detalles-->
  <a type="" href="{{ URL::to('/online/cliente/MiPerfil', Auth::guard('online')->user()->id) }}" class="btn btn-md btn-primary">Aceptar</a>

   </div><!--w75-->  

   <div class="col-sm-1"></div>

   <div class="col-sm-3 p-1">
    <div class="card-resumen">
     
     <p class="ion-android-alert thresumen"> Información importante sobre el vuelo</p>

     <div class="card-text">
        <li class="thresumen2">Los boletos no son reembolsables ni transferibles.</li>
        <li class="thresumen2">Si se imposibilita para viajar, los boletos tienen una duración de 1 año desde su compra</li>
        <li class="thresumen2">Las tarifas de AVCA permiten viajar de un destino a otro con un artículo de mano, de llevar otro se cobrará sobrecargo; de igual manera se aplicará sobrecargo a maletas con más de 23kgs</li>
        <li class="thresumen2">Utilice el localizador al momento de realizar su check-in</li>
      </div>

     </div>
   </div> 
   </div>
  </div><!--container detalles-->

@endsection
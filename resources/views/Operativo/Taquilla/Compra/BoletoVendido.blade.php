@extends('operativo.layouts.backend')

@section('content')

<!--CONTAINER DETALLES DEL RETORNO-->
<div class="container-fluid">
  <div class="animated fadeIn">
  <div class="container-detalles">
    <h2 class="pdetalles"><b>Los precios son por persona, por viaje e incluyen todos los impuestos y cargos; sin embargo, no incluyen los cargos de equipaje</b></h2>
    
    @foreach ($datos_vuelos as $dato_vuelo)
      @php
        $salida = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $fecha = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $hora=Carbon::parse($dato_vuelo->ruta->duracion);
        $llegada=$salida->copy();
        $llegada->addHours($hora->hour);
        $llegada->addMinutes($hora->minute);
      @endphp


     <div class="card-detalles">
      <div class="row sm-4">
        <div class="col-sm-10">
        <table class="table table-sm ">
          <thead>
            <th class="table-detalles" colspan="4">
            <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }}" height="40" class="d-inline-block align-right" alt="AVCA"></div>Detalles del Vuelo </th>
            
          </thead>
              <tbody>
                <tr class="table-detalles2">
                  <th scope="row" class="pthsiglas" colspan="2">{{ $dato_vuelo->origen->sigla }}-{{ $dato_vuelo->destino->sigla }}</th>
                  <th class="pthsiglas"> {{ $salida->format('h:i A') }}-{{ $llegada->format('h:i A') }} </th>
                  <th class="pthsiglas">Fecha de salida:  $fecha->format('d/m/Y') </th>
                  <th class="pthsiglas">Costo: {{ $dato_vuelo->ruta->tarifa_vuelo }}</th>
                </tr>
              </body>
                @foreach ($boletos as $boleto)
                <tr>
                <th class="thresumen">Pasajero: {{ $boleto->primerNombre }} {{ $boleto->apellido }}</th>
                <th class="thresumen">Localizador: {{ $boleto->localizador }} </th>
                </tr>
      @endforeach
    <tr class="table-detalles2">
      <th class="pthsiglas">Cantidad pasajeros: {{ $factura->ninos_cant + $factura->adultos_cant }}</th>
      <th class="pthsiglas">Costo Total: {{ $factura->importe_facturado }}</th>
      <th class="pthsiglas"></th>
      <th class="pthsiglas"></th>
      <th></th>

    </tr>


  </table>
     </div><!--col-sm-10-->

</div>
</div> <!--fin col-md-4-->


@push('styles')
 <link href="{{ asset('online/css/estilomod.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/destinos.css') }}" rel="stylesheet">
  <link href="{{ asset('online/css/estilocompras.css') }}" rel="stylesheet">
@endpush

@endsection
@extends('operativo.layouts.backend')

@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
  <div class="container-detalles">
    
      <div class="card-detalles">
          <div class="row sm-4">
            <div class="col-sm-10">
            <table class="table table-sm " border="0">
              <thead>
                <th class="table-detalles" colspan="4">
                <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }}" height="40" class="d-inline-block align-right" alt="AVCA"></div>Detalles del Vuelo </th>
                
              </thead>
    @foreach ($datos_vuelo as $dato_vuelo)
      @php 
      $salida = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $fecha = Carbon::parse($dato_vuelo->vuelo->fecha_salida);
        $hora=Carbon::parse($dato_vuelo->ruta->duracion);
        $llegada=$salida->copy();
        $llegada->addHours($hora->hour);
        $llegada->addMinutes($hora->minute);
      @endphp


     
              <tbody>
                <!-- <tr class="table-detalles2">
                  <th class="thresumen" >Ruta</th>
                  <th class="thresumen">Fecha de salida:  </th>
                  <th class="thresumen">Hora de Salida:  - Hora de llegada  </th>
                  <th class="thresumen">Costo: </th>
                </tr> -->
                <tr class="table-detalles2">
                  <th class="pthsiglas">{{ $dato_vuelo->origen->sigla }}-{{ $dato_vuelo->destino->sigla }}</th>
                  <th class="pthsiglas">{{$fecha->format('d/m/Y')}} </th>
                  <th class="thresumen3">{{ $salida->format('h:i A') }} -  {{ $llegada->format('h:i A') }} </th>
                  <th class="pthsiglas">Costo: {{ $dato_vuelo->ruta->tarifa_vuelo }}</th>
                </tr>
              </tbody>
              <tr>
              <th class="thresumen">Nro de Factura: {{ $factura->numero_factura}} <a href="imprimirfactura.php?id='{{ $factura->id}}'">Imprimir</a> </th>
              </tr>
                @foreach ($boletos as $boleto)
                <tr>
                <th class="thresumen">Pasajero: {{ $boleto->primerNombre }} {{ $boleto->apellido }}</th>
                <th class="thresumen">Localizador: {{ $boleto->localizador }} </th>
                <th>Estatus Check-in: </th>
                <th> -- Sin Check-in -- </th>
                </tr>
      @endforeach
      @endforeach
      
      
    <tr class="table-detalles2">
      <th class="thresumen">Cantidad pasajeros: {{ $factura->ninos_cant + $factura->adultos_cant }}</th>
      <th class="thresumen">Personas Exoneradas: {{$factura->NinosBrazos_cant}} </th>
      <th class="thresumen"></th>
      <th class="thresumen">Costo Total: {{ $factura->importe_facturado }}</th>
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
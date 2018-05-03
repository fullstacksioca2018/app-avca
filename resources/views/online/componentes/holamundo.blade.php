@extends('cliente.template.main2')
@section('title','Detalle Vuelo')

@section('content')
  
  <div class="container">

  
      <div class="container-detalles">

@foreach ($vuelos as $obj)
    @php
      $salida = Carbon::parse($obj->vuelo->fecha_salida);
      $hora=Carbon::parse($obj->ruta->duracion);
      $llegada=$salida->copy();
      $llegada->addHours($hora->hour);
      $llegada->addMinutes($hora->minute);
    @endphp
     
     <div class="container-detalles">
     <div class="card-detalles">
      <div class="row sm-4">
        <div class="col-sm-10">
        <table class="table table-sm ">
          <thead>
            <tr class="table-primary">
              <th scope="col"><b>Hora de Salida: {{ $salida->format('h:i A') }}</b></th>
              <th scope="col"><b>Hora de Llegada: {{ $llegada->format('h:i A') }}</b></th>
              <th scope="col"><b>Tiempo Estimado del vuelo: {{ $hora->format('H') }}h {{ $hora->format('i') }}min</b></th>
              <th scope="col"><b>Costo: {{ $obj->ruta->tarifa_vuelo }} Bs <i class="fa fa-money"></i></b></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" colspan="2"><b>{{ $obj->origen->ciudad }},{{ $obj->origen->pais }}  ({{ $obj->origen->sigla }}),{{ $obj->origen->aeropuerto }} </b></th>
              <th colspan="2"><b>{{ $obj->destino->ciudad }},{{ $obj->destino->pais }}  ({{ $obj->destino->sigla }}),{{ $obj->destino->aeropuerto }}</b></th>

            </tr>
            <tr class="table-primary">
              <th scope="row" colspan="2"><b>N°Vuelo: {{ $obj->vuelo->n_vuelo }}</b></th>
              <th><b>Solo Ida</b></th>
              <th><b>Clase Económica</b></th>
            </tr>
            <tr>
              <th scope="row"></th>
              <td colspan="2"></td>
              <td></td>
              
            </tr>
          </tbody>
       </table>
     </div><!--col-sm-10-->

     <div class="col-sm-2">
      <a class="btn btn-primary" href="{{ URL::to('/cliente/CompraBoleto/'.$obj->cantidad.'/'.$obj->ninosbrazos) }}" onclick="FunctionVuelo('{{ $obj->vuelo->id }}')">Seleccionar</a>
      </div> <!--fin col-md-4-->
   </div><!--row sm-4-->

</div>
</div>
</div>
</div>


@endforeach

@endsection


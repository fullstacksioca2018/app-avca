@extends('online.template.main2')
@section('title','Detalle Vuelo')
@section('style')
  <style>
  #migaDePan a{
    color:#3c3c3c;
    font-weight: 800;
  }
  #migaDePan .breadcrumb-item.active{
    color:#fff;
    
  }
  </style>
@endsection
@section('content')
<div class="col-md-12">
  <nav aria-label="breadcrumb" id="migaDePan">
    <ol class="breadcrumb bg-primary">
      <li class="breadcrumb-item"><a href="#">Inicio</a></li>
      <li class="breadcrumb-item"><a href="#">Selección del vuelo de ida</a></li>
      <li class="breadcrumb-item active" aria-current="page">Selección del vuelo de retorno</li>
    </ol>
  </nav>
</div>

<script src="{{ asset('online/js/alerta.js') }}"></script>

{{-- {{ dd($vuelos)}} --}}
  @php
      $salida = Carbon::parse($ida->vuelo->fecha_salida);
      $fecha = Carbon::parse($ida->vuelo->fecha_salida);
      $hora=Carbon::parse($ida->ruta->duracion);
      $llegada=$salida->copy();
      $llegada->addHours($hora->hour);
      $llegada->addMinutes($hora->minute);
  @endphp
<!--CARD INFORMATIVO DEL VUELO DE SALIDA SELECCIONADO-->
<div class="card-salida">
  <div class="row mb-2">
    <div class="col-sm-8">

          <table class="table-detalles2 table-sm ">
          <thead>
              <tr class="table-detalles2">
              <th><p class="pthsalida">N°Vuelo:{{ $ida->vuelo->n_vuelo }} - Ida</th>
              <th><p class="pthsalida">Clase Económica</p></th>
              <th><p class="pthsalida">Costo: {{ $ida->ruta->tarifa_vuelo }} Bs</p></th>
              <th><p class="pthsiglas2">Fecha de Salida: {{ $fecha->format('d/m/Y') }}</p></th>
            </tr>
             
            <!--  <th scope="col"><b>Costo: 250.000 Bs <i class="fa fa-money"></i></b></th>-->
            
          </thead>

          <tbody>
            
              <tr class="table-detalles3">
              <th scope="col" colspan="2"><p class="pthhrs">Hora de Salida: {{ $salida->format('h:i A') }}</p></th>
             <th scope="col">&nbsp &nbsp &nbsp &nbsp &nbsp<img src="{{ asset('online/img/iconos-detalles/reloj.png') }}" height="30px;">&nbsp &nbsp &nbsp</th>
              <th scope="col"><p class="pthhrs">Hora de Llegada: {{ $llegada->format('h:i A') }}</p></th>

              </tr> 

                <tr class="table-detalles3">
              <th scope="col" colspan="2"><p class="pthsiglas3">{{ $ida->origen->ciudad }}({{ $ida->origen->sigla }})</p></th>
             <th scope="col">&nbsp &nbsp &nbsp &nbsp &nbsp<img src="{{ asset('online/img/iconos-detalles/avion2.png') }}" height="30px;">&nbsp &nbsp &nbsp</th>
              <th scope="col"><p class="pthsiglas3">{{ $ida->destino->ciudad }}({{ $ida->destino->sigla }})</p></th>

              </tr> 
          </tbody>
          
       </table>
    </div>

  
</div>
</div><!--ROW SM-2-->
</div><!--card SALIDA-->


<!--CONTAINER DETALLES DEL RETORNO-->

  <div class="container-detalles">
    <div class="titulo_detalles"><b>Selecciona tu boleto de retorno</b></div>
    <h2 class="pdetalles"><b>Los precios son por persona, por viaje e incluyen todos los impuestos y cargos; sin embargo, no incluyen los cargos de equipaje</b></h2>

    @foreach ($vuelos as $obj)

    @php
      $salida = Carbon::parse($obj->vuelo->fecha_salida);
      $fecha = Carbon::parse($obj->vuelo->fecha_salida);
      $hora=Carbon::parse($obj->ruta->duracion);
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
                  <th scope="row" class="pthsiglas">{{ $obj->origen->ciudad }} ({{ $obj->origen->sigla }})</th>
                  <th><img src="{{ asset('online/img/iconos-detalles/avion.png') }}" height="30px;">&nbsp &nbsp &nbsp</th>
                  <th class="pthsiglas">{{ $obj->destino->ciudad }} ({{ $obj->destino->sigla }})</th>
                  @if(Auth::guest())
                  <th class="thbtn"> <a class="btn btn-primary" id="login" href="{{ URL::to('/online/cliente/CompraBoleto/'.$obj->cantidad.'/'.$obj->ninosbrazos.'/'.$obj->ruta->tarifa_vuelo.'/'.$ida->vuelo->id.'/') }}" onclick="FunctionVuelo('{{ $obj->vuelo->id }}')">Seleccionar</a></th>
                  @else
                  <th class="thbtn"> <a class="btn btn-primary" href="{{ URL::to('/online/cliente/CompraBoleto/'.$obj->cantidad.'/'.$obj->ninosbrazos.'/'.$obj->ruta->tarifa_vuelo.'/'.$ida->vuelo->id.'/') }}" onclick="FunctionVuelo('{{ $obj->vuelo->id }}')">Seleccionar</a></th>
                  @endif
                  

                </tr>
                
                  <th scope="col" class="pthhrs">Salida: {{ $salida->format('h:i A') }}</th>
                  <th><img src="{{ asset('online/img/iconos-detalles/reloj.png') }}" height="30px;">&nbsp &nbsp &nbsp</th>
                  <th scope="col " class="pthhrs">Llegada: {{ $llegada->format('h:i A') }}</th>
                  
                  
                <tr>
                 <th class="pthhrs">Fecha de salida: {{ $fecha->format('d/m/Y') }}</th>
                 <th></th>
                 <th class="pthhrs">Costo: {{ $obj->ruta->tarifa_vuelo }}Bs</th>

                </tr>

              </tbody>          
       </table>


       <!--VER MAS-->
       <div class="vermas">
          <a class="btn btn-sm btn-primary btncosto" data-toggle="collapse" href="#detalles" role="button" aria-expanded="false" aria-controls="#detalles">Detalles del vuelo y equipaje <i class="fa fa-arrow-circle-down"></i></a>
        </div>

        <div class="collapse" id="detalles">
          <table class="table table-sm">
            <thead>
              <tr class="table-detalles2">
                <th scope="col" class="pthsalida">N°Vuelo: {{ $obj->vuelo->n_vuelo }} - retorno</th>
                <th scope="col" class="pthsalida">Clase Económica</th>
                <th scope="col" class="pthsalida">Tiempo Estimado de Vuelo: {{ $hora->format('H') }}h {{ $hora->format('i') }}min</th>
                <th scope="col" class="pthsalida">ATR-72</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" colspan="2" class="pthsalida">Desde {{ $obj->origen->aeropuerto }}</th>
                <td class="pthsalida">Hasta {{ $obj->destino->aeropuerto }}</td>
                
              </tr>
              <tr class="table-detalles2">
                <th scope="row" class="pthsalida">Cargos de equipaje</th>
                <td class="pthsalida">23kgs de equipaje</td>
                <td class="pthsalida">1 equipaje de mano</td>
                <td class="pthsalida"></td>
              </tr>
            </tbody>
          </table>
        </div> <!--FIN VER MAS-->
     </div><!--col-sm-10-->

    
   </div><!--row sm-4-->

</div>
</div>
<!--hasta aquí el detalles-->

@endforeach
@endsection

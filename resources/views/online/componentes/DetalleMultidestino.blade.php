@extends('online.template.main2')
@section('title','Detalle Vuelo')
@section('content')

{{-- {{ dd($objMultidestinos->seleccionados) }} --}}
<!--CARD INFORMATIVO DEL VUELO DE SALIDA SELECCIONADO-->


@for ($i = 0; $i < count($objMultidestinos->seleccionados) ; $i++)
 
    @php
      $salida = Carbon::parse($objMultidestinos->seleccionados[$i]->vuelo->fecha_salida);
      $fecha = Carbon::parse($objMultidestinos->seleccionados[$i]->vuelo->fecha_salida);
      $hora=Carbon::parse($objMultidestinos->seleccionados[$i]->ruta->duracion);
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
              <th><p class="pthsalida">N°Vuelo: {{ $objMultidestinos->seleccionados[$i]->vuelo->n_vuelo }} - retorno</th>
              <th><p class="pthsalida">Clase Económica</p></th>
              <th><p class="pthsalida">Costo: {{ $objMultidestinos->seleccionados[$i]->ruta->tarifa_vuelo }} Bs</p></th>
              <th><p class="pthsiglas">Fecha de Salida: {{ $fecha->format('d/m/Y') }}</p></th>
            </tr>
             
            <!--  <th scope="col"><b>Costo: 250.000 Bs <i class="fa fa-money"></i></b></th>-->
            
          </thead>

          <tbody>
            
              <tr class="table-detalles3">
              <th scope="col" colspan="2"><p class="pthhrs">Hora de Salida: {{ $salida->format('h:i A') }}</p> <p class="pthsiglas">{{ $objMultidestinos->seleccionados[$i]->origen->sigla }}</p></th>
             <th scope="col"><p class="pthsalida"><b></b></p></th>
              <th scope="col" colspan="2"><p class="pthhrs">Hora de Llegada: {{ $llegada->format('h:i A') }}</p><p class="pthsiglas">{{ $objMultidestinos->seleccionados[$i]->destino->sigla }}</p></th>

              </tr> 
          </tbody>
          
       </table>
    </div>

  
</div>
</div><!--ROW SM-2-->
</div><!--card SALIDA-->
@endfor


 <!--CONTAINER DETALLES DEL RETORNO-->

  <div class="container-detalles">
           <h2 class="pdetalles"><b>Los precios son por persona, por viaje e incluyen todos los impuestos y cargos; sin embargo, no incluyen los cargos de equipaje</b></h2>
    
  @foreach($vuelos as $obj)

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
                  <th scope="row" class="pthsiglas" colspan="2">{{ $obj->origen->ciudad }} ({{ $obj->origen->sigla }})</th>
                  <th class="pthsiglas">{{ $obj->destino->ciudad }} ({{ $obj->destino->sigla }})</th>
                  <th class="pthsiglas">Fecha de salida: {{ $fecha->format('d/m/Y') }}</th>
                  

                </tr>
                
                  <th scope="col" class="pthhrs" colspan="2">Salida: {{ $salida->format('h:i A') }}</th>
                  <th scope="col " class="pthhrs">Llegada: {{ $llegada->format('h:i A') }}</th>
                  <th class="pthsiglas">Costo: {{ $obj->ruta->tarifa_vuelo }}Bs</th>
                  
                <tr>
                 <th colspan="4"></th>
                </tr>

              </tbody>          
       </table>
       <!--VER MAS-->
       <div class="vermas">
          <a data-toggle="collapse" href="#detalles" role="button" aria-expanded="false" aria-controls="#detalles">Detalles del vuelo y equipaje <i class="ion-android-arrow-dropdown"></i></a>
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
                <td></td>
              </tr>
            </tbody>
          </table>
        </div> <!--FIN VER MAS-->
        
     </div><!--col-sm-10-->
        <div class="col-sm-2">
      
          <form action="{{ ROUTE('cliente.DetalleMultidestino2') }}" method="post" accept-charset="utf-8">
            
            {{ csrf_field() }} 
{{-- AQUI --}}
        @for($i=0;$i<count($objMultidestinos->origenes);$i++)
          <input type="hidden" name="origenes[]" value="{{ $objMultidestinos->origenes[$i] }}">
          <input type="hidden" name="destinos[]" value="{{ $objMultidestinos->destinos[$i] }}">
          <input type="hidden" name="fechas[]" value="{{ $objMultidestinos->fechas[$i] }}">
        @endfor
          <input type="hidden" name="cantidad" value="{{ $obj->cantidad }}">
          <input type="hidden" name="ninos" value="{{ $objMultidestinos->ninos }}">
          <input type="hidden" name="adultos" value="{{ $objMultidestinos->adultos }}">
          <input type="hidden" name="ninosbrazos" value="{{ $objMultidestinos->ninosbrazos}}">
          <input type="hidden" name="vuelo" value="{{ $obj->vuelo->id }}">
        @for($i=0;$i<count($objMultidestinos->seleccionados);$i++)
          <input type="hidden" name="seleccionados[]" value="{{ $objMultidestinos->seleccionados[$i]->vuelo->id }}">
        @endfor

          <div class="col-sm-2">
            <a class="btn btn-primary">
                <button type="submit" style="background: #00000000;
                                              border: none;
                                              color: aliceblue;
                                              font-size: 1rem;">Seleccionar</button>
            </a>
          </div>
        </form>
        
      </div> <!--fin col-md-4-->
        </div><!--row sm-4-->

</div>
</div>

<!--hasta aquí el detalles-->
@endforeach
@endsection

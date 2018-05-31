@extends('online.template.main2')
@section('title','Detalle Vuelo')
@section('content')
{{-- {{ dd($paquetes) }} --}}

<script src="{{ asset('online/js/alerta.js') }}"></script>

 <div class="container-detalles">
          <div class="titulo_detalles"><b>Selecciona tu boleto de multidestino</b></div>
          <h2 class="pdetalles"><b>Los precios son por persona, por viaje e incluyen todos los impuestos y cargos; sin embargo, no incluyen los cargos de equipaje</b></h2>
@php
	$contadorP=1;
@endphp
    @foreach ($paquetes as $paquete)
	
	<form action="{{  URL::to('/online/cliente/DetalleMultidestino2') }}" method="get" accept-charset="utf-8">
		
		{{ csrf_field() }} 

     <div class="card-detalles">
      <div class="row sm-4">
        <div class="col-sm-10">
        <table class="table table-sm ">
          <thead>
            <th class="table-detalles" colspan="4">Detalles del Paquete {{ $contadorP }}</th>
            @php
            	$contadorP++;
            @endphp
            <div class="table-detalles"><img src="{{ asset('online/img/logo.png') }}" height="30" class="d-inline-block align-right" alt="AVCA"></div>
				@php
					$VueloC=1;
				@endphp

				{{-- {{ dd($paquete) }} --}}
            @foreach ($paquete as $ObjVuelo)

				<input type="hidden" name="vuelo[]" value="{{ $ObjVuelo->vuelo->id }}">

            	@php
			      $salida = Carbon::parse($ObjVuelo->vuelo->fecha_salida);
			      $fecha = Carbon::parse($ObjVuelo->vuelo->fecha_salida);
			      $hora=Carbon::parse($ObjVuelo->ruta->duracion);
			      $llegada=$salida->copy();
			      $llegada->addHours($hora->hour);
			      $llegada->addMinutes($hora->minute);
			    @endphp
            	{{-- {{ dd($ObjVuelo) }} --}}
              <tr class="table-detalles2">
              <th scope="row" ><p class="pthsalida"><b>Vuelo {{ $VueloC }}</b></p></th>
              <th><p class="pthsalida"><b>Salida:  {{ $salida->format('h:i A') }}</b></p></th>
              <th><p class="pthsalida"><b>Llegada: {{ $llegada->format('h:i A') }}</b></p></th>
              <th><p class="pthsalida"><b>Costo: {{ $ObjVuelo->ruta->tarifa_vuelo }}Bs</b></p></th>
               @php
	            	$VueloC++;
	           @endphp
            </tr>

              <th scope="col"><p class="pthsalida"><b>Fecha de salida: {{ $fecha->format('d/m/Y') }}</b></p></th>
              <th scope="col"><p class="pthsalida"><b>Desde {{ $ObjVuelo->origen->aeropuerto }}</b></p></th>
              <th scope="col"><p class="pthsalida"><b>Hasta {{ $ObjVuelo->destino->aeropuerto }}</b></p></th>
              <th scope="col"><p class="pthsalida"><b></b></p></th>
            @endforeach

          </thead>


       </table>
     </div><!--col-sm-10-->

     <div class="col-sm-2">
          {{-- {{ dd($ObjVuelo) }}	 --}}
          <input type="hidden" name="cantidad" value="{{ $ObjVuelo->cantidad }}">
          <input type="hidden" name="ninos" value="{{ $ObjVuelo->ninos }}">
          <input type="hidden" name="adultos" value="{{ $ObjVuelo->adultos }}">
          <input type="hidden" name="ninosbrazos" value="{{ $ObjVuelo->ninosbrazos}}">

        @if(Auth::guest())
          <button id="login" class="btn btn-md btn-primary">Seleccionar</button>
        @else
          <button type="submit" class="btn btn-md btn-primary">Seleccionar</button>
        @endif
          
        
      </div> <!--fin col-md-4-->
   </div><!--row sm-4-->

</div>
</div>
</form>  
@endforeach


<!--hasta aquí el detalles-->
@endsection

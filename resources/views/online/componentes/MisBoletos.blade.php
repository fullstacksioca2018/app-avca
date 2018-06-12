@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')

   <!--==========================
     DESDEEEEE AKIIIII COÑOOOOO Con todo y comentario
    ============================-->

<br>
    <div class=" col-md-12 col-lg-12">
<div class="card border-primary border-bottom-0 mb-3">
  <div class="card-header" id="grad1" id="joder" >
     <div class="py-2 text-center box wow flipInX" data-wow-duration="0.8s">
      <img class=" mx-auto img-fluid" src="{{ asset('/online/img/logo.png') }} " width="150px" height="100px">
        <h2>Historial de mis boletos comprados</h2>
        <!--<cite class="lead">mmm</cite>-->
        
     </div>
    
  </div>

  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
    <br>
     
       <div class="row">
{{--
        <div class="col-md-4 mb-3">
           <label for="exampleFormControlSelect1">Aeropuerto:</label>
               <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" name="origen_id" class="chosen-select impout2" class="form-control impout3" tabindex="2">
              <option value="#">Cuidad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix" style="position: absolute; left: 14px; top: 8px;  padding-top: 27px; padding-left: 13px;  font-size: 28px; color: rgba(0, 0, 0, 0.8) ;"></i>   </div>  
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
              </div>
        

            <div class="col-md-4 ">
              <label for="coñooo">Fecha:</label>
              <input type="date" name="fecha_nacimiento[]" class="form-control impout3">
              <i class="fa fa-calendar prefix icocalendario3"></i>
            </div>


         <div class="col-md-4 mb-3">
                <label for="Puesto">Estatus:</label>
                <select class="custom-select d-block w-100" name="asiento[]" id="Puesto[]" required="">
                  <option value="Pasillo">Pagado</option>
                  <option value="Ventana">Chequiado</option>
                </select>
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
              </div>
          
        </div>
      <br>  <br>
      --}}
<div class="table-responsive"> 
<!--Table-->
<table class="table table-hover text-center">

    <!--Table head-->
    <thead class="mdb-color primary-color-dark">
        <tr class="text-white">

            <th><strong>Cod Boleto</strong></th>
            <th><strong>Pasajero</strong></th>
            <th><strong>Fecha</strong></th>
            <th><strong>Desde/Hasta</strong></th>            
            <th><strong>Estatus</strong></th>
        </tr>
    </thead>
    <!--Table head-->

    <!--Table body-->
    <tbody>
      
      @foreach ($boletos as $boleto)
        
         @php
            $salida = Carbon::parse($boleto->fecha_salida);
            $fecha = Carbon::parse($boleto->fecha_salida);
            $llegada=$salida->copy();
         @endphp

        <tr>
            <th scope="row">{{ $boleto->codvuelos }}</th>
            <td>{{ $boleto->pasajero }}</td>
            <td>{{ $fecha->format('d/m/Y') }}</td>
            <td>{{ $boleto->origen }} / {{ $boleto->destino }}</td>
            <td>{{ $boleto->estatus }}</td>
        </tr>
      @endforeach

    </tbody>
    <!--Table body-->

</table>
 
</div>
   
          <br> <br>


  </div>
</div>
</div>


<!-- ========================
AKI EL CIERRE DEL COÑOOOO NO INVENTAR
===================================== -->
@endsection
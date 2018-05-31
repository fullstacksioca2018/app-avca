<input type="hidden" name="ninosbrazos" id="ninosbrazos" value="0">
  <input type="hidden" name="cantidadV" id="cantidadV" value="2">
  
    <div class="form-row p-1" id="vuelo1">

       <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="origen_id1" name="origen_id[]"  class="chosen-select impout3" class="form-control impout3" tabindex="2">
              <option value="#">Ciudad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id1" name="destino_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2"> 
             <option value="#">Ciudad o aeropuerto</option> 
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>

      <div class="col-md-4">
        <label for="coñooo" id="fecha_salida2_label" class="h">Fecha ida:</label>
        <input type="date" id="salida1" name="fecha_salida[]" class="form-control impout3" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}">
        <i class="fa fa-calendar prefix icocalendario"></i>
      </div>

    </div> <!-- fin de form-row -->

    <!-- Grd row -->

  <!-- ======================
    Inicio segundo vuelo
  ======================= -->

  
  <div class="form-row p-1" id="vuelo2">



       <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="origen_id2" name="origen_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2">
              <option value="#">Ciudad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col col-md-4">
        <label for="exampleFormControlSelect1"  class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id2" name="destino_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2"> 
             <option value="#">Ciudad o aeropuerto</option> 
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>
<div class="col-md-4">            
            <label for="coñooo" class="h">Fecha ida:</label>
            <input type="date" id="salida2" name="fecha_salida[]" class="form-control impout3" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}">       
          <i class="fa fa-calendar prefix icocalendario"></i>
                 
        </div>

    </div> <!-- fin de form-row -->

<!-- ======================
    Inicio del tercer vuelo
  ======================= -->

  <div class="form-row p-1" id="vuelo3">


       <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="origen_id3" name="origen_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2">
              <option value="#">Ciudad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id3" name="destino_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2"> 
             <option value="#">Ciudad o aeropuerto</option> 
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>
<div class="col-md-4 ">            
            <label for="coñooo" class="h">Fecha ida:</label>
            <input type="date" id="salida3" name="fecha_salida[]" class="form-control impout3" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}">       
          <i class="fa fa-calendar prefix icocalendario"></i>
                 
        </div>

    </div> <!-- fin de form-row -->

    <!-- ======================
    Inicio cuarto vuelo
  ======================= -->

  
  <div class="form-row p-1" id="vuelo4">


       <div class="col col-md-4">
        <label for="exampleFormControlSelect1" class="h">Desde:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="origen_id4" name="origen_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2">
              <option value="#">Ciudad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>  
  

<!-- JOooodeeerrr segundo select -->

  <div class="col col-md-4">
        <label for="exampleFormControlSelect1"  class="h">Hasta:</label>
        <div class="form-group">         
      
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id4" name="destino_id[]" class="chosen-select impout3" class="form-control impout3" tabindex="2"> 
             <option value="#">Ciudad o aeropuerto</option> 
              @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
             <i class="fa fa-map-marker prefix icociudad2"></i>
          </div>  
        </div>
<div class="col-md-4">            
            <label for="coñooo" class="h">Fecha ida:</label>
            <input type="date" id="salida4" name="fecha_salida[]" class="form-control impout3" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}">       
          <i class="fa fa-calendar prefix icocalendario"></i>
                 
        </div>

    </div> <!-- fin de form-row -->
<!-- ======================
    FIN DEL DESDE
  ======================= -->

<!-- ======================
   Botones Sumar y Restar vuelos
  ======================= -->
<div class="mr-5">
  
</div>

<!-- ======================
    INICIO DEL Calendario
  ======================= -->

 <div class="form-row pt-1">


<div class="col col-md-1 col-lg-1 mt-4">
<button type="button" class="btn btn btn-sm btn-primary ion-plus" id="masV" onclick="masvuelos()"></button>
</div>

<div class="col col-md-1 col-lg-1 mt-4 ml-2">
<button type="button" class="btn btn btn-sm btn-danger ion-minus-round" id="menosV" onclick="menosvuelos()"></button>
</div>

<div class="col col-md-1 col-lg-1 ml-3">
       <label for="exampleFormControlSelect1" class="h">Adultos:</label>
        <div class="form-group">    
    <input type="number" id="inputadultos3" min="1" max="6" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos','3')"> 
     </div>
      </div>
        
    <div class="col col-md-1 col-lg-1 mr-3">
      <label for="exampleFormControlSelect1" class="h">Niños:</label>
      <div class="form-group">        
        <input type="number" id="inputninos3" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos','3')">
      </div>
    </div>

 </div>

{{-- ====================================== 
                Contador de personas
     ====================================== --}}
<div id="contenedorPersonas3">
</div>

  <div class="form-row">
    <input type="submit" value="BUSCAR" class="btn btn-primary">
  </div>




<!-- ======================
    FIN DEL Calendario
  ======================= -->

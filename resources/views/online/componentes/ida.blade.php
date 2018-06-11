<input type="hidden" name="ninosbrazos" id="ninosbrazos1" value="0">

<div class="form-row">
  {{--  SELECT DESDE  --}}
  <div class="col col-md-6">
    <label for="exampleFormControlSelect1" id="origen_id" class="h">Desde:</label>
    <div class="form-group">
      
      <select data-placeholder="Ciudad-Aeropuerto" name="origen_id" id="origen_id" class="chosen-select impout3" class="form-control impout3" tabindex="2">
        <option value="#">Ciudad o aeropuerto</option>
        @foreach ($sucursales as $sucursal)
        <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
        @endforeach
      </select>
      <i class="fa fa-map-marker prefix icociudad2"></i>
      
    </div>
  </div>
  
  {{--  SELECT HASTA  --}}
  <div class="col-md-6">
    <label for="exampleFormControlSelect1" class="h">Hasta:</label>
    <div class="form-group">
      
      <select data-placeholder="Ciudad-Aeropuerto"  name="destino_id" id="destino_id" class="chosen-select impout3" class="form-control impout3" tabindex="2">
        <option value="#">Ciudad o aeropuerto</option>
        @foreach ($sucursales as $sucursal)
        <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
        @endforeach
      </select>
      <i class="fa fa-map-marker prefix icociudad2"></i>
    </div>
  </div>
  </div> <!-- fin de form-row -->
  <!-- Grd row -->
  <!-- ======================
  FIN DESDE / HASTA
  ======================= -->
  <!-- ======================
  INICIO DEL Calendario
  ======================= -->
  <div class="form-row">
    <div class="col-md-4">
      <label for="coñooo" class="h">Fecha ida:</label>
      <!-- fecha salida -->
      <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}">
      
    </div>
    <div class="col col-md-1 col-lg-1">
      <label for="exampleFormControlSelect1" class="h">Adultos:</label>
      <div class="form-group">
        <input type="number" id="inputadultos1" min="1" max="6" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos','1')">
      </div>
    </div>
    <div class="col col-md-1 col-lg-1">
      <label for="exampleFormControlSelect1" class="h">Niños:</label>
      <div class="form-group">
        <input type="number" id="inputninos1" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos','1')">
        
      </div>
    </div>
  </div>
  <!-- ======================
  FIN DEL Calendario
  ======================= -->
  {{-- ======================================
  Contador de personas
  ====================================== --}}
  <div id="contenedorPersonas1">
  </div>
  {{--  Boton de envio  --}}
  
  <div class="form-row">
    <input type="submit" value="BUSCAR" class="btn btn-primary">
  </div>
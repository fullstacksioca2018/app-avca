<div class="form-group row">
  
  <div class="col-md-4 col-form-label" >
    <label id="origen_label" for="origen_id">Ciudad de Origen</label>
    <div class="form-group">
      <select data-placeholder="Ciudad-Aeropuerto" id="origen_id1" name="origen_id[]" class="  fa-map-markerform-control chosen-select ">
        <option value="0">Ciudad o aeropuerto</option>
          @foreach ($sucursales as $sucursal)
          <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
          @endforeach
        </select>
      </div>
    </div>
  
    <div class="col-md-4 col-form-label" >
      <label id="destino_label" for="destino_id">Ciudad de Destino</label>
      <div class="input-group">
        <select data-placeholder="Ciudad-Aeropuerto" id="destino_id1" name="destino_id[]" class="form-control chosen-select ">
          <option value="0">Cuidad o aeropuerto</option>
           @foreach ($sucursales as $sucursal)
           <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
           @endforeach
        </select>
      </div>
    </div>
  
    <div class="col-md-4 col-form-label">
      <label id="fecha_salida2_label" for="salida1">Fecha de Salida</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fa fa-calendar"></i>
          </span>
        </div>
        <input type="date" class="form-control" id="salida1" name="fecha_salida[]" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}" value="{{Carbon::now()->addDay(1)->format('Y-m-d')}}">
        <input type="hidden" id="tarifamultidestino1" name="tarifamultidestino[]" value="">
      </div>
    </div>
    <div class="col-md-6 col-form-label">
                      <label id="vuelo_label" for="vuelo">Seleccione Vuelo destino N° 1</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-plane"></i>
                        </span>
                      </div>
                      <select class="form-control" id="vuelo_1" name="vuelo_[]">
                        <option value="0"> Ningun Vuelo seleccionado </option>
                      </select>
                      <input type="hidden" id="segmento1" name="segmento1" value="">
                    </div>
                  </div>
    <!-- AQUI EMPIEZA EL MULTIDESTINO -->
    @php for($i=2;$i<5;$i++){ @endphp
    <div class="form-group row" id="vuelo{{$i}}">
      <div class="col-md-4 col-form-label" >
        <label id="origen_label" for="origen_id{{$i}}">Ciudad de Origen</label>
        <div class="form-group">
           <select data-placeholder="Ciudad-Aeropuerto" id="origen_id{{$i}}" name="origen_id[]" class="  fa-map-markerform-control chosen-select ">
            <option value="0">Ciudad o aeropuerto</option>
              @foreach ($sucursales as $sucursal)
              <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4 col-form-label" >
          <label id="destino_label" for="destino_id{{$i}}">Ciudad de Destino</label>
          <div class="input-group">
            <select data-placeholder="Ciudad-Aeropuerto" id="destino_id{{$i}}" name="destino_id[]" class="form-control chosen-select ">
              <option value="0">Cuidad o aeropuerto</option>
                @foreach ($sucursales as $sucursal)
              <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
                @endforeach
            </select>
          </div>
        </div>
        
        <div class="col-md-4 col-form-label">
            <label id="fecha_salida2_label" for="fecha_salida{{$i}}">Fecha de Salida</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="hidden" id="tarifamultidestino{{$i}}" name="tarifamultidestino[]" value="">
              </div>
              <input type="date" class="form-control" id="salida{{$i}}" name="fecha_salida[]"min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}" value="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" >
            </div>
        </div>
        <div class="col-md-6 col-form-label">
                      <label id="vuelo_label" for="vuelo">Seleccione Vuelo para el destino N° {{ $i }}</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-plane"></i>
                        </span>
                      </div>
                      <select class="form-control" id="vuelo_{{ $i }}" name="vuelo_[]">
                        <option value="0"> Ningun Vuelo seleccionado </option>
                      </select>
                    </div>
                  </div>
      </div>
       @php } @endphp <!-- FIN FOR PARA GENERAR LOS OTROS DESTINOS -->
</div>
<!-- AQUI TERMINA EL MULTIDESTINO -->
<div class=" mr-5">  
  <button type="button" class="btn btn btn-sm btn-primary ion-plus" id="masV">&nbsp; &nbsp;  + &nbsp; &nbsp;</button>
  <button type="button" class="btn btn btn-sm btn-danger ion-minus-round" id="menosV">&nbsp; &nbsp;  - &nbsp; &nbsp;</button>
</div>
    
    <div class="col-md-6 col-form-label row " >
      <div class="form-group col-md-6">
        <label id="inputadultos_label" for="inputadultos3">Adultos</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fa fa-user-plus"></i>
            </span>
          </div>
          <input type="number" id="inputadultos3" min="1" max="6" class="form-control" value="1" name="inputadultos3" onchange="validarN('inputadultos','3')">
        </div>
      </div>
      <div class="form-group  col-md-6">
        <label id="inputninos_label" for="inputninos3">Niños</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fa fa-user-plus"></i>
            </span>
          </div>
          <input type="number" id="inputninos3" min="0" max="5" class="form-control" value="0" name="inputninos3" onchange="validarN('inputninos','3')">
        </div>
      </div>
    </div>
    <div id="contenedorPersonas3"></div> 
  

<div class="form-group row">
  <div class="col-md-6 col-form-label" >
    <label for="origen_id3">Ciudad Origen</label>
    <div class="form-group">
      <select data-placeholder="Ciudad-Aeropuerto" name="origen_id" class="  fa-map-markerform-control chosen-select ">
        <option value="#">Cuidad o aeropuerto</option>
        @foreach ($sucursales as $sucursal)
          <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-6 col-form-label" >
   <label for="destino_id3">Ciudad de Destino</label>
   <div class="input-group">
    <select data-placeholder="Ciudad-Aeropuerto" id="destino_id3" name="destino_id" class="form-control chosen-select ">
      <option value="#">Cuidad o aeropuerto</option>
        @foreach ($sucursales as $sucursal)
                      <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
                      @endforeach
                    </select>
                      </div>
                    </div>
                     <div class="col-md-6 col-form-label">
                      <label for="fecha_salida3">Fecha de Salida</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="date" class="form-control" id="fecha_salida3" name="fecha_salida" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}" value="{{Carbon::now()->addDay(1)->format('Y-m-d')}}">
                    </div>
                  </div>
  <div class="col-md-6 col-form-label row " >
                 <div class="form-group col-md-6">
                 <label for="inputadultos3">Adultos</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user-plus"></i>
                        </span>
                      </div>
                    
                     <input type="number" id="inputadultos3" min="1" max="5" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos','3')">

                    </div>
                  </div>
           
                  <div class="form-group  col-md-6">
             
              
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user-plus"></i>
                        </span>
                      </div>
                    <input type="number" id="inputninos3" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos','3')">
                    </div>
                  </div>
                </div>
         
        <div id="contenedorPersonas3">
</div>
                </div>
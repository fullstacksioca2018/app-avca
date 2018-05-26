
<div class="form-group row">
                  <div class="col-md-6 col-form-label" >
                    <label id="origen_label" for="origen_id">Ciudad de Origen</label>
                    <div class="form-group">
                      <select data-placeholder="Ciudad-Aeropuerto" id="origen_id_retorno" name="origen_id" class="  fa-map-markerform-control chosen-select ">
                          <option value="#">Cuidad o aeropuerto</option>
                          @foreach ($sucursales as $sucursal)
                            <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- Select para registrar el destino de llegada -->
                    <div class="col-md-6 col-form-label" >
                      <label id="destino_label" for="destino_id">Ciudad de Destino</label>
                      <div class="input-group">
                         <select data-placeholder="Ciudad-Aeropuerto" id="destino_id_retorno" name="destino_id" class="form-control chosen-select ">
                      <option value="#">Cuidad o aeropuerto</option>
                      @foreach ($sucursales as $sucursal)
                        
                          <option value="{{ $sucursal->sucursal_id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
                        
                      @endforeach
                    </select>
                      </div>
                    </div>
                     

                     <div class="col-md-6 col-form-label">
                      <label id="fecha_salida2_label" for="fecha_salida2">Fecha de Salida</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="date" class="form-control" id="fecha_salida2" name="fecha_salida2" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}" value="{{Carbon::now()->addDay(1)->format('Y-m-d')}}">
                      <input type="hidden" id="tarifaida" name="tarifaida" value="">
                    </div>
                  </div>
                  <div class="col-md-6 col-form-label">
                      <label id="fecha_regreso_label" for="fecha_regreso">Fecha de regreso</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="date" class="form-control" id="fecha_regreso" name="fecha_regreso" min="{{Carbon::now()->addDay(1)->format('Y-m-d')}}"  max="{{Carbon::now()->addYear(1)->format('Y-m-d')}}" value="{{Carbon::now()->addDay(1)->format('Y-m-d')}}" >
                      <input type="hidden" id="tarifaregreso" name="tarifaregreso" value="">
                    </div>
                  </div>
                  <div class="col-md-6 col-form-label">
                      <label id="vuelo_label" for="vuelo">Seleccione Vuelo de salida</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-plane"></i>
                        </span>
                      </div>
                      <select class="form-control" id="vuelo_ida" name="vuelo">
                        <option value="0"> Ningun Vuelo seleccionado </option>
                      </select>
                      
                    </div>
                  </div>
                  <div class="col-md-6 col-form-label">
                      <label id="vuelo_label" for="vuelo">Seleccione Vuelo de regreso</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-plane"></i>
                        </span>
                      </div>
                      <select class="form-control" id="vuelo_regreso" name="vuelo">
                        <option value="0"> Ningun Vuelo seleccionado </option>
                      </select>
                      <input type="hidden" id="precioregreso2" name="precioregreso2" value="">
                    </div>
                  </div>
   <div class="col-md-6 col-form-label row " >
    <div class="form-group col-md-6">
      <label id="inputadultos_label" for="inputadultos2">Adultos</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fa fa-user-plus"></i>
          </span>
        </div>
        <input type="number" id="inputadultos2" min="1" max="5" class="form-control" value="1" name="inputadultos2" onchange="validarN('inputadultos','2')">
      </div>
    </div>
           
                  <div class="form-group  col-md-6">
                  <label id="inputninos_label" for="inputninos2">Niños</label>              
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user-plus"></i>
                        </span>
                      </div>
                    <input type="number" id="inputninos2" min="0" max="5" class="form-control" value="0" name="inputninos2" onchange="validarN('inputninos','2')">
                    </div>
                  </div>
                </div>
         
        <div id="contenedorPersonas2"></div>
                </div>
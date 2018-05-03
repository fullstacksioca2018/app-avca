 <h1> MULTIDESTINO </h1>

 <div class="form-group row">
                  <div class="col-md-6 col-form-label" >
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
                      <div class="input-group">
                       
                         <select data-placeholder="Ciudad-Aeropuerto" name="destino_id" class="form-control chosen-select ">
                      <option value="#">Cuidad o aeropuerto</option>
                      @foreach ($sucursales as $sucursal)
                      <option value="{{ $sucursal->id }}">{{ $sucursal->ciudad }}, {{ $sucursal->pais }} ({{ $sucursal->sigla }}),  {{ $sucursal->aeropuerto }}</option>
                      @endforeach
                    </select>
                      </div>
                    </div>
                     <div class="col-md-6 col-form-label">

                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <input type="date" class="form-control" name="fecha_salida">
                    </div>
                  </div>
  <div class="col-md-6 col-form-label row " >
                 <div class="form-group col-md-6">
                 
                 
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user-plus"></i>
                        </span>
                      </div>
                    
                     <input type="number" id="inputadultos" min="1" max="5" class="form-control" value="1" name="adultos" onchange="validarN('inputadultos')">

                    </div>
                  </div>
           
                  <div class="form-group  col-md-6">
             
              
                      <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user-plus"></i>
                        </span>
                      </div>
                    <input type="number" id="inputninos" min="0" max="5" class="form-control" value="0" name="ninos" onchange="validarN('inputninos')">
                    </div>
                  </div>
                </div>
         
        <div id="contenedorPersonas">
</div>
                </div>
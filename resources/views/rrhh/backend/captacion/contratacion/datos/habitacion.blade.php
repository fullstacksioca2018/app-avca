<fieldset id="habitacion">
  @{{ message }}
  <legend>Datos de habitación</legend>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="estado">Estado</label>
        <select name="estado" id="estado" class="form-control" v-model="estado" @change="obtenerCiudades">
          <option value="" selected="selected">Seleccione</option>
          {{--<option :value="estado.estado" v-for="estado in venezuela" :key="estado.id">{{ estado.estado }}</option>--}}
        </select>
      </div>
    </div>
    {{--<div class="col-md-3">
      <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <select name="ciudad" id="ciudad" class="form-control">
          <option value="" selected="selected">Seleccione</option>
          <option :value="ciudad" v-for="ciudad in ciudadesFiltradas" :key="ciudad.id">{{ ciudad }}</option>
        </select>
      </div>
    </div>--}}
    {{--<div class="col-md-6">
      <label for="direccion">Dirección local</label>
      <div class="input-group">
        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección local">
        <div class="input-group-append">
          <span class="input-group-text">
            <i class="fa fa-location-arrow"></i>
          </span>
        </div>
      </div>
    </div>--}}
  </div>
</fieldset>

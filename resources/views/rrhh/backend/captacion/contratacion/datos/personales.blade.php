<fieldset>
  <legend>Datos personales</legend>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="cedula">Cédula</label>
        <input type="text" name="cedula" id="cedula" class="form-control" value="{{ $aspirante->cedula }}" required readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $aspirante->nombre }}" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $aspirante->apellido }}" readonly>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <p class="font-weight-bold">Nacionalidad ({{ $res = ($aspirante->nacionalidad === 'v') ? 1 : 0 }})</p>
        <label>
          <input type="radio" name="nacionalidad" value="v" {{ ($aspirante->nacionalidad === 'v') ? "checked" : "" }} disabled> V
        </label>
        <label class="ml-2">
          <input type="radio" name="nacionalidad" value="e" {{ ($aspirante->nacionalidad === 'e') ? "checked" : "" }} disabled> E
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <label for="fecha_nacimiento">Fecha de nacimiento</label>
      <div class="input-group">
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $aspirante->fecha_nacimiento }}">
        <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="estado_civil">Estado civil</label>
        <select name="estado_civil" id="estado_civil" class="form-control">
          <option value="" selected="selected">Seleccione</option>
          <option value="solter@">Solter@</option>
          <option value="casad@">Casad@</option>
          <option value="concubinato">Concubinato</option>
          <option value="divorciad@">Divorciad@</option>
          <option value="viud@">Viud@</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <label for="fecha_ingreso">Fecha de ingreso</label>
      <div class="input-group">
        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">
              <i class="fa fa-calendar"></i>
            </span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <p class="font-weight-bold">Género</p>
        <label>
          <input type="radio" name="sexo" value="f" {{ ($aspirante->sexo === 'f') ? "checked" : "" }} disabled> F
        </label>
        <label class="ml-2">
          <input type="radio" name="sexo" value="m" {{ ($aspirante->sexo === 'm') ? "checked" : "" }} disabled> M
        </label>
      </div>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-12">
      <label for="foto">Foto</label>
      <input type="file" name="foto" id="foto" class="form-control-file">
    </div>
  </div>

</fieldset>
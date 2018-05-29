<div class="modal fade" ref="modal" id="aspiranteVerificadoModal" tabindex="-1" role="dialog" aria-labelledby="aspiranteVerificadoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aspiranteVerificadoModalLabel">Convocatoria para entrevista preliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="aspiranteVerificadoForm">
          <div class="form-group">
            <label for="lugar">Lugar</label>
            <input type="text" name="lugar" id="lugar" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <p>Recaudos a consignar</p>
            <label for="certificado_medico" class="d-block">
              <input type="checkbox" name="recaudos[]" id="certificado_medico" value="Certificado Médico">
              Certificado Médico
            </label>
            <label for="titulo_grado" class="d-block">
              <input type="checkbox" name="recaudos[]" id="titulo_grado" value="Título de Grado">
              Título de Grado
            </label>
            <label for="prueba_psicotecnica" class="d-block">
              <input type="checkbox" name="recaudos[]" id="prueba_psicotecnica" value="Resultados de prueba psicotécnica">
              Resultados de prueba psicotécnica
            </label>
            <label for="rif" class="d-block">
              <input type="checkbox" name="recaudos[]" id="rif" value="RIF">
              RIF
            </label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-info">
              <i class="fa fa-envelope-o"></i> Enviar
            </button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="agregarSucursalModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Agregar sucursal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sucursal.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Sucursal</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">                        
                            <div class="form-group">
                                <label for="nombre">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_sucursal">Tipo</label>
                                <select name="tipo_sucursal" id="tipo_sucursal" class="form-control">
                                    <option value="" selected="selected">Seleccione</option>
                                    <option value="administrativa">Administrativa</option>
                                    <option value="operativa">Operativa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Registrar" class="btn btn-success">
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                
            </div>
        </div>
    </div>
</div>
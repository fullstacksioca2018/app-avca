<div class="modal fade" id="Checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: rgba(8, 30, 91, 1)">
                <h5 class="modal-title text-white" id="exampleModalLabel">Checkin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                  {!! Form::open(['route' => 'cliente.Checkin', 'method' => 'POST']) !!}
                            
                        {{ csrf_field() }}
                        
                          <div class="form-group">
                              <label for="localizador" class="col-md-4 control-label">Localizador</label>
                  
                              <div class="col-md-11">
                                  <input id="localizador" type="text" class="form-control" name="localizador"  required autofocus>
                              </div>
                          </div>
                  
                          <div class="form-group">
                              <div class="text-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                  <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)">
                                      Checkin
                                  </button>
                
                              </div>
                          </div>
                  {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
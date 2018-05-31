<div class="modal fade" id="Checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(-40deg,#45cafc,#303f9f 50%, #081e5b)!important">
                <h5 class="modal-title text-white" id="exampleModalLabel">Check-in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

<div class="d-flex justify-content-center">
                      
                      <img src="{{ asset('online/img/login/web-checkin.png') }}"  alt="" style="height: 100px" class="img-fluid mb-2 mt-3">

                  </div>

                  {!! Form::open(['route' => 'online.cliente.Checkin', 'method' => 'POST']) !!}
                            
                        {{ csrf_field() }}

                          <div class="form-group">
                              <label for="localizador" class="col-md-4 control-label"><strong>Localizador</strong></label>
                  
                              <div class="col-md-11">
                                  <input id="localizador" type="text" class="form-control impoutlgm1" name="localizador"  required autofocus>
                              </div>
                                <i class="icon ion-lock-combination icoconooo"></i>
                              <cite class="ml-5">Efectúe el Check-in aquí 23 h antes de la salida</cite>
                          </div>
                  
                          <div class="form-group">
                              <div class="text-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><strong>Cancelar</strong></button>
                                  <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)"><strong> Check-In </strong> </button>
                
                              </div>
                          </div>
                   {!! Form::close() !!} 
                
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: rgba(8, 30, 91, 1)">
                <h5 class="modal-title text-white" id="exampleModalLabel">Registrar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                  <div class="d-flex justify-content-center">
                      
                      {{-- <img src="{{ asset('img/login/Registrar.png') }}" alt="" class="img-fluid img-thumbnail mb-3"> --}}

                  </div>  
                

                  <div class="container p-3">

    
                     <form class="form-horizontal ml-4" method="POST" action="{{ url('/online/register') }}">
                        {{ csrf_field() }}


                        <div class="form-group p-1">
                            <label for="name" class="col-md-12 control-label">Nombre de usuario</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" autofocus>

                            </div>
                        </div>

                        <div class="form-group p-1">
                            <label for="email" class="col-md-12 control-label">Correo electronico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group p-1">
                            <label for="password" class="col-md-12 control-label">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group p-1">
                            <label for="password-confirm" class="col-md-12 control-label">Confirmar contraseña</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                       
                          <div class="form-group">
                              <div class="text-center">
                                 <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)">
                                         Registrar
                                 </button>
                              </div>
                         </div>


                    </form> 
                </div>
  
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: rgba(8, 30, 91, 1)">
                <h5 class="modal-title text-white" id="exampleModalLabel">Iniciar sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                  <div class="d-flex justify-content-center">
                      
                      <img src="{{ asset('img/login/login.jpeg') }}" alt="" class="img-fluid img-thumbnail mb-4 mt-4">

                  </div>  
                

                  <form class="form-horizontal ml-4" method="POST" action="{{ url('/online/login') }}">
                          {{ csrf_field() }}
                  
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col-md-4 control-label">Email</label>
                  
                              <div class="col-md-11">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                  
                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                  
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <label for="password" class="col-md-4 control-label">Contraseña</label>
                  
                              <div class="col-md-11">
                                  <input id="password" type="password" class="form-control" name="password" required>
                  
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                  
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> ¿Mantener iniciada la sesión?
                                      </label>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="form-group">
                              <div class="text-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                  <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)">
                                      Login
                                  </button>
                  
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                      ¿Olvidaste tu contraseña?
                                  </a>
                              </div>
                          </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
           
            <section>       
               
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(-40deg,#45cafc,#303f9f 50%, #081e5b)!important">
                <h5 class="modal-title text-white" id="exampleModalLabel"><strong>Iniciar sesión</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                  <div class="d-flex justify-content-center">
                      
                      <img src="{{ asset('/online/img/login/login.png') }} " alt="" style="height: 90px" class="img-fluid mb-2 mt-3">

                  </div>  
                

                  <form class="form-horizontal ml-4" method="POST" action="{{ url('/online/login') }}">
                          {{ csrf_field() }}
                          
                  
                          <div class="form-group">
                              <label for="email" class="col-md-4 control-label"><strong>Email</strong></label>
                              <div class="col-md-11">
                                  <input id="email" type="email" class="form-control impoutlgm1 " name="email" value="" required autofocus>  
                              </div>
                                <i class="icon ion-email prefix icomail2 "></i>
                          </div>
                  
                          <div class="form-group">
                              <label for="password" class="col-md-4 control-label"><strong>Contraseña</strong></label>
                              <div class="col-md-11">
                                  <input id="password" type="password" class="form-control impoutlgm inpucolorico" name="password" required>
                              </div>
                                <i class="icon ion-android-lock icocontra3"></i> 
                          </div>
                  
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="remember"> 
                                          ¿Mantener iniciada la sesión?
                                      </label>
                                  </div>
                              </div>
                          </div>
                  
                          <div class="form-group">
                              <div class="text-center">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <strong>Cancelar </strong></button>
                                  <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)"> <strong> Iniciar </strong> </button>

                                  <br>
                  
                                  <a class="btn btn-link" href="#">
                                      ¿Olvidaste tu contraseña?
                                  </a>
                              </div>
                          </div>
                  </form>
                </div>
            </div>
        </div>
    </div>



            </section>
        </div>
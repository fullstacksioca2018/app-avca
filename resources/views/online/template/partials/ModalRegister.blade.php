<!--==========================
   AKI EL INICIO DEL CHECKIN
  ============================-->

 <div class="container">
           
            <section>       
               
<div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(-40deg,#45cafc,#303f9f 50%, #081e5b)!important">
                <h5 class="modal-title text-white" id="exampleModalLabel"><strong>Registrese</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                  <div class="d-flex justify-content-center">
                      
                      <img src="{{ asset('/online/img/login/registro.png') }}" alt="" style="height: 90px" class="img-fluid mb-1 mt-2">

                  </div>  
                

                  <form class="form-horizontal ml-4" method="POST" action="{{ url('/online/register') }}">
                        {{ csrf_field() }}
                          
                  <div class="form-group">
                            <label for="name" class="col-md-12 control-label"> <strong> Nombre de usuario </strong></label>
                            <div class="col-md-11">
                                <input id="name" type="text" class="form-control impoutlgm2" name="name" autofocus>
                            </div>
                        <i class="icon ion-person-add icouseres"></i>
                        </div>

                       
                          <div class="form-group">
                              <label for="email" class="col-md-4 control-label"><strong>Correo electronico</strong></label>
                              <div class="col-md-11">
                                  <input id="email" type="email" class="form-control impoutlgm1 " name="email" value="" required autofocus>  
                              </div>
                                <i class="icon ion-email prefix icomail3"></i>
                          </div>
                  
                          <div class="form-group">
                              <label for="password" class="col-md-4 control-label"><strong>Contraseña</strong></label>
                              <div class="col-md-11">
                                  <input id="password" type="password" class="form-control impoutlgm " name="password" required>
                              </div>
                                <i class="icon ion-android-lock icocontra4"></i> 
                          </div>

                         <div class="form-group">
                              <label for="password" class="col-md-8 control-label"><strong>Confirme Contraseña</strong></label>
                              <div class="col-md-11">
                                  <input id="password" type="password" class="form-control impoutlgm " name="password_confirmation" required>
                              </div>
                                <i class="icon ion-android-lock icocontra5"></i> 
                          </div>

                              <div class="form-group text-center">
                                 <button type="submit" class="btn" style="background: rgba(8, 30, 91, 1)">
                                        <strong> Registrarse </strong>
                                 </button>
                              </div>
                  </form>
                </div>
            </div>
        </div>
    </div>



            </section>
        </div>
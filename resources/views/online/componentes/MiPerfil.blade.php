@extends('online.template.main2')
@section('title','Detalle Vuelo')
@section('content')

<!--==========================
    Intro Section
  ============================-->



    <!--==========================
     DESDEEEEE AKIIIII COÑOOOOO Con todo y comentario
    ============================-->

<br>
    <div class=" col-md-12 col-lg-12">
<div class="card border-primary border-bottom-0 mb-3">
  <div class="card-header" id="grad1" id="joder" >
     <div class="py-2 text-center box wow flipInX" data-wow-duration="0.8s">
      <img class=" mx-auto img-fluid" src="{{ asset('/online/img/logo.png') }}" width="150px" height="100px">
        <h2>Mi Perfil</h2>
        <cite class="lead">Viaje con nosotros y llenase de experiencias y diversión.</cite>
        
     </div>
    
  </div>

  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
    
          <div class="row col-sm-11 col-md-12"> <!-- ==Contenido datos del pasajero==-->
                        <div class="col-md-9 col-sm-9 order-md-2 order-sm-2 mb-1 mt-5 pt-2 box wow fadeInLeft " data-wow-duration="0.6s">

                                          <div class="table-responsive">  
                                            <!--Table-->
                                           <table class="table table-hover text-center">
                                                <!--Table head-->
                                                <thead class="mdb-color primary-color">
                                                    <tr class="text-white">
                                                      @if(isset ($cliente))
                                                        <th><strong>Nombre: {{ $cliente->nombre }}</strong></th>
                                                      @else
                                                        <th><strong>Nombre:</strong></th>  
                                                      @endif

                                                      @if(isset ($cliente))
                                                        <th><strong>Apellido: {{ $cliente->apellido }}</strong></th>
                                                      @else
                                                        <th><strong>Apellido:</strong></th>  
                                                      @endif
                                                      
                                                      @if(isset($cliente))

                                                        @if($cliente->tipo_documento == 'Venezolano/a')
                                                          <th><strong>Identificacion: V-{{ $cliente->documento }}</strong></th>        
                                                        @else
                                                          <th><strong>Identificacion: P-{{ $cliente->documento }}</strong></th>    
                                                        @endif

                                                      @else
                                                        <th><strong>Identificacion:</strong></th>
                                                      @endif        
                                                    </tr>
                                                </thead>
                                                <!--Table head-->
                                            
                                                <!--Table body-->
                                                <tbody>
                                                    <tr>
                                                      
                                                       @if(isset($cliente))       
                                                        <th scope="row">Celular: {{ $cliente->telefono_movil }}</th>
                                                       @else
                                                        <th scope="row">Celular:</th>
                                                       @endif

                                                       @if(isset($cliente))
                                                          <td>Telefono fijo: {{ $cliente->telefono_fijo }}</td>
                                                       @else
                                                          <td>Telefono fijo:</td>
                                                       @endif

                                                        <td>Correo: {{ Auth::guard('online')->user()->email }}</td>          
                                                    </tr>
                                                    <tr>

                                                      @if(isset($cliente))
                                                        <th scope="row">Nacionalidad: {{ $cliente->pais }}</th>
                                                      @else
                                                        <th scope="row">Nacionalidad:</th>
                                                      @endif

                                                      @if(isset($cliente))
                                                        <td>Nacimiento: {{ $cliente->fecha_nacimiento }}</td>
                                                      @else
                                                        <td>Nacimiento:</td>
                                                      @endif
                                                      
                                                      @if(isset($cliente))
                                                        <td>Sexo: {{ $cliente->genero }}</td>
                                                      @else
                                                        <td>Sexo:</td>
                                                      @endif      
                                                      
                                                       
                                                     </tr>                                        
                                           </table><!--Table body-->
                                          </div>
<a class="btn btn-md btn-info btncosto" style="margin-left: 75px;" href="{{ URL::to('/online/cliente/ModificarPerfil', Auth::guard('online')->user()->id) }}" class="thbtn"> <strong>Modificar</strong></a>
                        </div><!-- ==  Contenido datos del pasajero==-->
     
                  <div class="col-md-2 col-sm-3 order-md-1 order-sm-1">
             <!--  <h3 class="mb-4 ml-5">Formulario De Perfil</h3> JODAAAA Cliente -->
                    <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.6s">
                    @if(isset(Auth::guard('online')->user()->avatar))
                          
                          <img src="/online/img/avatar/{{ Auth::guard('online')->user()->avatar }}" class="img-responsive" style="margin-left: -2px; width:140px; height:120px"  value = "{{ Auth::guard('online')->user()->avatar }}" placeholder="{{ Auth::guard('online')->user()->avatar }}">

                    @else
                          
                          <img src="{{ asset('online/img/login/login.png') }}" class="img-responsive" style="margin-left: -22px; width:180px; height:170px;">

                    @endif
                           <cite class="text-center">Usuario: {{ Auth::guard('online')->user()->name }}</cite>  
                    </div>
                  </div>    
              </div><!--== Fin rowContenido datos del pasajero== -->

          <hr class="mb-4">

                
            <!--CONTAINER DETALLES DEL RETORNO-->

  <div class="container-detalles box wow bounceInUp" data-wow-duration="2s"> 
     <div class="card-detalles">
      <div class="row sm-8">
        <div class="col-sm-11">
        

       <!--VER MAS-->
       
      
         


          <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="false">

       <div class="vermas  mb-5">
        
        <div class="dropdown">
              <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Historico de Boletos
              </a>
              

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

              <div class="dropdown-divider"></div>
                
                <a  class="dropdown-item" role="tab" id="heading1" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapse1">
                  <h6 class="mb-0">
                     Todos los boletos 
                  </h6>
                </a>
              
              <div class="dropdown-divider"></div>

                <a class="dropdown-item" role="tab" id="heading2" class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h6 class="mb-0">
                    Boletos Pagados 
                  </h6>
                </a>
              
              <div class="dropdown-divider"></div>

                <a class="dropdown-item" role="tab" id="heading3" class="collapsed" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                  <h6 class="mb-0">
                    Boletos Chequeados 
                  </h6>
                </a>
              
              <div class="dropdown-divider"></div>

                <a class="dropdown-item" role="tab" id="heading4" class="collapsed" data-toggle="collapse" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                  <h6 class="mb-0">
                    Boletos Reservados 
                  </h6>
                </a>
              
              <div class="dropdown-divider"></div>

                <a class="dropdown-item" role="tab" id="heading5" class="collapsed" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                  <h6 class="mb-0">
                    Boletos Cancelados 
                  </h6>
                </a>

              </div>

        </div>

         </div> 

      {{--========== Inicio de collapse 1 ===========--}}

          <div id="collapseOne" class="collapse show " role="button" aria-labelledby="heading1" data-parent="#accordionEx" >
          
                <h6>Historicos de boletos</h6> 

          <div class="table-responsive">
          
           <table class="table table-md table-hover text-center ">
            
            @if(count($boletos) == 0)
                          <h3 class="text-center"> La compra y chequeo de boleto en AVCA se reflejara si realiza la operación. <small>No pierda
                               su oportunidad de disfrutar de nuestros servicios.</small>  </h3>                                                      
            @endif

              <thead>
                <tr class="table-detalles2">
                  <th scope="col"><strong>Pasajero</strong></th>
                  <th scope="col"><strong>Desde-Hasta</strong></th>        
                  <th scope="col"><strong>Fecha de salida</strong></th>
                  <th scope="col"><strong>Salida/Llegada</strong></th>
                  <th scope="col"><strong>Localizador</strong></th>
                  <th scope="col"><strong>Status</strong></th>
                  <th scope="col"><strong>Acción</strong></th>
                </tr>
              </thead>
              
               @foreach ($boletos as $boleto)
              
                @php
                  $salida = Carbon::parse($boleto->fecha_salida);
                  $fecha = Carbon::parse($boleto->fecha_salida);
                  $hora=Carbon::parse($boleto->duracion);
                  $llegada=$salida->copy();
                  $llegada->addHours($hora->hour);
                  $llegada->addMinutes($hora->minute);
                @endphp

              <tbody>
                <tr>
                  <td scope="row">{{ $boleto->pasajero }}</td>
                  <td>{{ $boleto->sigla_origen }}-{{ $boleto->sigla_destino }}</td>
                  <td>{{ $fecha->format('d/m/Y') }}</td>
                  <td>{{ $salida->format('h:i A') }}/{{ $llegada->format('h:i A') }}</td>
                  <td>{{ $boleto->localizador }}</td>
                    
                  @if($boleto->estatus == 'Pagado')
                      <td> <p class=""> {{ $boleto->estatus }} </p></td>
                      <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#chequeo{{ $boleto->boleto_id }}"> Check-in</a></td>

  <div class="modal fade" id="chequeo{{ $boleto->boleto_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <input id="localizador" type="text" class="form-control impoutlgm1" name="localizador" value="{{ $boleto->localizador }}"  required autofocus>
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

            @endif

                  @if($boleto->estatus == 'Chequeado')
                      <td> <p class=""> {{ $boleto->estatus }} </p></td>
                  
                  @endif

                  @if(($boleto->estatus == 'Reservado'))
                    <td> <p class=""> {{ $boleto->estatus }} </p></td>

                    <td><a href="#" class="btn btn-primary btn-sm" 
                        data-toggle="modal" data-target="#exampleModal{{ $boleto->boleto_id }}">Comprar Boleto</a>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $boleto->boleto_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Proceso de pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                    <!-- <article class="card"> -->
                    <div class="card-body">
                    <p> <img src="{{ asset('online/img/pago/pay-visa.png') }}"> 
                       <img src="{{ asset('online/img/pago/pay-mastercard.png') }}"> 
                       <img src="{{ asset('online/img/pago/pay-american-ex.png') }}">
                       <img src="{{ asset('online/img/pago/pay-visa-el.png') }}">
                    </p>
                    <!-- <p class="alert alert-success">ingrese los datos correctamnete</p> -->
                  <form method="post" action="{{ URL::to('/online/cliente/ReservaPagada') }}" >
                                {{ csrf_field() }}
                    <input type="hidden" name="importe_facturado" value="{{ $boleto->importe_facturado }}">
                    <input type="hidden" name="boleto_id" value="{{ $boleto->boleto_id }}">

                    <div class="form-group">
                    <label for="username">Nombre completo (Como aparace en la tarjeta)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                       <input type="text" class="form-control" name="usernam" id="cc-name" placeholder="" required="">
                                    <small class="text-muted"></small>
                                    <div class="invalid-feedback">
                                      nombre requerido
                                    </div>
                    </div> <!-- input-group.// -->
                    </div> <!-- form-group.// -->

                    <div class="form-group">
                    <label for="cardNumber">Numero de la Tarjeta</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                      </div>
                      <input type="text" class="form-control" name="numero_tarjeta" id="cc-number" placeholder="">
                      <div class="invalid-feedback" minlength="18" maxlength="18">
                                      Requiere el numero de tarjeta
                                    </div>
                    </div> <!-- input-group.// -->
                    </div> <!-- form-group.// -->

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><span class="hidden-xs">Fecha de Vencimiento</span> </label>
                              <div class="form-inline"  id="cc-expiration">
                            <select class="form-control" name="fecha_vencimiento" style="width:45%" required>
                              <option>MM</option>
                              <option value="01 - Enero">01 - Enero</option>
                              <option value="02 - Febrero">02 - Febrero</option>
                              <option value="03 - Marzo">03 - Marzo</option>
                              <option value="04 - Abril">04 - Abril</option>
                              <option value="05 - Mayo">05 - Mayo</option>
                              <option value="06 - Junio">06 - Junio</option>
                              <option value="07 - Julio">07 - Julio</option>
                              <option value="08 - Agosto">08 - Agosto</option>
                              <option value="09 - Septiembre">09 - Septiembre</option>
                              <option value="10 - Octubre">10 - Octubre</option>
                              <option value="11 - Noviembre">11 - Noviembre</option>
                              <option value="12 - Diciembre">12 - Diciembre</option>
                            </select>
                                  <span style="width:10%; text-align: center"> / </span>
                                  <select class="form-control" style="width:45%" required>
                              <option>YY</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                            </select>
                              </div>
                              <div class="invalid-feedback">
                                      requiere la fecha de Vencimiento
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                <input type="password" class="form-control" name="csc" id="cc-cvv" minlength="3" maxlength="3" placeholder="***" required>
                            </div> <!-- form-group.// -->
                            <div class="invalid-feedback">
                                     es necesario el CVV
                            </div>
                        </div>
                    </div> <!-- row.// -->
                    <button class="subscribe btn btn-primary" type="submit"> Confirmar </button>

                    </div> <!-- card-body.// -->
                    <!-- </article>  card.// -->


                        </div>
                          <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>  -->
                          </div>
                        </div>
                      </div>
                    </div>
             </form>
                    <!-- FIN DEL MODAL -->

                  @endif

                  @if(($boleto->estatus == 'Cancelado'))
                    <td> <p class=""> {{ $boleto->estatus }} </p></td>
                  @endif

                </tr>
             </tbody> 
            @endforeach

          </table>
        </div>
          <hr class="mb-4">
        </div>
  
  {{--========== Inicio de collapse 2 ===========--}}

  <div id="collapseTwo" class="collapse" role="button" aria-labelledby="heading2" data-parent="#accordionEx" >
          
                <h5>Tus Boletos Pagados</h5> 

          <div class="table-responsive">
                <table class="table table-md table-hover text-center ">
                  
                @if(count($boletos) == 0)
                      <h3 class="text-center"> En boletos pagados se refleja todos los boletos comprados en AVCA. <small>No pierdas
                           su oportunidad de disfrutar de nuestros servicios.</small>  </h3>
                @endif

                <thead>
                  <tr class="table-detalles2">
                    <th scope="col"><strong>Pasajero</strong></th>
                    <th scope="col"><strong>Desde-Hasta</strong></th>        
                    <th scope="col"><strong>Fecha de salida</strong></th>
                    <th scope="col"><strong>Salida/Llegada</strong></th>
                    <th scope="col"><strong>Localizador</strong></th>
                    <th scope="col"><strong>Status</strong></th>
                    <th scope="col"><strong>Acción</strong></th>
                  </tr>
                </thead>
                
                  @foreach ($boletos as $boleto)
                    @if($boleto->estatus == 'Pagado')
                        @php
                  $salida = Carbon::parse($boleto->fecha_salida);
                  $fecha = Carbon::parse($boleto->fecha_salida);
                  $hora=Carbon::parse($boleto->duracion);
                  $llegada=$salida->copy();
                  $llegada->addHours($hora->hour);
                  $llegada->addMinutes($hora->minute);
                @endphp
                
              <tbody>
                <tr>
                  <td scope="row">{{ $boleto->pasajero }}</td>
                  <td>{{ $boleto->sigla_origen }}-{{ $boleto->sigla_destino }}</td>
                  <td>{{ $fecha->format('d/m/Y') }}</td>
                  <td>{{ $salida->format('h:i A') }}/{{ $llegada->format('h:i A') }}</td>
                  <td>{{ $boleto->localizador }}</td>
                    
                  @if($boleto->estatus == 'Pagado')
                      <td> <p class=""> {{ $boleto->estatus }} </p></td>
                      <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#chequeo{{ $boleto->boleto_id }}"> Check-in</a></td>

  <div class="modal fade" id="chequeo{{ $boleto->boleto_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              <input id="localizador" type="text" class="form-control impoutlgm1" name="localizador" value="{{ $boleto->localizador }}"  required autofocus>
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


                  @else
                      <td> <p class="badge badge-warning badge-pill"> {{ $boleto->estatus }} </p></td>
                  @endif

                </tr>
             </tbody> 
                    @endif
                    
                  @endforeach

                </table>
                </div>
                <hr class="mb-4">
   </div>


{{--========== Inicio de collapse 3 ===========--}}   
  
  <div id="collapse3" class="collapse" role="button" aria-labelledby="heading3" data-parent="#accordionEx" >
                
                <h5>Tus boletos chequeados</h5>
                <div class="table-responsive">
                <table class="table table-md table-hover text-center ">

                @if(count($boletos) == 0)
                      <h3 class="text-center"> En boletos chequados se refleja todos los boletos chequados 24hr antes de su vuelo con AVCA. <small> No pierdas su oportunidad de disfrutar de nuestros servicios. </small></h3>
                @endif

                <thead>
                  <tr class="table-detalles2">
                    <th scope="col"><strong>Pasajero</strong></th>
                    <th scope="col"><strong>Desde-Hasta</strong></th>        
                    <th scope="col"><strong>Fecha de salida</strong></th>
                    <th scope="col"><strong>Salida/Llegada</strong></th>
                    <th scope="col"><strong>Localizador</strong></th>
                    <th scope="col"><strong>Status</strong></th>
                    <th scope="col"><strong>Acción</strong></th>
                  </tr>
                </thead>

                  @foreach ($boletos as $boleto)
                    @if($boleto->estatus == 'Chequeado')
                      @php
                        $salida = Carbon::parse($boleto->fecha_salida);
                        $fecha = Carbon::parse($boleto->fecha_salida);
                        $hora=Carbon::parse($boleto->duracion);
                        $llegada=$salida->copy();
                        $llegada->addHours($hora->hour);
                        $llegada->addMinutes($hora->minute);
                      @endphp
                
              <tbody>
                <tr>
                  <td scope="row">{{ $boleto->pasajero }}</td>
                  <td>{{ $boleto->sigla_origen }}-{{ $boleto->sigla_destino }}</td>
                  <td>{{ $fecha->format('d/m/Y') }}</td>
                  <td>{{ $salida->format('h:i A') }}/{{ $llegada->format('h:i A') }}</td>
                  <td>{{ $boleto->localizador }}</td>
                  <td>{{ $boleto->estatus }}</td>      
                </tr>
             </tbody> 

                      @endif

                    @endforeach    
                    
                </table>
                </div>
                <hr class="mb-4">

    </div>

    {{--========== Inicio de collapse 4 ===========--}}

          <div id="collapse4" class="collapse" role="button" aria-labelledby="heading4" data-parent="#accordionEx" >
          
                <h6>Tus boletos reservados</h6> 

          <div class="table-responsive">
          
           <table class="table table-md table-hover text-center ">
            
            @if(count($boletos) == 0)
                          <h3 class="text-center">  En tus boletos reservados se refleja todos los boletos reservados en el dia anterior de su vuelo con AVCA. <small> No pierdas su oportunidad de disfrutar de nuestros servicios. </small>  </h3>                                                      
            @endif

              <thead>
                <tr class="table-detalles2">
                  <th scope="col"><strong>Pasajero</strong></th>
                  <th scope="col"><strong>Desde-Hasta</strong></th>        
                  <th scope="col"><strong>Fecha de salida</strong></th>
                  <th scope="col"><strong>Salida/Llegada</strong></th>
                  <th scope="col"><strong>Localizador</strong></th>
                  <th scope="col"><strong>Status</strong></th>
                  <th scope="col"><strong>Acción</strong></th>
                </tr>
              </thead>
              
               @foreach ($boletos as $boleto)
              
                @php
                  $salida = Carbon::parse($boleto->fecha_salida);
                  $fecha = Carbon::parse($boleto->fecha_salida);
                  $hora=Carbon::parse($boleto->duracion);
                  $llegada=$salida->copy();
                  $llegada->addHours($hora->hour);
                  $llegada->addMinutes($hora->minute);
                @endphp

              <tbody>
                <tr>

                  @if($boleto->estatus == 'Reservado')

                    <td scope="row">{{ $boleto->pasajero }}</td>
                    <td>{{ $boleto->sigla_origen }}-{{ $boleto->sigla_destino }}</td>
                    <td>{{ $fecha->format('d/m/Y') }}</td>
                    <td>{{ $salida->format('h:i A') }}/{{ $llegada->format('h:i A') }}</td>
                    <td>{{ $boleto->localizador }}</td>
                    <td> <p class=""> {{ $boleto->estatus }} </p></td>

                    <td><a href="#" class="btn btn-primary btn-sm" 
                        data-toggle="modal" data-target="#exampleModal{{ $boleto->boleto_id }}">Comprar Boleto</a>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $boleto->boleto_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Proceso de pago</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                    <!-- <article class="card"> -->
                    <div class="card-body">
                    <p> <img src="{{ asset('online/img/pago/pay-visa.png') }}"> 
                       <img src="{{ asset('online/img/pago/pay-mastercard.png') }}"> 
                       <img src="{{ asset('online/img/pago/pay-american-ex.png') }}">
                       <img src="{{ asset('online/img/pago/pay-visa-el.png') }}">
                    </p>
                    <!-- <p class="alert alert-success">ingrese los datos correctamnete</p> -->
                  <form method="post" action="{{ URL::to('/online/cliente/ReservaPagada') }}" >
                                {{ csrf_field() }}
                    <input type="hidden" name="importe_facturado" value="{{ $boleto->importe_facturado }}">
                    <input type="hidden" name="boleto_id" value="{{ $boleto->boleto_id }}">

                    <div class="form-group">
                    <label for="username">Nombre completo (Como aparace en la tarjeta)</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                       <input type="text" class="form-control" name="usernam" id="cc-name" placeholder="" required="">
                                    <small class="text-muted"></small>
                                    <div class="invalid-feedback">
                                      nombre requerido
                                    </div>
                    </div> <!-- input-group.// -->
                    </div> <!-- form-group.// -->

                    <div class="form-group">
                    <label for="cardNumber">Numero de la Tarjeta</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                      </div>
                      <input type="text" class="form-control" name="numero_tarjeta" id="cc-number" placeholder="">
                      <div class="invalid-feedback" minlength="18" maxlength="18">
                                      Requiere el numero de tarjeta
                                    </div>
                    </div> <!-- input-group.// -->
                    </div> <!-- form-group.// -->

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label><span class="hidden-xs">Fecha de Vencimiento</span> </label>
                              <div class="form-inline"  id="cc-expiration">
                            <select class="form-control" name="fecha_vencimiento" style="width:45%" required>
                              <option>MM</option>
                              <option value="01 - Enero">01 - Enero</option>
                              <option value="02 - Febrero">02 - Febrero</option>
                              <option value="03 - Marzo">03 - Marzo</option>
                              <option value="04 - Abril">04 - Abril</option>
                              <option value="05 - Mayo">05 - Mayo</option>
                              <option value="06 - Junio">06 - Junio</option>
                              <option value="07 - Julio">07 - Julio</option>
                              <option value="08 - Agosto">08 - Agosto</option>
                              <option value="09 - Septiembre">09 - Septiembre</option>
                              <option value="10 - Octubre">10 - Octubre</option>
                              <option value="11 - Noviembre">11 - Noviembre</option>
                              <option value="12 - Diciembre">12 - Diciembre</option>
                            </select>
                                  <span style="width:10%; text-align: center"> / </span>
                                  <select class="form-control" style="width:45%" required>
                              <option>YY</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                            </select>
                              </div>
                              <div class="invalid-feedback">
                                      requiere la fecha de Vencimiento
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                <input type="password" class="form-control" name="csc" id="cc-cvv" minlength="3" maxlength="3" placeholder="***" required>
                            </div> <!-- form-group.// -->
                            <div class="invalid-feedback">
                                     es necesario el CVV
                            </div>
                        </div>
                    </div> <!-- row.// -->
                    <button class="subscribe btn btn-primary" type="submit"> Confirmar </button>

                    </div> <!-- card-body.// -->
                    <!-- </article>  card.// -->


                        </div>
                          <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>  -->
                          </div>
                        </div>
                      </div>
                    </div>
             </form>
                    <!-- FIN DEL MODAL -->

                  @endif

                </tr>
             </tbody> 
            @endforeach

          </table>
        </div>
          <hr class="mb-4">
        </div>
  
  {{--========== Inicio de collapse 5 ===========--}}
  <div id="collapse5" class="collapse" role="button" aria-labelledby="heading5" data-parent="#accordionEx" >
                
                <h5>Tus boletos cancelados</h5>
                <div class="table-responsive">
                <table class="table table-md table-hover text-center ">

                @if(count($boletos) == 0)
                      <h3 class="text-center"> En tus boletos cancelados se refleja todos los boletos cancelados por no realizar el pago a tiempo de su reserva de boleto con AVCA. <small> No pierdas su oportunidad de disfrutar de nuestros servicios. </small></h3>
                @endif

                <thead>
                  <tr class="table-detalles2">
                    <th scope="col"><strong>Pasajero</strong></th>
                    <th scope="col"><strong>Desde-Hasta</strong></th>        
                    <th scope="col"><strong>Fecha de salida</strong></th>
                    <th scope="col"><strong>Salida/Llegada</strong></th>
                    <th scope="col"><strong>Localizador</strong></th>
                    <th scope="col"><strong>Status</strong></th>
                    <th scope="col"><strong>Acción</strong></th>
                  </tr>
                </thead>

                  @foreach ($boletos as $boleto)
                    @if($boleto->estatus == 'Cancelado')
                      @php
                        $salida = Carbon::parse($boleto->fecha_salida);
                        $fecha = Carbon::parse($boleto->fecha_salida);
                        $hora=Carbon::parse($boleto->duracion);
                        $llegada=$salida->copy();
                        $llegada->addHours($hora->hour);
                        $llegada->addMinutes($hora->minute);
                      @endphp
                
              <tbody>
                <tr>
                  <td scope="row">{{ $boleto->pasajero }}</td>
                  <td>{{ $boleto->sigla_origen }}-{{ $boleto->sigla_destino }}</td>
                  <td>{{ $fecha->format('d/m/Y') }}</td>
                  <td>{{ $salida->format('h:i A') }}/{{ $llegada->format('h:i A') }}</td>
                  <td>{{ $boleto->localizador }}</td>
                  <td>{{ $boleto->estatus }}</td>      
                </tr>
             </tbody> 

                      @endif

                    @endforeach    
                    
                </table>
                </div>
                <hr class="mb-4">
    </div>

        
     </div><!--col-sm-10-->

    
   </div><!--row sm-4-->

</div>
</div>
<!--hasta aquí el detalles-->             
      
      <br> <br>
</div>
</div>
<br> <br><br> <br>
<!-- ========================
AKI EL CIERRE DEL COÑOOOO NO INVENTAR
===================================== -->
	

@endsection
@extends('online.template.main2')
@section('title','Detalle Vuelo')
@section('content')
	<!--==========================
  DESDEEEEE AKIIIII COÑOOOOO Con todo y comentario
============================-->

{{-- <br> --}}
    <div class=" col-md-12 col-lg-12">
<div class="card border-primary border-bottom-0 mb-3">
  <div class="card-header" id="grad1" id="joder" style=" height: 96px;" >
     <div class="py-2 text-center box wow flipInX" data-wow-duration="0.8s">
      <!-- <img class=" mx-auto img-fluid" src="{{ asset('/online/img/logo.png') }}""  width="100px" height="80px"> -->
        <h5 class="pt-2"> <b> A Un Click de Realizar sus sueños </b></h5>
        <cite class="lead">Felicidades se encuentra a pocas horas de llenarse de experiencias y diversión.</cite>
        
     </div>
    
  </div>

  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
    
          <div class="row col-sm-11 col-md-12"> <!-- ==Contenido datos del pasajero==-->
                        <div class="col-md-9 col-sm-9 order-md-2 order-sm-2 mb-1 mt-2 pt-1 box wow fadeInLeft " data-wow-duration="0.6s">


                                          <div class="table-responsive">
                                        @if($datos_vuelos->estatus == 'Chequeado')    
                                          <h3><strong> Datos del Pasajero: Chequeado</strong> </h3>

                                        @else
                                          <h3><strong> Datos del Pasajero:</strong> </h3>
                                        @endif
                                            <!--Table-->
                                           <table class="table table-hover text-center">
                                                <!--Table head-->
                                                <thead class="mdb-color primary-color">
                                                    <tr class="text-white">
                                                     
                                                     @if(isset($datos_vuelos))
                                                        <th><strong>Nombre: {{ $datos_vuelos->nombre_pasajero }}</strong></th>
                                                     @else
                                                        <th><strong>Nombre:</strong></th>      
                                                     @endif
                                                                                                            
                                                     @if(isset($datos_vuelos))  
                                                        <th><strong>Apellido: {{ $datos_vuelos->apellido_pasajero }}</strong></th>
                                                     @else
                                                        <th><strong>Apellido:</strong></th>
                                                     @endif
                                                      
                                                     @if(isset($datos_vuelos))

                                                        @if($datos_vuelos->tipo_documento == 'Venezolano/a')
                                                          <th><strong>Identificacion: V-{{ $datos_vuelos->documento }}</strong></th>        
                                                        @else
                                                          <th><strong>Identificacion: P-{{ $datos_vuelos->documento }}</strong></th>    
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
                                                      @if(isset($datos_vuelos))
                                                        <th scope="row">Tipo de boleto: {{ $datos_vuelos->tipo_boleto }}</th>
                                                      @else
                                                        <th scope="row">Tipo boleto:</th>
                                                      @endif

                                                      @if(isset($datos_vuelos))
                                                        <td>Fecha de nacimiento: {{ $datos_vuelos->fecha_nacimiento }}</td>
                                                      @else
                                                        <td>Fecha de nacimiento:</td>
                                                      @endif  
                                                      
                                                      @if(isset($datos_vuelos))
                                                       <td>Sexo: {{ $datos_vuelos->genero }}</td>
                                                      @else
                                                       <td>Sexo:</td>
                                                      @endif

                                                    </tr>
                                                     </tbody>                                        
                                           </table><!--Table body-->
                                          </div>
                                              <!-- =========================================================FIN TABLA DEL PASAJERO=========================== -->

                        </div><!-- ==  Contenido datos del pasajero==-->
     
                  <div class="col-md-1 col-sm-3 order-md-1 order-sm-1">
                  </div>    
              </div><!--== Fin rowContenido datos del pasajero== -->

          <hr class="mb-4">

                
            <!--CONTAINER DETALLES DEL RETORNO-->

  @php
      $salida = Carbon::parse($datos_vuelos->fecha_salida);
      $fecha = Carbon::parse($datos_vuelos->fecha_salida);
      $hora=Carbon::parse($datos_vuelos->duracion);
      $llegada=$salida->copy();
      $llegada->addHours($hora->hour);
      $llegada->addMinutes($hora->minute);
    @endphp

  <div class="container-detalles box wow bounceInUp" data-wow-duration="2s"> 
     <div class="card-detalles">
      <div class="row sm-8">
        <div class="col-sm-11">
        <table class="table table-sm ">
          <thead>
            <th class="table-detalles" colspan="4"><img src="{{ asset('/online/img/logo.png') }}" width="100px" height="46"  class="d-inline-block align-right " alt="AVCA">  <h5> <b>Detalles del Vuelo</b></h5> </th>
          </thead>
              <tbody>
                <tr class="table-detalles2">
                  <th scope="row" class="pthsiglas">{{ $datos_vuelos->origen }} ({{ $datos_vuelos->sigla_origen }}) </th>
                  <th></th>
                  <th class="pthsiglas"> {{ $datos_vuelos->destino }}({{ $datos_vuelos->sigla_destino }})</th>
                  <th >seleccione su puesto de preferencia</th>
                  

                </tr>
                
                  <th scope="col" class="pthhrs">Salida: {{ $salida->format('h:i A') }}</th>
                  <th></th>
                  <th scope="col " class="pthhrs">Llegada: {{ $llegada->format('h:i A') }}</th>
                  <th > V(ventana) P(pasillo) Ejemplo: P-2</th>
                  
                <tr>
                 <th class="pthhrs">Fecha de salida: {{ $fecha->format('d/m/Y') }}</th>
                 <th></th>
                 
                  @if($datos_vuelos->tipo_boleto == 'adulto')
                    <th class="pthhrs">Costo: {{ $datos_vuelos->tarifa_vuelo }}Bs</th>
                  @else
                    <th class="pthhrs">Costo: 0Bs</th>
                  @endif
            
                {!! Form::open(['route' => 'online.cliente.BoletoChequeado', 'method' => 'POST']) !!}
                  
                  <input type="hidden" name="localizador" value="{{ $datos_vuelos->localizador }}">

                  
                  <th>   <div class="form-group row">   
                            <div class="col-sm-5">

                    @if(($datos_vuelos->tipo_boleto == 'adulto')&&($datos_vuelos->estatus == 'Pagado'))
                              <select data-placeholder="Ciudad-Aeropuerto" name="asiento" class="chosen-select impoutperfil2" class="form-control" tabindex="2" required>
                               <option>Puesto</option>       
                               <option value="V-1">V-1</option>
                               <option value="P-2">P-2</option>
                               <option value="P-3">P-3</option>
                               <option value="V-4">V-4</option>
                               <option value="V-5">V-5</option>
                               <option value="P-6">P-6</option>
                               <option value="P-7">P-7</option>
                               <option value="V-8">V-8</option>
                               <option value="V-9">V-9</option>
                               <option value="P-10">P-10</option>
                               <option value="P-11">P-11</option>
                               <option value="V-12">V-12</option>
                               <option value="V-13">V-13</option>
                               <option value="P-14">P-14</option>
                               <option value="P-15">P-15</option>
                               <option value="V-16">V-16</option>
                               <option value="V-17">V-17</option>
                               <option value="P-18">P-18</option>
                               <option value="P-19">P-19</option>
                               <option value="V-20">V-20</option>
                               <option value="V-21">V-21</option>
                               <option value="P-22">P-22</option>
                               <option value="P-23">P-23</option>
                               <option value="V-24">V-24</option>
                               <option value="V-25">V-25</option>
                               <option value="P-26">P-26</option>
                               <option value="P-27">P-27</option>
                               <option value="V-28">V-28</option>
                               <option value="V-29">V-29</option>
                               <option value="P-30">P-30</option>
                               <option value="P-31">P-31</option>
                               <option value="V-32">V-32</option>
                               <option value="V-33">V-33</option>
                               <option value="P-34">P-34</option>
                               <option value="P-35">P-35</option>
                               <option value="V-36">V-36</option>
                               <option value="V-37">V-37</option>
                               <option value="P-38">P-38</option>
                               <option value="P-39">P-39</option>
                               <option value="V-40">V-40</option>
                               <option value="V-41">V-41</option>
                               <option value="P-42">P-42</option>
                               <option value="P-43">P-43</option>
                               <option value="V-44">V-44</option>
                               <option value="V-45">V-45</option>
                               <option value="P-46">P-46</option>
                               <option value="P-47">P-47</option>
                               <option value="V-48">V-48</option>
                               <option value="V-49">V-49</option>
                               <option value="P-50">P-50</option>
                               <option value="P-51">P-51</option>
                               <option value="V-52">V-52</option>
                               <option value="V-53">V-53</option>
                               <option value="P-54">P-54</option>
                               <option value="P-55">P-55</option>
                               <option value="V-56">V-56</option>
                               <option value="V-57">V-57</option>
                               <option value="P-58">P-58</option>
                               <option value="P-59">P-59</option>
                               <option value="V-60">V-60</option>
                               <option value="V-61">V-61</option>
                               <option value="P-62">P-62</option>
                               <option value="P-63">P-63</option>
                               <option value="V-64">V-64</option>                               

                              </select>
                           @else
                              <select data-placeholder="Ciudad-Aeropuerto" name="asiento" class="chosen-select impoutperfil2" class="form-control" tabindex="2" disabled="">
                                <option>Puesto</option>
                              </select>
                           @endif    
                            </div>     
                             <div class="invalid-feedback "> no olivide selecionar su puesto  </div>
                          </div>  
                  </th>

                </tr>

              </tbody>          
       </table>


       <!--VER MAS-->
       @if($datos_vuelos->estatus == 'Pagado')
         <div class="vermas">
            <a class="btn btn-sm btn-primary btncosto mr-5" data-toggle="collapse" href="#detalles" role="button" aria-expanded="false" aria-controls="#detalles">Detalles del vuelo y equipaje <i class="fa fa-arrow-circle-down"></i></a>
            <a href="{{ URL::to('/online/cliente/MiPerfil', Auth::guard('online')->user()->id) }}" class="btn btn-md btn-danger btncosto " style="margin-left: 30px;" class="thbtn">cancelar</a>
            <button type="submit" class="btn btn-md btn-primary btncosto " style="margin-left: 50px;" class="thbtn">Aceptar</button>
          </div> 

       @else

         <div class="vermas">
            <a class="btn btn-sm btn-primary btncosto mr-5" data-toggle="collapse" href="#detalles" role="button" aria-expanded="false" aria-controls="#detalles">Detalles del vuelo y equipaje <i class="fa fa-arrow-circle-down"></i></a>
            <a href="{{ URL::to('/online/cliente/MiPerfil', Auth::guard('online')->user()->id) }}" class="btn btn-md btn-primary btncosto " style="margin-left: 30px;" class="thbtn">Aceptar</a>
          </div>

       @endif

        {!! Form::close() !!}


        <div class="collapse" id="detalles">
          <table class="table table-sm">
            <thead>
              <tr class="table-detalles2">
                <th scope="col" class="pthsalida">N°Vuelo: {{ $datos_vuelos->codvuelos }}</th>
                <th scope="col" class="pthsalida">Pasajero: {{ $datos_vuelos->pasajero }}</th>
                <th scope="col" class="pthsalida">Tiempo Estimado de Vuelo: {{ $hora->format('H') }}h {{ $hora->format('i') }}min</th>
                <th scope="col" class="pthsalida">ATR-72</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row" colspan="2" class="pthsalida">Desde {{ $datos_vuelos->aeropuerto_origen }}</th>
                <td class="pthsalida">Hasta {{ $datos_vuelos->aeropuerto_destino }}</td>
                
              </tr>
              <tr class="table-detalles2">
                <th scope="row" class="pthsalida">Cargos de equipaje</th>
                <td class="pthsalida">23kgs de equipaje</td>
                <td class="pthsalida">1 equipaje de mano</td>
                <td class="pthsalida">Clase Económica</td>
              </tr>
            </tbody>
          </table>
        </div> <!--FIN VER MAS-->
     </div><!--col-sm-10-->

    
   </div><!--row sm-4-->

</div>
</div>
<!--hasta aquí el detalles-->             
      
      <br> <br>
</div>
</div>
</div>
{{-- <br> <br> --}}<br> <br>
<!-- ========================
AKI EL CIERRE DEL COÑOOOO NO INVENTAR
===================================== -->

@endsection
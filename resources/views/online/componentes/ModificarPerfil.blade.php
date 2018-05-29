@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')

	
	 <!--==========================
    Intro Section
  ============================-->



    <!--==========================
     DESDEEEEE AKIIIII COÑOOOOO Con todo y comentario
    ============================-->
{!! Form::open([ 'route' => 'online.cliente.ActualizarPerfil', 'method' => 'post','files' => 'true' ]) !!}
 {{-- <form method="post" action="{{ URL::to('/online/cliente/inicio') }}" files = 'true'>  --}}

  {{ csrf_field() }}

<br>
    <div class=" col-md-12 col-lg-12">
<div class="card border-primary border-bottom-0 mb-3">
  <div class="card-header" id="grad1" id="joder" >
     <div class="py-2 text-center box wow flipInX" data-wow-duration="0.8s">
      <img class=" mx-auto img-fluid" src="{{ asset('online/img/logo.png') }}" width="150px" height="100px">
        <h2>Edite su perfil</h2>
        <cite class="lead">Viaje con nosotos y llenase de experiencias y diverción.</cite>
        
        
     </div>
    
  </div>

  <div class="card-body"> <!-- ==EL BOOOODYYYY DEL CARD==-->
    <br>
     
     <div class="row">
     

       <div class="col-md-5 order-md-2 mb-4 box wow bounceInUp" data-wow-duration="3.4s">
                           <div class="container kieto">
                           <h4 class="d-flex justify-content-between align-items-center mb-3">
                             <!-- <span class="text-muted">Precio: </span> -->
                             <span class="badge badge-primary badge-pill">Cliente</span>
                           </h4>
                          
                          @if(isset(Auth::guard('online')->user()->avatar))
                          
                          <img src="/online/img/avatar/{{ Auth::guard('online')->user()->avatar }}" class="img-responsive" style="width:200px" value = "{{ Auth::guard('online')->user()->avatar }}" placeholder="{{ Auth::guard('online')->user()->avatar }}">

                          @else
                          
                          <img src="{{ asset('online/img/login/login.png') }}" class="img-responsive">

                          @endif

                          {{--  <img src="{{ asset('online/img/login/login.png') }}" class="img-responsive"> --}}
                 
                             <div class="form-group mt-4">
                                   <div class="col-md-4">
                                   <input type="file" name="avatar" id="photo" class="input-file">
                                 </div>
                               </div>
                          </div>
                         </div>  
  


        <div class="col-md-7 order-md-1">
             <!--  <h3 class="mb-4 ml-5">Formulario De Perfil</h3> JODAAAA Cliente -->


 <div class="container pasajero box wow fadeInLeft" data-wow-duration="1.4s">
         <h4 class="mb-3">Formulario De Perfil </h4>

  <input type="hidden" name = "user_id" value="{{ Auth::guard('online')->user()->id }}">
  
  <div class="form-group row">  
    <label for="inputusername" class="col-sm-2 col-form-label">Nombre de usuario</label>
    <div class="col-sm-10">
      <input type="text" class="form-control impoutperfil" name="username" id="inputusername" value="{{ Auth::guard('online')->user()->name }}">
    <i class="fa fa-envelope-o icoconsul"></i>
    </div>    
    <div class="invalid-feedback">
                  Valide su Correo es necesario.
    </div>
    
  </div>

  <div class="form-group row">  
    <label for="inputcorreo" class="col-sm-2 col-form-label">Correo</label>
    <div class="col-sm-10">
      <input type="email" class="form-control impoutperfil" name="email" id="inputcorreo" value="{{ Auth::guard('online')->user()->email }}">
    <i class="fa fa-envelope-o icoconsul"></i>
    </div>    
    <div class="invalid-feedback">
                  Valide su Correo es necesario.
    </div>
    
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-3 col-form-label">Contraseña</label>
    <div class="col-sm-9">
      <input type="password" class="form-control impoutperfil2" name="password" id="inputPassword3" value="{{ Auth::guard('online')->user()->password }}">
      <i class="icon ion-lock-combination iconcontra"></i>
    </div>    
  </div>

  <div class="form-group row">
    <label for="inputnombre" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      @if(isset($cliente))
      <input type="text" class="form-control impoutperfil" name="nombre" id="inputnombre" value="{{ $cliente->nombre }}" placeholder="nombre">
      @else
      <input type="text" class="form-control impoutperfil" name="nombre" id="inputnombre" value="" placeholder="nombre">
      @endif
      <i class="icon ion-person icouserper"></i>
    </div>
     <div class="invalid-feedback">
                  Valide su nombre es necesario.
    </div>
  </div>

  <div class="form-group row">
    <label for="inputapellido" class="col-sm-2 col-form-label">Apellido</label>
    <div class="col-sm-10">
    @if(isset($cliente))
      <input type="text" class="form-control impoutperfil" name="apellido" id="inputapellido" value="{{ $cliente->apellido }}" placeholder="apellido">
    @else
      <input type="text" class="form-control impoutperfil" name="apellido" id="inputapellido" value="" placeholder="apellido">
    @endif
      <i class="icon ion-person icouserper"></i>
    </div>
    <div class="invalid-feedback">
                  Valide su apellido es necesario.
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-3 col-form-label">Documentacion</label>
     <div class="form-inline col-sm-9">
            <select class="form-control" name="tipo_documento" style="width:25%">
          <option value="Venezolano/a">V</option>
          <option value="Extenjero">P</option>
          </select>
              <span style="width:6%; text-align: center">-</span>
          
          @if(isset($cliente))
            <input type="text" class="form-control" style="width:65%" name="documento" id="documento" value= "{{ $cliente->documento }}" placeholder="documento" minlength="5" maxlength="8" required="">
          @else
            <input type="text" class="form-control" style="width:65%" name="documento" id="documento" value= "" minlength="5" maxlength="8" placeholder="documento" required="">
          @endif

                <div class="invalid-feedback" >
                  Es necesario.
                </div>
          </div>
    <div class="invalid-feedback">
                  Valide su Documentacion es necesario.
    </div>
  </div>

  <div class="form-group row">
    <label for="inputcodigopostal" class="col-sm-3 col-form-label">Codigo Postal</label>
    <div class="col-sm-9">
      
    @if(isset($cliente))  

      <input type="text" class="form-control impoutperfil" name="codigo_postal" id="inputcodigopostal" value= "{{ $cliente->codigo_postal }}" placeholder="codigo postal">

    @else
      
      <input type="text" class="form-control impoutperfil" name="codigo_postal" id="inputcodigopostal" value= "" placeholder="codigo postal">
  
    @endif

      <i class="icon ion-ios-barcode-outline icouserper"></i>
    </div>
    <div class="invalid-feedback">
                  Valide su Codigo Postal es necesario.
    </div>
  </div>

  <div class="form-group row">
    <label for="inputdireccion" class="col-sm-2 col-form-label">Direccion</label>
    <div class="col-sm-10">
    
    @if(isset($cliente))

      <input type="text" class="form-control impoutperfil" name="direccion" id="inputdireccion" value= "{{ $cliente->direccion }}" placeholder="direccion">

    @else
      
      <input type="text" class="form-control impoutperfil" name="direccion" id="inputdireccion" value= "" placeholder="direccion">

    @endif
    <i class="fa fa-street-view icodirec"></i>
    </div>
    <div class="invalid-feedback">
                  Valide su Direccion es necesario.
    </div>
  </div>


  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Fecha nacimiento</label>
    <div class="col-sm-10">
    
    @if(isset($cliente))

      <input type="date" name="fecha_nacimiento" class="form-control impoutperfil" id="inputPassword3" value= "{{ $cliente->fecha_nacimiento }}">
      
    @else
      
      <input type="date" name="fecha_nacimiento" class="form-control impoutperfil" id="inputPassword3" value="" required>  
      
    @endif

              <i class="fa fa-birthday-cake prefix icocalendario4"></i>
    </div>
    <div class="invalid-feedback">
                  Valide su Nacimiento es necesario.
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Sexo</label>
    <div class="col-sm-8">
     <select name="genero" class="form-control">
                  <option value="masculino">M</option>
                  <option value="femenino">F</option>
                </select>
    </div>    
  </div>

  <div class="form-group row">
    <label for="inputcelular" class="col-sm-2 col-form-label">Tlf Celular</label>
    <div class="col-sm-10">
    
    @if(isset($cliente))      
        <input type="text" name="telefono_movil" class="form-control impoutperfil2" id="inputcelular" value= "{{ $cliente->telefono_movil }}" placeholder="Tlf Celular">
    @else
        <input type="text" name="telefono_movil" class="form-control impoutperfil2" id="inputcelular" value= "" placeholder="Tlf Celular">
    @endif

     <i class="fa fa-mobile fa-1x icocatlf2" ></i>
    </div>     
    <div class="invalid-feedback ">
                  Valide su Tlf Celular es necesario.
    </div>
  </div>

<div class="form-group row">
    <label for="inputtlffijo" class="col-sm-2 col-form-label">Tlf de casa</label>
    <div class="col-sm-10">

     @if(isset($cliente)) 
     
      <input type="text" class="form-control impoutperfil2" name="telefono_fijo" id="inputtlffijo" value= "{{ $cliente->telefono_fijo }}" placeholder="Tlf de casa">
    
     @else
      
      <input type="text" class="form-control impoutperfil2" name="telefono_fijo" id="inputtlffijo" value= "" placeholder="Tlf de casa">

     @endif

       <i class="fa fa-phone icocatlf"></i>
      </div>
    
    <div class="invalid-feedback">
                  Valide su Tlf de casa es necesario.
    </div>
  </div>


  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Pais</label>
    <div class="col-sm-10">
      <select data-placeholder="Ciudad-Aeropuerto" name="pais" class="chosen-select impoutperfil2" class="form-control impout3" tabindex="2" required>
              
              @if(isset($cliente))

                <option value="{{ $cliente->pais }}">{{ $cliente->pais }}</option>
                
              @else
                
                <option required>Pais</option>  
                
              @endif

              <option value="United States">United States</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="Afghanistan">Afghanistan</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antarctica">Antarctica</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Armenia">Armenia</option>
              <option value="Aruba">Aruba</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Azerbaijan">Azerbaijan</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belarus">Belarus</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
              <option value="Botswana">Botswana</option>
              <option value="Bouvet Island">Bouvet Island</option>
              <option value="Brazil">Brazil</option>
              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
              <option value="Brunei Darussalam">Brunei Darussalam</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Cote D'ivoire">Cote D'ivoire</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Eritrea">Eritrea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="French Southern Territories">French Southern Territories</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Georgia">Georgia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Guadeloupe">Guadeloupe</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea-bissau">Guinea-bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
              <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jordan">Jordan</option>
              <option value="Kazakhstan">Kazakhstan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kiribati">Kiribati</option>
              <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
              <option value="Korea, Republic of">Korea, Republic of</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Kyrgyzstan">Kyrgyzstan</option>
              <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
              <option value="Liechtenstein">Liechtenstein</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macao">Macao</option>
              <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
              <option value="Moldova, Republic of">Moldova, Republic of</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montenegro">Montenegro</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="Netherlands Antilles">Netherlands Antilles</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Pitcairn">Pitcairn</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russian Federation">Russian Federation</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Helena">Saint Helena</option>
              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
              <option value="Saint Lucia">Saint Lucia</option>
              <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
              <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
              <option value="Samoa">Samoa</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Serbia">Serbia</option>
              <option value="Seychelles">Seychelles</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
              <option value="South Sudan">South Sudan</option>
              <option value="Spain">Spain</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syrian Arab Republic">Syrian Arab Republic</option>
              <option value="Taiwan, Republic of China">Taiwan, Republic of China</option>
              <option value="Tajikistan">Tajikistan</option>
              <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
              <option value="Thailand">Thailand</option>
              <option value="Timor-leste">Timor-leste</option>
              <option value="Togo">Togo</option>
              <option value="Tokelau">Tokelau</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turkmenistan">Turkmenistan</option>
              <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States">United States</option>
              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Uzbekistan">Uzbekistan</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Viet Nam">Viet Nam</option>
              <option value="Virgin Islands, British">Virgin Islands, British</option>
              <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
              <option value="Wallis and Futuna">Wallis and Futuna</option>
              <option value="Western Sahara">Western Sahara</option>
              <option value="Yemen">Yemen</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>
            </select>




            <i class="fa fa-map-marker prefix icopais"></i> 
                </div> 
                
                <div class="invalid-feedback">
                  por favor valide su seleccion.
                </div>
  </div>


 
 </div>
<!-- FIN JODAAAA cliente-->
            
            <hr class="mb-4">           
            
                   

              <button class="btn btn-primary btn-lg " 
               type="submit">Guardar Datos</button>

    </div>     

    <!-- -->

 </div>
          <br> <br>


  </div>
</div>
</div>

  
{{-- </form> --}}
{!! Form::close() !!}

<!-- ========================
AKI EL CIERRE DEL COÑOOOO NO INVENTAR
===================================== -->


@endsection
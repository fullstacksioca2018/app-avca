@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')
<!--==========================
   AKI EL INICIO DEL LOGEOOOOOOO
  ============================-->

 <div class="container pt-5">
           
            <section>       
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->

                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/online/login') }}">
                        {{ csrf_field() }} 
                                <h1>Iniciar sesión</h1> 
                                <p> 
                                    <label for="username" class="uname" > <strong> Tu correo electrónico o nombre de usuario </strong></label>

                                    <input id="username" name="email" value="{{ old('email') }}" required="required" type="text" placeholder=""/>
                                   
                                 
                                </p>
                                  

                                 
                                <p> 
                                    <label for="password" class="youpasswd"> <strong> Tu contraseña </strong></label>
                                    <input id="password" name="password" required="required" type="password" placeholder="" /> 
                                </p>

                               
                               
                                <p class="keeplogin"> 
                  <input type="checkbox" name="remember">   
                  <label for="loginkeeping">Recuérdame</label>
                   
                </p>
                
                <p class="signin button">                   
                  <input type="submit" value="facebook"/> 
                   <input type="submit" value="Iniciar"/>
                </p>  

                </p>
                                <p class="change_link">
                  <strong>No eres miembro todavía ?</strong>
                  <a href="#toregister" class="to_register">únete a nosotros</a>
                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                             <form class="form-horizontal" role="form" method="POST" action="{{ url('/online/register') }}">
                                  {{ csrf_field() }} 

                                <h1> Registrarse </h1> 
                                
                                <p> 
                                    <label for="name" class="uname" ><strong> Su nombre de usuario </strong></label>
                                    <input id="name" name="name" value="{{ old('name') }}" required="" type="text" placeholder="" />
                                </p>

                                
                                <p> 
                                    <label for="email" class="youmail"  > <strong> Tu correo electrónico </strong></label>
                                    <input id="email"
                                          name="email" value="{{ old('email') }}" required="" type="email" placeholder=""/> 
                                </p>

                              
                                <p> 
                                    <label for="password"  class="youpasswd" > <strong> Tu contraseña </strong></label>
                                    <input id="password"
                                           name="password" required="required" type="password" placeholder=""/>
                                </p>

                               
                                <p> 
                                    <label for="password-confirm" class="youpasswd" > <strong>Por favor, confirme su contraseña </strong> </label>
                                    <input id="password-confirm" 
name="password_confirmation" required="required" type="password" placeholder=""/>
                                </p>
                                   <p class="signin button"> 
                  <input type="submit" value="facebook"/> 
                  <input type="submit" value="Registrarse"/> 
                </p>

                  <p class="change_link"> <strong> 
                  Ya eres usuario ?</strong>
                  <a href="#tologin" class="to_register"> inicia tu sesión </a>
                </p>
                            </form>
                        </div>
            
                    </div>
                </div>  
            </section>
        </div>




   


  <!--==========================
   AKI EL FIN DEL INICIO DEL LOGEOOOOOOO
  ============================-->
@endsection
@section('style')
  <link href="{{ asset('online/css/login.css') }}" rel="stylesheet">
@endsection

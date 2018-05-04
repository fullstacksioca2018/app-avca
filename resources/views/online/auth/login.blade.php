@extends('online.template.main2')
@section('title','Detalle Vuelo')

@section('content')
<!--==========================
   AKI EL INICIO DEL LOGEOOOOOOO
  ============================-->

 <div class="container">
           
            <header>
                <h1>Formulario de registro y registro</h1>
        
            </header>
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
                                    <label for="username" class="uname" > Tu correo electrónico o nombre de usuario </label>
                                    <input id="username" name="email" value="{{ old('email') }}" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd"> Tu contraseña </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin"> 
                  <input type="checkbox" name="remember">   
                  <label for="loginkeeping">Recuérdame</label>
                </p>
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                </p>
                                <p class="change_link">
                  No eres miembro todavía ?
                  <a href="#toregister" class="to_register">únete a nosotros</a>
                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                             <form class="form-horizontal" role="form" method="POST" action="{{ url('/online/register') }}">
                                                                {{ csrf_field() }} 

                                <h1> Registrase </h1> 
                                <p> 
                                    <label for="name" class="uname" >Su nombre de usuario</label>
                                    <input id="name" name="name" value="{{ old('name') }}" required="" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="email" class="youmail"  > Tu correo electrónico</label>
                                    <input id="email"
                                          name="email" value="{{ old('email') }}" required="" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="password"  class="youpasswd" >Tu contraseña </label>
                                    <input id="password"
                                           name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="password-confirm" class="youpasswd" >Por favor, confirme su contraseña </label>
                                    <input id="password-confirm" 
name="password_confirmation" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button"> 
                   <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                </p>
                                <p class="change_link">  
                  Ya eres usuario ?
                  <a href="#tologin" class="to_register"> Ir e iniciar sesión </a>
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

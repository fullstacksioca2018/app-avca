<?php

namespace App\Http\Controllers\Online;
use DB;

use Auth;
use DateTime;
use stdClass;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Models\online\Ruta;
use App\Models\online\User;
use App\Models\online\Vuelo;
use Illuminate\Http\Request;
use App\Models\online\Boleto;
use App\Models\online\Factura;
use App\Models\online\Tarjeta;
use App\Mail\online\CompraBoleto;
use App\Models\operativo\Sucursal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    public function indexHome(){
        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('online.componentes.inicio', compact('sucursales'));
    }
    public function index1()
    {
        if(Auth::guard('online')->user())
                return redirect('online/home');
        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('online.componentes.inicio', compact('sucursales'));
    
    }

    public function index2()
    {

        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('online.componentes.retorno', compact('sucursales'));
    
    }

    public function index3()
    {

        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();
        return view('online.componentes.multidestino', compact('sucursales'));
    
    }

    public function DetalleVuelo(Request $request)
    {
        $date = new DateTime($request->get('fecha_salida'));
        $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);

        $c1= $request->get('ninos');
        $c2= $request->get('adultos');
        $c3= $request->get('ninosbrazos');

        $vuelos= array();
        $vueloAux;
        $segmentos;
        $origen;
        $destino;
        $cantidad_personas= $c1 + $c2;
        foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad_personas;
            $objAUX->ninosbrazos=$c3;
            array_push($vuelos, $objAUX);
        }

        if(count($vuelos)){
                return view('online.componentes.DetalleVuelo')->with('vuelos',$vuelos);
        }else{

                 flash("Lo sentimos el vuelo que ha seleccionado no esta a disposición")->error()->important();
                 //return redirect()->route('cliente.index1');
                  return redirect()->back();
        }

    }

    

    public function equipaje()
    {
        
        return view('online.componentes.equipaje');

    }

    public function documentacion()
    {
        
        return view('online.componentes.documentacion');

    }

    public function CompraBoleto($cantidad,$ninosbrazos,$tarifa_vuelo)
    {
        $pasajeros=Auth::guard('online')->user()->pasajeros(Auth::guard('online')->user()->id);
        $pasajerosN=Auth::guard('online')->user()->pasajerosN(Auth::guard('online')->user()->id);
        return view('online.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','pasajeros','pasajerosN'));

    }

    public function CompraBoleto2($cantidad,$ninosbrazos,$tarifa_vuelo,$vuelo)
    {
        $pasajeros=Auth::guard('online')->user()->pasajeros(Auth::guard('online')->user()->id);
        $pasajerosN=Auth::guard('online')->user()->pasajerosN(Auth::guard('online')->user()->id);
        return view('online.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','vuelo','pasajeros','pasajerosN'));

    }

    public function BoletoVendido(Request $request)
    {
        
         //para resumen
         $boletos = array();
         $datos_vuelos = array();   
         $rutas = array();

         // SAVE DATOS DE TARJETA
         $tarjeta = new Tarjeta($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
         $tarjeta->save();

         // // SAVE DATOS DE FACTURAS

         $factura = new Factura();
         $factura->numero_factura = 'FA-'.random_int(10000, 99999);
         $factura->fecha = Carbon::now();
         $factura->importe_facturado = $request->importe_facturado;
         $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
         $factura->adultos_cant = $request->adulto;
         $factura->ninos_cant = $request->nino;
         $factura->NinosBrazos_cant = $request->brazo;
         $factura->tarjeta_id = $tarjeta->id;
         $factura->save();
         
         // SAVE DATOS DE BOLETOS
         // dd(count($request->primerNombre));
        $user = Auth::guard('online')->user();
        $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
       // dd($request->all());
        

        if(isset($request->vuelos)){ //multidestino
            for($i = 0; $i < count($request->vuelos); $i++){
                $cant=($request->adulto+$request->nino);
           
            $key=0;
            //inicia for adultos
             for($key = 0; $key <$cant-$request->brazo; $key++){ //adultos
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelp[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelp[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                   
                    array_push($boletos, $Nboleto);            
                }//termina for adultos
                //fin ninos
                for($key; $key <$cant; $key++){ //niños
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelpN[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);            
                }//fin for niños
                $vueloAux = Vuelo::find($request->vuelos[$i]);
                $segmentos=$vueloAux->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$vueloAux;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                array_push($datos_vuelos, $objAUX);
            }
        }
        else{ //un solo destino
            for($key = 0; $key < count($request->primerNombre); $key++){
                $Nboleto = new Boleto();
                $Nboleto->boleto_estado="Pagado";
                $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                if($request->tipo_boleto[$key]=="adulto")
                    $Nboleto->asiento=$request->asiento[$key];
                else{
                    $Nboleto->asiento="null";
                }
                $Nboleto->primerNombre=$request->primerNombre[$key];
                $Nboleto->segundoNombre = $request->segundoNombre[$key];
                $Nboleto->tipo_documento=$request->tipo_documento[$key];
                $Nboleto->documento=$request->documento[$key];
                $Nboleto->genero=$request->genero[$key]; 
                $Nboleto->apellido=$request->apellido[$key]; 
                $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                if($request->tipo_boleto[$key]=="bebe en brazos")
                    $Nboleto->detalles_salud="null";
                else{
                    $Nboleto->detalles_salud=$request->detalles_salud[$key];
                }

                $Nboleto->user_id=$user->id;
                $Nboleto->factura_id=$factura->id;
                $Nboleto->vuelo_id=$request->vuelo;
                $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                $Nboleto->save();
                array_push($boletos, $Nboleto);    
                

            }
            $AuxVuelo = Vuelo::find($request->vuelo);
            $segmentos=$AuxVuelo->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$AuxVuelo;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            array_push($datos_vuelos, $objAUX);
        }

        // ENVIO DE EMAIL
        //Mail::to(Auth::guard('online')->user()->email)->send(new CompraBoleto($boletos, Auth::guard('online')->user(), $datos_vuelos, $factura));

        flash("Su compra de boleto ha sido realizada exitosamente esperemos que disfrute de nuestro servicio")->success()->important();
        return view('online.componentes.BoletoVendido')->with('datos_vuelos',$datos_vuelos)->with('boletos',$boletos)->with('factura', $factura);  

    }


    public function BoletoVendido2(Request $request)
    {

       // $ddd=Boleto::where('documento','=',$request->pasajeroHelp[0])->limit(1)->get();
        //dd("estoy en boletovendido2",$ddd[0]->primerNombre);
        //$id='pasajeroHelp1';
        $boletos = array();
        $datos_vuelos = array();
        $rutas = array();

         // SAVE DATOS DE TARJETA

         $tarjeta = new Tarjeta($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
         $tarjeta->save();

         // // SAVE DATOS DE FACTURAS
        if(!isset($request->vuelta)){
             $factura = new Factura();
             $factura->numero_factura = 'FA-'.random_int(10000, 99999);
             $factura->fecha = Carbon::now();
             $factura->importe_facturado = $request->importe_facturado;
             $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
             $factura->adultos_cant = $request->adulto;
             $factura->ninos_cant = $request->nino;
             $factura->NinosBrazos_cant = $request->brazo;
             $factura->tarjeta_id = $tarjeta->id;
             $factura->save();
             
             // SAVE DATOS DE BOLETOS
             // dd(count($request->primerNombre));
            $user = Auth::guard('online')->user();
           // $user = Auth::user();
            $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
           // dd($request->all());
            $cant=($request->aulto+$request->ninos);
            $key=0;
             
             for($key = 0; $key <$cant-$request->brazo; $key++){ //adultos
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelp[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelp[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$request->vuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);            
                }
                for($key; $key <$cant; $key++){ //adultos
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelpN[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$request->vuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);            
                }      
                $AuxVuelo = Vuelo::find($request->vuelos[$i]);
                $segmentos=$vueloAux->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                array_push($datos_vuelos, $objAUX);

        }//fin if ! vuelta
        
        else{
            $factura = new Factura($request->all());
             $factura->numero_factura = 'FA-'.random_int(10000, 99999);
             $factura->fecha = Carbon::now();
             $factura->importe_facturado = $request->importe_facturado;
             $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
             $factura->adultos_cant = $request->adulto;
             $factura->ninos_cant = $request->nino;
             $factura->NinosBrazos_cant = $request->brazo;
             $factura->tarjeta_id = $tarjeta->id;
             $factura->save();

             $vuelos= array();

             array_push($vuelos, $request->vuelo);
             array_push($vuelos, $request->vuelta);

             
            $user = Auth::guard('online')->user();
            // $user = Auth::user();
             $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
             foreach ($vuelos as $idvuelo) {
                 
                $cant=($request->adulto+$request->nino);
           
            $key=0;
            //inicia for adultos
             for($key = 0; $key <$cant-$request->brazo; $key++){ //adultos
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelp[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelp[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                   
                    array_push($boletos, $Nboleto);            
                }//termina for adultos
                //fin ninos
                for($key; $key <$cant; $key++){ //niños
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Pagado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   
                    if($request->pasajeroHelpN[$key]==0){
                        $Nboleto->primerNombre=$request->primerNombre[$key];
                        $Nboleto->segundoNombre = $request->segundoNombre[$key];
                        $Nboleto->tipo_documento = $request->tipo_documento[$key];
                        $Nboleto->documento=$request->documento[$key];
                        $Nboleto->genero=$request->genero[$key]; 
                        $Nboleto->apellido=$request->apellido[$key]; 
                        $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                        $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                    }
                    else{
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key])->limit(1)->get();
                        $Nboleto->primerNombre=$Nboleto2[0]->primerNombre;
                        $Nboleto->segundoNombre = $Nboleto2[0]->segundoNombre;
                        $Nboleto->tipo_documento = $Nboleto2[0]->tipo_documento;
                        $Nboleto->documento=$Nboleto2[0]->documento;
                        $Nboleto->genero=$Nboleto2[0]->genero; 
                        $Nboleto->apellido=$Nboleto2[0]->apellido; 
                        $Nboleto->tipo_boleto=$Nboleto2[0]->tipo_boleto;
                        $Nboleto->fecha_nacimiento=$Nboleto2[0]->fecha_nacimiento;

                    }
                    $Nboleto->user_id=$user->id;
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);            
                }//fin for niños

                $AuxVuelo = Vuelo::find($idvuelo);
                $segmentos=$AuxVuelo->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                array_push($datos_vuelos, $objAUX);
             }
           // dd($request->all());

        }

        //Mail::to(Auth::guard('online')->user()->email)->send(new CompraBoleto($boletos, Auth::guard('online')->user(), $datos_vuelos, $factura));

        flash("Su compra de boleto ha sido realizada exitosamente esperemos que disfrute de nuestro servicio")->success()->important();
        return view('online.componentes.BoletoVendido')->with('datos_vuelos',$datos_vuelos)->with('boletos',$boletos)->with('factura', $factura)->with('rutas',$rutas);  

    }

    public function DetalleRetorno2($cantidad,$ninosbrazos,$tarifa_vuelo,$vuelo,$retorno){
        $vuelo=Vuelo::find($vuelo);

        $segmentos=$vuelo->segmentos;
        if(count($segmentos)==1){
            $ruta=$segmentos[0]->ruta;
            $origen=$segmentos[0]->ruta->origen;
            $destino=$segmentos[0]->ruta->destino;
        }else{
            foreach ($segmentos as $segmento) {
               dd("varios segmentos");
            }
        }

        $anterior= new stdClass();
        $anterior->vuelo=$vuelo;
        $anterior->ruta=$ruta;
        $anterior->origen=$origen;
        $anterior->destino=$destino;

        $date = new DateTime($retorno);
        $rutas = Ruta::Rutas($destino->sucursal_id,$origen->sucursal_id,$date);
        $vuelos= array();
         foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad;
            $objAUX->ninosbrazos=$ninosbrazos;
            array_push($vuelos, $objAUX);
        }
        // dd($vuelos);

        if(count($vuelos)){
                return view('online.componentes.DetalleRetorno')->with('vuelos',$vuelos)->with('ida',$anterior);
        }else{

                return redirect()->route('cliente.index1');
        }
    }

    public function DetalleRetorno(Request $request)
    {
         //dd($request->all());
        $date = new DateTime($request->get('fecha_salida'));
        $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);

        $c1= $request->get('ninos');
        $c2= $request->get('adultos');
        $c3= $request->get('ninosbrazos');

        $vuelos= array();
        $vueloAux;
        $segmentos;
        $origen;
        $destino;
        $cantidad_personas= $c1 + $c2;
        foreach ($rutas as $vueloID) {
            $vueloAux=Vuelo::find($vueloID->id);
            $segmentos=$vueloAux->segmentos;
            if(count($segmentos)==1){
                $ruta=$segmentos[0]->ruta;
                $origen=$segmentos[0]->ruta->origen;
                $destino=$segmentos[0]->ruta->destino;
            }else{
                foreach ($segmentos as $segmento) {
                   dd("varios segmentos");
                }
            }
            $objAUX= new stdClass();
            $objAUX->vuelo=$vueloAux;
            $objAUX->ruta=$ruta;
            $objAUX->origen=$origen;
            $objAUX->destino=$destino;
            $objAUX->cantidad=$cantidad_personas;
            $objAUX->ninosbrazos=$c3;
            array_push($vuelos, $objAUX);
        }

        if(count($vuelos)){
                return view('online.componentes.DetalleVuelo')->with('vuelos',$vuelos)->with('retorno',$request->get('fecha_retorno'));
        }else{

            flash("Lo sentimos el vuelo que ha seleccionado no esta a disposición")->error()->important();
            return redirect()->back();
                //return redirect()->route('cliente.index1');
        }
    }

    public function DetalleMultidestino(Request $request)
    {

        $vuelosMultiDestino=array();
        $objMultidestinos= new stdClass();
        $objMultidestinos->origenes=$request->origen_id;
        $objMultidestinos->destinos=$request->destino_id;
        $objMultidestinos->fechas=$request->fecha_salida;
        $objMultidestinos->ninos=$request->ninos;
        $objMultidestinos->adultos=$request->adultos;
        $objMultidestinos->ninosbrazos=$request->ninosbrazos;
        for($i=0;$i<$request->cantidadV;$i++){
            $date = new DateTime($objMultidestinos->fechas[$i]);
            $rutas = Ruta::Rutas($objMultidestinos->origenes[$i],$objMultidestinos->destinos[$i],$date);

            $c1= $objMultidestinos->ninos;
            $c2= $objMultidestinos->adultos;
            $c3= $objMultidestinos->ninosbrazos;

            $vuelos= array();
            $vueloAux;
            $segmentos;
            $origen;
            $destino;
            $cantidad_personas= $c1 + $c2;
            foreach ($rutas as $vueloID) {
                $vueloAux=Vuelo::find($vueloID->id);
                $segmentos=$vueloAux->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$vueloAux;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->cantidad=$cantidad_personas;
                $objAUX->ninosbrazos=$c3;
                $objAUX->ninos=$request->ninos;
                $objAUX->adultos=$request->adultos;
                array_push($vuelos, $objAUX);
            }
            array_push($vuelosMultiDestino, $vuelos);
        }
        // dd($vuelosMultiDestino);
        $paquetes=array();
        for($j=0;$j<count($vuelosMultiDestino[0]);$j++){
            for($k=0;$k<count($vuelosMultiDestino[1]);$k++){
                if($request->cantidadV>2){
                    for($w=0;$w<count($vuelosMultiDestino[2]);$w++){
                        if($request->cantidadV>3){
                            for($z=0;$z<count($vuelosMultiDestino[3]);$z++){
                                //push paquetes 4 vueles
                                $objAUX= array();
                                array_push($objAUX, $vuelosMultiDestino[0][$j]);
                                array_push($objAUX, $vuelosMultiDestino[1][$k]);
                                array_push($objAUX, $vuelosMultiDestino[2][$w]);
                                array_push($objAUX, $vuelosMultiDestino[3][$z]);
                                array_push($paquetes, $objAUX);
                            }
                        }
                        else{
                            //push paquetes 3 vuelos
                            $objAUX= array();
                            array_push($objAUX, $vuelosMultiDestino[0][$j]);
                            array_push($objAUX, $vuelosMultiDestino[1][$k]);
                            array_push($objAUX, $vuelosMultiDestino[2][$w]);
                            array_push($paquetes, $objAUX);
                        }
                    }
                }
                else{
                    //push paquetes 2 vuelos
                    $objAUX= array();
                    array_push($objAUX, $vuelosMultiDestino[0][$j]);
                    array_push($objAUX, $vuelosMultiDestino[1][$k]);
                    array_push($paquetes, $objAUX);
                }
            }
        }

        if(count($paquetes)){
                return view('online.componentes.DetallePaquete')->with('paquetes',$paquetes);
        }else{

            flash("Lo sentimos el vuelo que ha seleccionado no esta a disposición")->error()->important();
            return redirect()->back();

            //return redirect()->route('cliente.index1');
            // dd($request->all());
        }


    }

    public function DetalleMultidestino2(Request $request){
         // dd($request->all()); 

             $vuelos= array();
            $vueloAux;
            $segmentos;
            $origen;
            $destino;
            foreach ($request->vuelo as $vueloID) {
                $vueloAux=Vuelo::find($vueloID);
                $segmentos=$vueloAux->segmentos;
                if(count($segmentos)==1){
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                }else{
                    foreach ($segmentos as $segmento) {
                       dd("varios segmentos");
                    }
                }
                $objAUX= new stdClass();
                $objAUX->vuelo=$vueloAux;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                array_push($vuelos, $objAUX);
            }
            
// return view('online.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','objMultidestinos'));
        return view('online.componentes.CompraBoleto')->with('objMultidestinos',$vuelos)->with('cantidad',$request->cantidad)->with('ninosbrazos',$request->ninosbrazos)->with('adultos',$request->adultos);

        // $objMultidestinos= new stdClass();
        // $objMultidestinos->origenes=$request->origenes;
        // $objMultidestinos->destinos=$request->destinos;
        // $objMultidestinos->fechas=$request->fechas;
        // $objMultidestinos->ninos=$request->ninos;
        // $objMultidestinos->adultos=$request->adultos;
        // $objMultidestinos->ninosbrazos=$request->ninosbrazos;
        // $objMultidestinos->cantidad=$request->cantidad;
        // $cantidad=$request->cantidad;
        // $ninosbrazos=$request->ninosbrazos;
        // $objMultidestinos->seleccionados= array();
        // if(isset($request->seleccionados)){
        //     //agg todos los vuelos antes seleccionado
        //     for($i=0;$i<(count($request->seleccionados));$i++){
        //         $vuelo=Vuelo::find($request->seleccionados[$i]);
        //         $segmentos=$vuelo->segmentos;
        //         if(count($segmentos)==1){
        //             $ruta=$segmentos[0]->ruta;
        //             $origen=$segmentos[0]->ruta->origen;
        //             $destino=$segmentos[0]->ruta->destino;
        //         }else{
        //             foreach ($segmentos as $segmento) {
        //                dd("varios segmentos");
        //             }
        //         }

        //         $seleccion= new stdClass();
        //         $seleccion->vuelo=$vuelo;
        //         $seleccion->ruta=$ruta;
        //         $seleccion->origen=$origen;
        //         $seleccion->destino=$destino;

        //         array_push($objMultidestinos->seleccionados, $seleccion);
        //     }
        //     //agg el nuevo vuelo seleccionado
        //     $vuelo=Vuelo::find($request->vuelo);
        //     $segmentos=$vuelo->segmentos;
        //     if(count($segmentos)==1){
        //         $ruta=$segmentos[0]->ruta;
        //         $origen=$segmentos[0]->ruta->origen;
        //         $destino=$segmentos[0]->ruta->destino;
        //     }else{
        //         foreach ($segmentos as $segmento) {
        //            dd("varios segmentos");
        //         }
        //     }

        //     $anterior= new stdClass();
        //     $anterior->vuelo=$vuelo;
        //     $anterior->ruta=$ruta;
        //     $anterior->origen=$origen;
        //     $anterior->destino=$destino;

        //     array_push($objMultidestinos->seleccionados, $anterior);


        //     if((count($objMultidestinos->seleccionados))==(count($objMultidestinos->origenes))){
        //             return view('online.componentes.CompraBoleto',compact('cantidad','ninosbrazos','tarifa_vuelo','objMultidestinos'));
        //     }
        //     else{
        //         //busco los vuelos para la siguinte selección
        //         $date = new DateTime($objMultidestinos->fechas[(count($request->seleccionados)+1)]);
        //         $rutas = Ruta::Rutas($objMultidestinos->origenes[(count($request->seleccionados)+1)],$objMultidestinos->destinos[(count($request->seleccionados)+1)],$date);
        //         $vuelos= array();
        //          foreach ($rutas as $vueloID) {
        //             $vueloAux=Vuelo::find($vueloID->id);
        //             $segmentos=$vueloAux->segmentos;
        //             if(count($segmentos)==1){
        //                 $ruta=$segmentos[0]->ruta;
        //                 $origen=$segmentos[0]->ruta->origen;
        //                 $destino=$segmentos[0]->ruta->destino;
        //             }else{
        //                 foreach ($segmentos as $segmento) {
        //                    dd("varios segmentos");
        //                 }
        //             }
        //             $objAUX= new stdClass();
        //             $objAUX->vuelo=$vueloAux;
        //             $objAUX->ruta=$ruta;
        //             $objAUX->origen=$origen;
        //             $objAUX->destino=$destino;
        //             $objAUX->cantidad=$objMultidestinos->cantidad;
        //             $objAUX->ninosbrazos=$objMultidestinos->ninosbrazos;
        //             $objAUX->ninos=$request->ninos;
        //             $objAUX->adultos=$request->adultos;
        //             array_push($vuelos, $objAUX);
        //         }
        //         dd($vuelos);
        //         if(count($vuelos)){
        //                 return view('online.componentes.DetalleMultidestino')->with('vuelos',$vuelos)->with('objMultidestinos',$objMultidestinos);
        //         }else{

        //                 return redirect()->route('cliente.index1');
        //         } 
        //     }

        // }
        // else{
        //     $vuelo=Vuelo::find($request->vuelo);
        //     $segmentos=$vuelo->segmentos;
        //     if(count($segmentos)==1){
        //         $ruta=$segmentos[0]->ruta;
        //         $origen=$segmentos[0]->ruta->origen;
        //         $destino=$segmentos[0]->ruta->destino;
        //     }else{
        //         foreach ($segmentos as $segmento) {
        //            dd("varios segmentos");
        //         }
        //     }

        //     $anterior= new stdClass();
        //     $anterior->vuelo=$vuelo;
        //     $anterior->ruta=$ruta;
        //     $anterior->origen=$origen;
        //     $anterior->destino=$destino;

        //     $objMultidestinos->seleccionados= array();
        //     array_push($objMultidestinos->seleccionados, $anterior);

        //     $date = new DateTime($objMultidestinos->fechas[1]);
        //     $rutas = Ruta::Rutas($objMultidestinos->origenes[1],$objMultidestinos->destinos[1],$date);
        //     $vuelos= array();
        //      foreach ($rutas as $vueloID) {
        //         $vueloAux=Vuelo::find($vueloID->id);
        //         $segmentos=$vueloAux->segmentos;
        //         if(count($segmentos)==1){
        //             $ruta=$segmentos[0]->ruta;
        //             $origen=$segmentos[0]->ruta->origen;
        //             $destino=$segmentos[0]->ruta->destino;
        //         }else{
        //             foreach ($segmentos as $segmento) {
        //                dd("varios segmentos");
        //             }
        //         }
        //         $objAUX= new stdClass();
        //         $objAUX->vuelo=$vueloAux;
        //         $objAUX->ruta=$ruta;
        //         $objAUX->origen=$origen;
        //         $objAUX->destino=$destino;
        //         $objAUX->cantidad=$objMultidestinos->cantidad;
        //         $objAUX->ninosbrazos=$objMultidestinos->ninosbrazos;
        //         array_push($vuelos, $objAUX);
        //     }
        //     // dd($vuelos);

        //     if(count($vuelos)){
        //             return view('online.componentes.DetalleMultidestino')->with('vuelos',$vuelos)->with('objMultidestinos',$objMultidestinos);
        //     }else{

        //             return redirect()->route('cliente.index1');
        //     }
           
            
        // }
        // dd($request->all());

    }

    public function Checkin(Request $request)
    {

        $id = Boleto::Checkin($request->localizador)->first();
        

        
        //$boleto = Boleto::find($request->localizador);
        // $boleto->boleto_estado = "Chequeado";
        // $boleto->save();

        // return redirect()->route('cliente.index1');

         if($id==null){
            return redirect()->route('cliente.index1');
         }else{
            
            $boletos = Boleto::find($id->id);
            $cliente = Auth::guard('online')->user()->cliente($boletos->user_id);
                            
            $objAUX= new stdClass();
            $objAUX->codvuelos =$boletos->vuelo->n_vuelo;
            $objAUX->pasajero=$boletos->primerNombre." ".$boletos->apellido;
            $objAUX->nombre_pasajero=$boletos->primerNombre;
            $objAUX->documento=$boletos->documento;
            $objAUX->tipo_boleto=$boletos->tipo_boleto;
            $objAUX->genero=$boletos->genero;
            $objAUX->tipo_documento=$boletos->tipo_documento;
            $objAUX->fecha_nacimiento=$boletos->fecha_nacimiento;
            $objAUX->apellido_pasajero=$boletos->apellido;
            $objAUX->fecha_salida=$boletos->vuelo->fecha_salida;
            $objAUX->origen=$boletos->vuelo->segmentos[0]->ruta->origen->nombre;
            $objAUX->sigla_origen=$boletos->vuelo->segmentos[0]->ruta->origen->sigla;
            $objAUX->aeropuerto_origen=$boletos->vuelo->segmentos[0]->ruta->origen->aeropuerto; 
            $objAUX->destino=$boletos->vuelo->segmentos[0]->ruta->destino->nombre;
            $objAUX->sigla_destino=$boletos->vuelo->segmentos[0]->ruta->destino->sigla;
            $objAUX->aeropuerto_destino=$boletos->vuelo->segmentos[0]->ruta->destino->aeropuerto;
            $objAUX->duracion=$boletos->vuelo->segmentos[0]->ruta->duracion;
            $objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
            $objAUX->estatus=$boletos->boleto_estado;
            $objAUX->localizador=$boletos->localizador;

            return view('/online/componentes/checkin')->with('cliente',$cliente)->with('datos_vuelos',$objAUX);; 
         }
        
    }

    public function BoletoChequeado(Request $request)
    {
        
        

        $id = Boleto::Checkin($request->localizador)->first();
        $boleto = Boleto::find($id->id);
        $boleto->boleto_estado = "Chequeado";
        $boleto->asiento = $request->asiento;
        $boleto->save();

        flash("El boleto de ".$boleto->primerNombre." ".$boleto->apellido." ha sido chequeado exitosamente esperemos disfrute de su viaje y vuelva pronto")->success()->important();
        return redirect('/online/cliente/MiPerfil/'.$boleto->user_id);
        //return redirect()->route('cliente.index1');

    }

    public function ConsultarBoleto()
    {
        $boletos=Auth::guard('online')->user()->boletos(Auth::guard('online')->user()->id);

        $TodoBoletos=array();


        foreach ($boletos as $boletoaux) {
            $boleto=Boleto::find($boletoaux->id);
                        
            $objAUX= new stdClass();
            $objAUX->codvuelos =$boleto->vuelo->n_vuelo;
            $objAUX->pasajero=$boleto->primerNombre." ".$boleto->apellido;
            $objAUX->fecha_salida=$boleto->vuelo->fecha_salida;
            $objAUX->origen=$boleto->vuelo->segmentos[0]->ruta->origen->nombre;
            $objAUX->destino=$boleto->vuelo->segmentos[0]->ruta->destino->nombre;
            $objAUX->estatus=$boleto->boleto_estado;
            array_push($TodoBoletos, $objAUX);
        }
        $sucursales = Sucursal::orderBy('ciudad','ASC')->get();

          return view('online.componentes.MisBoletos')->with('boletos',$TodoBoletos)->with('sucursales',$sucursales);
    }

}
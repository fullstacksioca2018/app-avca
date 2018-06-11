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

class RerservarBoletoController extends Controller
{
    public function ReservarBoleto(Request $request)
    {
       // dd('reservaboleto',$request->all());
    	if(($request->tipo_vuelo == 'SoloIda') ||($request->tipo_vuelo == 'MultiDestino')){

    		//para resumen
         $boletos = array();
         $datos_vuelos = array();   
         $rutas = array();

         // SAVE DATOS DE FACTURAS
		$factura = new Factura();
		$factura->importe_facturado = $request->importe_facturado;
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
                        $Nboleto->boleto_estado="Reservado";
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
                    for($key=0; $key2 <$request->brazo; $key++){ //niños
                        $Nboleto = new Boleto();
                        $Nboleto->boleto_estado="Reservado";
                        $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                       
                        if($request->pasajeroHelpN[$key2]==0){
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
                            $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key2])->limit(1)->get();
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
                        $Nboleto->vuelo_id=$request->vuelos[$i];
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
           // dd('estoy en reservacontroller en el elfe que es solo ida y primernombreson: ',$request->primerNombre);
            $cantA=($request->adulto+$request->nino)-$request->brazo;
            $key=0;
            //inicia for adultos
             for($key = 0; $key <$cantA; $key++){ //adultos
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Reservado";
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
                }//termina for adultos
                //fin ninos
                for($key2=0; $key2 <$request->brazo; $key2++){ //niños
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Reservado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                   //dd($key);
                    if($request->pasajeroHelpN[$key2]==0){
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
                        $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key2])->limit(1)->get();
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
                    $key++;            
                }//fin for niños
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

        	
        flash("Su reserva de boleto ha sido realizada exitosamente esperemos que disfrute de nuestro servicio")->success()->important();
        return view('online.componentes.BoletoReservado')->with('datos_vuelos',$datos_vuelos)->with('boletos',$boletos)->with('factura', $factura)->with('rutas',$rutas);

    	}/*================= Fin de if reserva SiloIda y MultiDestino ========================*/

    	else{

    		//dd($request->all());

        $boletos = array();
        $datos_vuelos = array();
        $rutas = array();

        if(!isset($request->vuelta)){
             
             // SAVE DATOS DE FACTURAS
		$factura = new Factura();
		$factura->importe_facturado = $request->importe_facturado;
		$factura->save();

             // SAVE DATOS DE BOLETOS
             // dd(count($request->primerNombre));
            $user = Auth::guard('online')->user();
           // $user = Auth::user();
            $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
           // dd($request->all());
        
           $cant=($request->adulto+$request->nino);
           
           $key=0;
           //inicia for adultos
            for($key = 0; $key <$cant-$request->brazo; $key++){ //adultos
                   $Nboleto = new Boleto();
                   $Nboleto->boleto_estado="Reservado";
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
               }//termina for adultos
               //fin ninos
               for($key2=0; $key2 <$cant; $key++){ //niños
                   $Nboleto = new Boleto();
                   $Nboleto->boleto_estado="Reservado";
                   $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                  
                   if($request->pasajeroHelpN[$key2]==0){
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
                       $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key2])->limit(1)->get();
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
               }//fin for niños    
                $AuxVuelo = Vuelo::find($request->vuelo);
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

        }
        
        else{
         
        	// SAVE DATOS DE FACTURAS
		$factura = new Factura();
		$factura->importe_facturado = $request->importe_facturado;
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
                        $Nboleto->boleto_estado="Reservado";
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
                    for($key2=0; $key2 <$request->brazo; $key++){ //niños
                        $Nboleto = new Boleto();
                        $Nboleto->boleto_estado="Reservado";
                        $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                       
                        if($request->pasajeroHelpN[$key2]==0){
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
                            $Nboleto2=Boleto::where('documento','=',$request->pasajeroHelpN[$key2])->limit(1)->get();
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
                        $key++;            
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

        flash("Su reserva de boleto ha sido realizada exitosamente esperemos que disfrute de nuestro servicio")->success()->important();
        return view('online.componentes.BoletoReservado')->with('datos_vuelos',$datos_vuelos)->with('boletos',$boletos)->with('factura', $factura)->with('rutas',$rutas);
    	} /*======================== Fin de else IdayVulta ========================*/

    }

    public function PagarBoletoReservado(Request $request)
    {       


            $boleto=Boleto::find($request->boleto_id);
            $fecha_actual = Carbon::now();
            $fecha_creacion_boleto = Carbon::parse($boleto->created_at);
            $fecha_creacion_boleto->addDay();

            if($fecha_creacion_boleto->gte($fecha_actual)){
            $tarjeta = new Tarjeta($request->all());
            $tarjeta->titular = $request->usernam;
            $tarjeta->numero_tarjeta = $request->numero_tarjeta;
            $tarjeta->fecha_vencimiento = $request->fecha_vencimiento;
            $tarjeta->save();

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
            
            $boleto=Boleto::find($request->boleto_id);
            $boleto->boleto_estado = 'Pagado';
            $boleto->factura_id = $factura->id;
            $boleto->save();

            return redirect()->back();

            }    

            else{

                $boleto->boleto_estado = 'Cancelado';
                $boleto->save();
                 flash("Estimado cliente su boleto ha sido cancelado debido a que la fecha de la reserva caducado")->error()->important();
                return redirect()->back();
            }

    }
}

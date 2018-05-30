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
                for($key = 0; $key < count($request->primerNombre); $key++){
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Reservado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                    if($request->tipo_boleto[$key]=="adulto")
                        $Nboleto->asiento=$request->asiento[$key];
                    else{
                        $Nboleto->asiento="null";
                    }
                    $Nboleto->primerNombre=$request->primerNombre[$key];
                    $Nboleto->segundoNombre = $request->segundoNombre[$key];
                    $Nboleto->tipo_documento = $request->tipo_documento[$key];
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
                    $Nboleto->vuelo_id=$request->vuelos[$i];
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    
                    array_push($boletos, $Nboleto); 

                }
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
                $Nboleto->boleto_estado="Reservado";
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
                $Nboleto->vuelo_id=$request->vuelo;
                $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                $Nboleto->save();
                array_push($boletos, $Nboleto);    
     			
     			//dd($boletos);           

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
        
                for($key = 0; $key < count($request->primerNombre); $key++){
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Reservado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                    if($request->tipo_boleto[$key]=="adulto")
                        $Nboleto->asiento=$request->asiento[$key];
                    else{
                        $Nboleto->asiento="null";
                    }
                    $Nboleto->primerNombre=$request->primerNombre[$key];
                    $Nboleto->segundoNombre = $request->segundoNombre[$key];
                    $Nboleto->tipo_documento = $request->tipo_documento[$key];
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
                 
                for($key = 0; $key < count($request->primerNombre); $key++){
                    $Nboleto = new Boleto();
                    $Nboleto->boleto_estado="Reservado";
                    $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                    if($request->tipo_boleto[$key]=="adulto")
                        $Nboleto->asiento=$request->asiento[$key];
                    else{
                        $Nboleto->asiento="null";
                    }
                    $Nboleto->primerNombre=$request->primerNombre[$key];
                    $Nboleto->segundoNombre = $request->segundoNombre[$key];
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
                    $Nboleto->vuelo_id=$idvuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);    
                }
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
                return redirect()->back();
            }

    }
}

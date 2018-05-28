<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\online\Factura;
use App\Models\online\Tarjeta;
use App\Models\online\Boleto;
use App\Models\online\Cliente;
use stdClass;

class TaquillaController extends Controller
{
	public function __construct(){
		Carbon::setLocale('es');
		date_default_timezone_set('America/Caracas');
	}

    public function taquilla(){
    	$sucursales = Sucursal::orderBy('ciudad','ASC')->get();
		return view('Operativo.Taquilla.Taquilla',compact('sucursales'));
		
    }

    public function DetalleVuelo2(Request $datos){
         
        $origen = $datos->all();
    
        if($origen['origen']!=0){
            if($origen['destino']!=0)
            {
                $rutas = Ruta::Rutas($origen['origen'],$origen['destino'],$origen['fecha']);
            }//fin if destino #
            else{
                $rutas = Ruta::Rutas_origen($origen['origen'],$origen['fecha']);
            }        
        }//fin if orgen #
        else{
            if($origen['destino']!=0)
            {
                $rutas = Ruta::Rutas_destino($origen['destino'],$origen['fecha']);
               
            }//fin if destino #
            else{
                $rutas = Ruta::Rutas_fecha($origen['fecha']);
            }
        }
       if(count($rutas)){
            $vuelos= array();
            $vueloAux;
            $segmentos;
            $objAUX= new stdclass();
            
            foreach($rutas as $vuelo){
                $vueloAux=Vuelo::find($vuelo->id);
                $vuelosAux=new stdclass();
                $segmentos=$vueloAux->segmentos;
                $segmentosAux=array();
                foreach($segmentos as $seg){
                    if(!empty($seg))
                    {$segAUX= new stdclass();
                        $segAUX->ruta=$seg->ruta->id;
                       // $segAUX->
                        $segAUX->origen=Sucursal::find($seg->ruta->origen_id);
                        $segAUX->destino=Sucursal::find($seg->ruta->destino_id);
                        array_push($segmentosAux,$segAUX);}
                }//fin foreach segmentos
            $vuelosAux->id=$vuelo->id;
            $vuelosAux->tarifa=$vuelo->tarifa_vuelo;
            $vuelosAux->n_vuelo=$vueloAux->n_vuelo;
            $vuelosAux->segmentos=$segmentosAux;
            $vuelosAux->fecha=$vueloAux->fecha_salida;
            $vuelosAux->boletos=$vueloAux->n_boletos;
            $vuelosAux->boletos_vendidos=$vueloAux->boletos_vendidos;
            $vuelosAux->boletos_reservados=$vueloAux->boletos_reservados;
            $vuelosAux->estado=$vueloAux->estado;
          //  $vuelos
            array_push($vuelos,$vuelosAux);
            }//fin foreach de rutas
        
  
         echo json_encode($vuelos);
         return;
       
        }else{ //fin if vuelos encontrado.
            $vuelos="No hay Vuelos disponibles.";
            echo json_encode($vuelos);
            return;
        }
        
    }
    
    
    public function CompraBoleto(Request $request)
    {
        $tipo=$request->get('tipo');
        
        $adultos= $request->get('inputadultos'.$tipo);
        $ninos= $request->get('inputninos'.$tipo);
        $edades= array();
        $brazo=array();
        for ($i=0;$i<$ninos;$i++) {
            $edad=$request->get('edad'.$i);
            $Nbrazo=$request->get('brazo'.$i);
            array_push($edades,$edad);
            array_push($brazo,$Nbrazo);
        }
        switch ($tipo){
           case 1:// solo ida
                 $origen=$request->get('origen_id');
                 $destino=$request->get('destino_id');
                 $fecha=$request->get('fecha_salida');
                 $precio=$request->get('tarifasoloida');
                 $n_vuelo=$request->get('vuelo');
                 return view('Operativo.Taquilla.Compra.CompraBoleto')->with('vuelo',$n_vuelo)->with('tipo',$tipo)->with('origen',$origen)->with('destino',$destino)->with('fecha',$fecha)->with('tarifa',$precio)->with('adultos',$adultos)->with('ninos',$ninos)->with('edades',$edades)->with('brazo',$brazo);
                 break;
            case 2: //ida y vuelta
                $origen=$request->get('origen_id_retorno');
                $destino=$request->get('destino_id_retorno');
                $fecha=$request->get('fecha_salida2');
                $fecha_regreso=$request->get('fecha_regreso');
                $precio1=$request->get('tarifaida');
                $precio2=$request->get('tarifaregreso');
                $n_vuelo=$request->get('vuelo');
                $n_vueloR=$request->get('vuelo_regreso');
                return view('Operativo.Taquilla.Compra.CompraBoleto')->with('vuelo',$n_vuelo)->with('vuelo_regreso',$n_vueloR)->with('tipo',$tipo)->with('origen',$origen)->with('destino',$destino)->with('fecha',$fecha)->with('fecha_regreso',$fecha_regreso)->with('tarifa',$precio1)->with('tarifa_regreso',$precio2)->with('adultos',$adultos)->with('ninos',$ninos)->with('edades',$edades)->with('brazo',$brazo);
                break;
            case 3: //multidestino
            $cantidadV=$request->get('cantidadV');
                $origen=$request->origen_id;
                $destino=$request->destino_id;
                $fecha=$request->fecha_salida;
                $precios=$request->tarifamultidestino;
                $vuelos=$request->vuelo_;
                return view('Operativo.Taquilla.Compra.CompraBoleto')->with('vuelos',$vuelos)->with('tarifas_multidestino',$precios)->with('tipo',$tipo)->with('cantidadV',$cantidadV)->with('origen',$origen)->with('destino',$destino)->with('fecha',$fecha)->with('adultos',$adultos)->with('ninos',$ninos)->with('edades',$edades)->with('brazo',$brazo);
                break;
       }//fin switch
    }

    public function BoletoVendido(Request $request)
    {
        $tipo=$request->tipo;
        if(isset($request->reservar))
        {$btn="reserva";
        }else{ $btn="compra";}
        dd($btn);
        
        $datos_vuelos = array();   
         $rutas = array();
        if($btn!="reserva"){
         // SAVE DATOS DE bauche si fue una compra
         $tarjeta = new Tarjeta($request->all());
         $tarjeta->titular = $request->usernam;
         $tarjeta->numero_tarjeta = $request->numero_tarjeta;
         $tarjeta->fecha_vencimiento = $request->tipo_pago." - ".$request->tipo_tarjeta;
         $tarjeta->save();
        }
         // // SAVE DATOS DE FACTURAS

         $factura = new Factura();
         $factura->numero_factura = 'FA-'.random_int(10000, 99999);
         $factura->fecha = Carbon::now();
         $factura->importe_facturado = $request->importe_facturado;
         $factura->numero_control = 'N°'.'00-'.random_int(100000, 999999);
         $factura->adultos_cant = $request->adultos;
         $factura->ninos_cant = $request->ninos;
         $factura->NinosBrazos_cant = $request->NinosBrazos_cant;
         if($bt!="reserva")
         {
             $factura->tarjeta_id = $tarjeta->id;
         }else{
             $factura->tarjeta_id = 0; // 0 porque no tiene tarjeta asociada.
         }
         $factura->save();
         
         // SAVE DATOS DE BOLETOS
         
        /* $user = Auth::guard('online')->user(); */
       $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
        
       switch ($tipo) {
           case 1:
           $boletos = array();   
            for($key = 0; $key < ($request->adultos+$request->ninos); $key++)
                {
                    $Nboleto = new Boleto();
                    if($bt!="reserva")
                    {          
                    $Nboleto->boleto_estado="Pagado";
                    }else{
                        $Nboleto->boleto_estado="Reservado";
                    }
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
      //================ REVISAR ESTO ==============================              
                    $Nboleto->user_id="1";
    //==============================================================
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$request->vuelo;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);
                }// fin for
                $AuxVuelo = Vuelo::find($request->vuelo);
                $segmentos=$AuxVuelo->segmentos;
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->boletos=$boletos;
                array_push($datos_vuelos, $objAUX);
            break;
            case 2:
            $boletos = array();
            for($key = 0; $key < ($request->adultos+$request->ninos); $key++)
            {
                $Nboleto = new Boleto();
                if($bt!="reserva")
                {  
                    $Nboleto->boleto_estado="Pagado";
                }else{
                    $Nboleto->boleto_estado="Reservado";
                }
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
                $Nboleto->user_id="1";
                $Nboleto->factura_id=$factura->id;
                $Nboleto->vuelo_id=$request->vuelo;
                $Nboleto->localizador = str_random(3).'-'.random_int(100,999);

                $Nboleto->save();
                array_push($boletos, $Nboleto);
            }// fin for
            $boletos = array();
            for($key = 0; $key < ($request->adultos+$request->ninos); $key++)
                {
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
                    $Nboleto->user_id="1";
                    $Nboleto->factura_id=$factura->id;
                    $Nboleto->vuelo_id=$request->vuelo_regreso;
                    $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                    $Nboleto->save();
                    array_push($boletos, $Nboleto);
                }// fin for
                $AuxVuelo = Vuelo::find($request->vuelo);
                $segmentos=$AuxVuelo->segmentos;
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->boletos=$boletos;
                array_push($datos_vuelos, $objAUX);
                $AuxVuelo = Vuelo::find($request->vuelo_regreso);
                $segmentos=$AuxVuelo->segmentos;
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->boletos=$boletos;
                array_push($datos_vuelos, $objAUX);
            break;
            case 3:
                //dd($tipo,"vuelos a tomar",$request->vuelo);
               // dd($request->adultos,$request->ninos);
               $c=0; 
               for($i=0;$i<$request->cantidadV;$i++)
                { 
                    $boletos = array();
                    for($key = 0; $key < ($request->adultos+$request->ninos); $key++)
                    {
                       $c++;
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
                        $Nboleto->user_id="1";
                        $Nboleto->factura_id=$factura->id;
                        $Nboleto->vuelo_id=$request->vuelo[$i];
                        $Nboleto->localizador = str_random(3).'-'.random_int(100,999);
                        $Nboleto->save();
                        array_push($boletos, $Nboleto);
                    }// fin for interno
                   
                    $AuxVuelo = Vuelo::find($request->vuelo[$i]);
                $segmentos=$AuxVuelo->segmentos;
                    $ruta=$segmentos[0]->ruta;
                    $origen=$segmentos[0]->ruta->origen;
                    $destino=$segmentos[0]->ruta->destino;
                $objAUX= new stdClass();
                $objAUX->vuelo=$AuxVuelo;
                $objAUX->ruta=$ruta;
                $objAUX->origen=$origen;
                $objAUX->destino=$destino;
                $objAUX->boletos=$boletos;
                array_push($datos_vuelos, $objAUX);
                }//fin for externo
                
            break;
            
        }// fin switch

        // ENVIO DE EMAIL
       // Mail::to(Auth::guard('online')->user()->email)->send(new CompraBoleto($boletos, Auth::guard('online')->user(), $datos_vuelos, $factura));


        return view('Operativo.Taquilla.Compra.BoletoVendido')->with('factura', $factura)->with('tipo',$tipo)->with('datos_vuelo',$datos_vuelos);  
      
    } 

     public function BuscarCedula(Request $cedula)
    {
        dd("ha llegado al controlador");
        return;
        $datos=Cliente::Cedula($cedula);
        dd($datos);
    } 

}

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
                
               // $fechajson =Carbon::parse($origen['fecha'])->format('Y/m/d');
                
                $rutas = Ruta::Rutas($origen['origen'],$origen['destino'],$origen['fecha']);
               /*  echo json_encode($rutas);
                return; */
                
            }//fin if destino #
            else{
                // $fechajson =Carbon::parse($origen['fecha'])->format('Y/m/d');
                //return "ok orgien y fecha".$origen." ".$destino." ".$fecha;
                $rutas = Ruta::Rutas_origen($origen['origen'],$origen['fecha']);
                //dd($rutas);
            }        
        }//fin if orgen #
        else{
            if($origen['destino']!=0)
            {
               //  $fechajson =Carbon::parse($origen['fecha'])->format('Y/m/d');
                //return "ok destino y fecha".$origen." ".$destino." ".$fecha;
                $rutas = Ruta::Rutas_destino($origen['destino'],$origen['fecha']);
               // dd($rutas);
            }//fin if destino #
            else{
                // $fechajson =Carbon::parse(json_decode($origen['fecha']))->format('Y/m/d');
                //// dd($fechajson);
                 // return "ok fecha".$origen['origen']." ".$origen['destino']." ".$fechajson;
                $rutas = Ruta::Rutas_fecha($origen['fecha']);
                //echo json_encode($rutas[0]);
                //return;
            }
        }
       if(count($rutas)){
            $vuelos= array();
            $vueloAux;
            $segmentos;
            $objAUX= new stdclass();
            
            foreach($rutas as $vuelo){
                //dd($vuelo);
                $vueloAux=Vuelo::find($vuelo->id);
                $vuelosAux=new stdclass();
                $segmentos=$vueloAux->segmentos;
                $segmentosAux=array();
                foreach($segmentos as $seg){
                    if(!empty($seg))
                    {$segAUX= new stdclass();
                        $segAUX->ruta=$seg->ruta->id;
                        $segAUX->origen=$seg->ruta->origen_id;
                        $segAUX->destino=$seg->ruta->destino_id;
                        array_push($segmentosAux,$segAUX);}
                }//fin foreach segmentos
            $vuelosAux->id=$vuelo->id;
            $vuelosAux->segmentos=$segmentosAux;
            $vuelosAux->fecha=$vueloAux->fecha_salida;
            $vuelosAux->estado=$vueloAux->estado;
            array_push($vuelos,$vuelosAux);
            }//fin foreach de rutas
        // dd($vuelos);
         //dd($vuelos);
        echo json_encode($vuelos);
         return;
       
        }else{ //fin if vuelos encontrado.
            $vuelos="No hay Vuelos disponibles.";
            echo json_encode($vuelos);
            return;
        }
        
    }
    
    public function DetalleVuelo(Request $request)
    {
        $tipo = $request->get('tipo');
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
        $vuelos= array();
        $vueloAux;
        $objAUX= new stdclass();
       
        switch ($tipo) {
            case '1': // ida
                    $fecha_salida = new DateTime($request->get('fecha_salida'));
                    $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$fecha_salida);
                    if(!empty($rutas[0])){
                             $vueloAux=Vuelo::find($rutas[0]->id);
                            if($vueloAux->estado == "abierto"){
                                $objAUX->id=$vueloID->id;
                                $objAUX->origen=$objMultidestinos->origenes[$i];
                                $objAUX->destino=$objMultidestinos->destinos[$i];
                                $objAUX->fecha=$objMultidestinos->fechas[$i];
                                $objAUX->estado="disponible";
                            }else{ 
                                $objAUX->id=$vueloID->id;
                                $objAUX->origen=$objMultidestinos->origenes[$i];
                                $objAUX->destino=$objMultidestinos->destinos[$i];
                                $objAUX->fecha=$objMultidestinos->fechas[$i];
                                $objAUX->estado="no disponible";
                            }//fin else hay vuelo
                }else{ 
                     $objAUX->estado= "No hay vuelos";
                }//fin else
                
                break;
            
            case '2': // Ida y vuelta
            $fecha_regreso = new DateTime($request->get('fecha_regreso'));
            $fecha_salida = new DateTime($request->get('fecha_salida2'));
            $rutas=array();
            $ruta1 = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$fecha_salida);
            array_push($rutas,$ruta1);
            $ruta2 = Ruta::Rutas($request->get('destino_id'),$request->get('origen_id'),$fecha_regreso);
            array_push($rutas,$ruta2);
           

            break;
            
            case '3': //multidestino
            $vuelosMultiDestino=array();
            $objVuelos= new stdClass();
            $objVuelos->origenes=$request->origen_id;
            $objVuelos->destinos=$request->destino_id;
            $objVuelos->fechas=$request->fecha_salida;
            $objVuelos->cantidadV=$request->cantidadV;

            for($i=0;$i<$objVuelos->cantidadV;$i++){ //cantidadV = cantidas de segmentos de vuelos seleccionados
                //$rutas = new stdclass();
                $date = new DateTime($objVuelos->fechas[$i]);
                $rutas= Ruta::Rutas($objVuelos->origenes[$i],$objVuelos->destinos[$i],$date);
                if(!empty($rutas[0])){
                    foreach ($rutas as $vueloID) {
                            $vueloAux=Vuelo::find($vueloID->id);
                            if($vueloAux->estado == "abierto"){
                                $objAUX->id=$vueloID->id;
                                $objAUX->origen=$objVuelos->origenes[$i];
                                $objAUX->destino=$objVuelos->destinos[$i];
                                $objAUX->fecha=$objVuelos->fechas[$i];
                                $objAUX->estado="disponible";
                            }else{ 
                                $objAUX->id=$vueloID->id;
                                $objAUX->origen=$objVuelos->origenes[$i];
                                $objAUX->destino=$objVuelos->destinos[$i];
                                $objAUX->fecha=$objVuelos->fechas[$i];
                                $objAUX->estado="no disponible";
                            }//fin if hay vuelo
                        }//fin del foreahc
                }else{ 
                     $objAUX->id="";
                     $objAUX->origen="";
                     $objAUX->destino="";
                     $objAUX->fecha="";
                     $objAUX->estado= "No hay vuelos";
                }//fin else
                
            }//fin for.
            //dd("tipo:",$tipo, "adultos: ",$adultos,"niños: ",$ninos,"edades: ",$edades,"en brazo: ",$brazo,"vuelos encontrados",$vuelosMultiDestino, "todos los datos: ", $objVuelos);
          return view('online.componentes.DetallePaquete')->with('tipo',$tipo)->with('adultos',$adultos)->with('ninos',$ninos)->with('edades',$edades)->with('brazo',$brazo)->with('vuelosMultidestino',$vuelosMultidestino)->with('objVuelos',$objvuelos);
                break;
        }

   
    }
    
    public function CompraBoleto($indicador)
    {
        
        return view('Operativo.Taquilla.Compra.CompraBoleto',compact('indicador'));

    }

    public function BoletoVendido(Request $request)
    {
        $indicador=$request->indicador;
        $datos=\Cache::get('datos'.$indicador);
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
         $factura->adultos_cant = $datos->adultos;
         $factura->ninos_cant = $datos->ninos;
         $factura->NinosBrazos_cant = $request->NinosBrazos_cant;
         $factura->tarjeta_id = $tarjeta->id;
         $factura->save();
         
         // SAVE DATOS DE BOLETOS
         // dd(count($request->primerNombre));
        /* $user = Auth::guard('online')->user(); */
       $date = Carbon::now()->addYear(); //2015-01-01 00:00:00
        
            for($key = 0; $key < ($datos->adultos+$datos->ninos); $key++)
            {
                //dd($datos,$request->all());
                $Nboleto = new Boleto();
                $Nboleto->boleto_estado="Pagado";
                $Nboleto->fecha_expiracion=($date->year."-".$date->month."-".$date->day);
                if($request->tipo_boleto[$key]=="adulto")
                    $Nboleto->asiento=$request->asiento[$key];
                else{
                    $Nboleto->asiento="null";
                }
                $Nboleto->primerNombre=$request->primerNombre[$key];
                //dd($request->primerNombre);
                $Nboleto->segundoNombre = $request->segundoNombre[$key];
                $Nboleto->tipo_documento=$request->tipo_documento[$key];
                $Nboleto->documento=$request->documento[$key];
                $Nboleto->genero=$request->genero[$key]; 
                $Nboleto->apellido=$request->apellido[$key]; 
                $Nboleto->tipo_boleto=$request->tipo_boleto[$key];
                $Nboleto->fecha_nacimiento=$request->fecha_nacimiento[$key];
                if(($request->tipo_boleto[$key])=="bebe en brazos")
                    $Nboleto->detalles_salud="null";
                else{
                    $Nboleto->detalles_salud=$request->detalles_salud[$key];
                }

                $Nboleto->user_id="1";
                $Nboleto->factura_id=$factura->id;
                $Nboleto->vuelo_id=$datos->vuelo->id;
                $Nboleto->localizador = str_random(3).'-'.random_int(100,999);

                $Nboleto->save();
                //dd($boletos,$Nboleto);
                array_push($boletos, $Nboleto);    
               
                

            }
            
            $AuxVuelo = Vuelo::find($datos->vuelo->id);
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

        // ENVIO DE EMAIL
       // Mail::to(Auth::guard('online')->user()->email)->send(new CompraBoleto($boletos, Auth::guard('online')->user(), $datos_vuelos, $factura));


        return view('Operativo.Taquilla.Compra.BoletoVendido')->with('boletos',$boletos)->with('factura', $factura)->with('indicador',$indicador)->with('datos_vuelo',$datos_vuelos);  
      
    } 

}

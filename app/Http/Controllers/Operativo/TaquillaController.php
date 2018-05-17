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
		//dd($sucursal);
		return view('Operativo.Taquilla.Taquilla',compact('sucursales'));
		
    }

    public function DetalleVuelo(Request $request)
    {
        $tipo = $request->get('tipo');
        switch ($tipo) {
            case '1': // ida
                    $fecha_salida = new DateTime($request->get('fecha_salida'));
                    $rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$fecha_salida);
                break;
            
            case '2': // vuelta
            $fecha_regreso = new DateTime($request->get('fecha_regreso'));
            $rutas = Ruta::Rutas($request->get('destino_id'),$request->get('origen_id'),$fecha_regreso);
                break;
            
            case '3': //Multidestino
                break;
        }

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
        $segmentos;
        $origen;
        $destino;
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
            $objAUX->adultos=$adultos;
            $objAUX->ninos=$ninos;
            $objAUX->edades=$edades;
            $objAUX->brazos=$brazo;
            array_push($vuelos, $objAUX);
        }
        
        $indicador=count($vuelos);
        //dd($indicador);return;
        //if(0){dd("entro al if");}else{dd("entro al else");}
        if(count($vuelos)){
                return view('Operativo.Taquilla.Compra.DetalleVuelo')->with('vuelos',$vuelos);
        }else{

			   ?>
			   <script>
				   alert("FATAL ERROR - REINICIANDO SISTEMA -- SYSTEM OUT ");
			   </script> 
			   <?php  
			   return view('Operativo.Taquilla.Taquilla')->name('ida');
			 
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

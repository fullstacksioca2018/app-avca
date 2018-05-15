<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
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

   public function DetalleVuelo(Request $request){
   		$date = new DateTime($request->get('fecha_salida'));
   		$rutas = Ruta::Rutas($request->get('origen_id'),$request->get('destino_id'),$date);
   		$c1 = $request->get('ninos');
   		$c2 = $request->get('adultos');
   		$c3 = $request->get('ninosbrazos');

   		$vuelos = array();
   		$vuelosAux;
   		$segmentos;
   		$origen;
   		$destino;
   		$cantidad_personas = $c1 + $c2;
   		foreach ($rutas as $vueloID) {
   			$vueloAux = Vuelo::find($vueloID->id);
   			$segmentos = $vueloAux->segmentos;
   			if(count($segmentos)==1){
   				$ruta = $segmentos[0]->ruta;
   				$origen = $segmentos[0]->ruta->origen;
   				$destino = $segmentos[0]->ruta->destino;
   			}
   			else{
   				foreach ($segmentos as $segmento) {
   					dd("varios segmentos");
   				}
   			}
   			$objAUX = new stdClass();
   			$objAUX->vuelo = $vueloAux;
   			$objAUX->ruta = $ruta;
   			$objAUX->origen = $origen;
   			$objAUX->destino = $destino;
   			$objAUX->cantidad = $cantidad_personas;
   			$objAUX->ninosbrazos = $c3;
   			array_push($vuelos, $objAUX);
   		}
   		if(count($vuelos)){
            //dd($vuelos);
   			return view('operativo.DetalleVuelo')->with('vuelos',$vuelos);
   		}
   		else{
   			return "ERROR";
   		}

   }

}

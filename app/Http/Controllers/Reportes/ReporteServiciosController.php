<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Pasajero;
use App\Models\reporte\DW_Vuelo;
class ReporteServiciosController extends Controller
{
   public function __construct(){
        Carbon::resetToStringFormat();
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }
    public function periodos($consulta){
    	$fechas=array();
    	if($consulta->periodo=='Intervalo'){
    		$mesD=DW_Fecha::numeroMes($consulta->mesD);
    		$mesH=DW_Fecha::numeroMes($consulta->mesH);
    		$yearD=$consulta->yearD;
    		$yearH=$consulta->yearH;
    		$desde=Carbon::parse("01-".$mesD."-".$yearD);
    		$hasta=Carbon::parse("01-".$mesH."-".$yearH);
        	if($hasta->gt($desde)){ 
				while ($hasta->gte($desde)) {
					$auxfecha=DW_Fecha::buscar($yearD,$mesD);
					array_push($fechas, $auxfecha->fecha_id);
					$desde->addMonth();
    				$mesD=$desde->month;
    				$yearD=$desde->year;
				}
				return $fechas;
			}
			else{
				//reponder error
			}
    	}
    	else{
	    	if($consulta->periodo=='Personalizado'){
	    		$mesD=DW_Fecha::numeroMes($consulta->mesD);
	    		$yearD=$consulta->yearD;
	    		$desde=Carbon::parse("01-".$mesD."-".$yearD);
				$auxfecha=DW_Fecha::buscar($desde->year,$desde->month);
				array_push($fechas, $auxfecha->fecha_id);
				return $fechas;
	    	}else{
	        	$actual=Carbon::now();
	        	$actual->subMonth();
				$auxfecha=DW_Fecha::buscar($actual->year,$actual->month);
				array_push($fechas, $auxfecha->fecha_id);
				return $fechas;
    		}
    	}
    }
    
    public function labelsPeriodos($periodos){
    	$labels=array();
    	foreach ($periodos as $periodo) {
	    	$fecha=DW_Fecha::find($periodo);
	    	$mes=DW_Fecha::SringMinMes($fecha->mes);
	    	$inferior=$mes." ".$fecha->year;
    		array_push($labels, $inferior);
    	}
    	return $labels;

    }
    public function prueba(){
     
        return "hola";
    }
    public function ReporteServicio(Request $consulta){
        return response()->JSON($consulta->all());
    	$label=array();
        $stack=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";

        // return response()->json($consulta->all());
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        $labels=$this->labelsPeriodos($periodos);
        if($consulta->tipo!="Busqueda"){
			if($consulta->parametros){
                if((count($consulta->parametros))>1){
                    for($s=0;$s<count($consulta->filtrosP);$s++){
                        for($c=0;$c<count($consulta->filtrosV);$c++){
                        	return "Filtros pasajeros y vuelos";
                        }
                    }
                }
                else{
                	if($consulta->parametros[0]=='Vuelos'){
                		return "algo para vuelos";
                	}
                	else{
                		return "algo para pasajeros";
                	}
                }
            }
            else{
            	return "error sin parametros";
            }
        }
        else{
        	return "busqueda";
        }

    }
}

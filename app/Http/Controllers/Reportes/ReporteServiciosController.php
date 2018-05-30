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
        switch ($consulta->periodo) {
            // case 'Intervalo':
            //     $mesD=DW_Fecha::numeroMes($consulta->mesD);
            //     $mesH=DW_Fecha::numeroMes($consulta->mesH);
            //     $desde=Carbon::parse("01-".$mesD."-".$yearD);
            //     $hasta=Carbon::parse("01-".$mesH."-".$yearH);
            //     if($hasta->gt($desde)){ 
            //         while ($hasta->gte($desde)) {
            //             $obj= new stdClass();
            //             $obj->tipo="Fecha";
            //             $obj->desde=$desde;
            //             $obj->hasta=$hasta;
            //             array_push($fechas, $obj);
            //             $desde->addMonth();
            //             while ($desde->month==$hasta->month) {
            //                 $hasta->addDay();
            //             }
            //             $hasta->subDay();
            //         }
            //         return $fechas;
            //     }
            //     else{
            //         return "Error";
            //         //reponder error
            //     }
            //     break;
            case 'Personalizado':
                $desde=Carbon::parse($consulta->desde);
                $hasta=Carbon::parse($consulta->hasta);
                // return $hasta->toDateTimeString();
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$desde;
                $obj->hasta=$hasta;
                array_push($fechas, $obj);
                break;
            case 'Semana anterior':
                $actual=Carbon::now();
                $actual->subWeeks(2);
                while ($actual->dayOfWeekIso!=1) {
                    $actual->addDay();
                }
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$actual;
                $obj->hasta=$actual->copy()->addDays(6);
                array_push($fechas, $obj);
                break;
            case 'Mes anterior':
                $actual=Carbon::now();
                $actual->subMonth();
                $desde=Carbon::parse("01-".$actual->month."-".$actual->year);
                $hasta=$desde->copy();
                while ($desde->month==$hasta->month) {
                    $hasta->addDay();
                }
                $hasta->subDay();
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$desde;
                $obj->hasta=$hasta;
                array_push($fechas, $obj);
                break;
            case 'Temporada': 
                for($i=0;$i<count($consulta->year);$i++){
                    for($t=0;$t<count($consulta->temporadas);$t++){
                        $temporada=DW_Temporada::buscar($consulta->temporadas[$t],$consulta->year[$i]);
                        $obj= new stdClass();
                        $obj->tipo="Temporada";
                        $obj->desde=$temporada->inicio;
                        $obj->hasta=$temporada->final;
                        $obj->nombre=$temporada->nombre;
                        $obj->temporada_id=$temporada->temporada_id;
                        array_push($fechas, $obj);
                    }   
                }
                break;
            case 'Actual':
                $actual=Carbon::now();
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$actual;
                $obj->hasta=$actual->copy();
                array_push($fechas, $obj);
                break;
        }
        return $fechas;
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
			if($consulta->filtros){
                    for($f=0;$f<count($consulta->filtros);$f++){
                        switch ($consulta->filtros[$f]) {
                            case 'Destino':
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            $labelsAux="Destino ".$ruta->ruta_id.'. '.$ruta->origen->sigla.'-'.$ruta->destino->sigla;
                                            array_push($labels,$labelsAux);
                                            $info=$this->consultaIngresoRuta($periodos[$pp],$consulta->rutasF[$r]);
                                            array_push($previos, $info);
                                            break;
                                        case 'Pasajeros':
                                            break;
                                    }
                                }
                                break;
                            case 'Origen':
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            break;
                                        case 'Pasajeros':
                                            break;
                                    }
                                }
                                break;
                            case 'Ruta':
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            break;
                                        case 'Pasajeros':
                                            break;
                                    }
                                }
                                break;
                        }

                    }
                }
                return "consulta con filtros";
            }
            else{
                for ($pp=0; $pp < count($periodos); $pp++) {
                    return "for periodo sin filtro";
                }
                return "consulta sin filtros";
            }
        }
        else{
        	return "busqueda";
        }

    }
}

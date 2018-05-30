<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Pasajero;
use App\Models\reporte\DW_ReporteServicio;
use App\Models\reporte\DW_Vuelo;
use App\Models\reporte\DW_Temporada;

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
        return  DW_ReporteServicio::VuelosDestino($obj,6,'Ejecutados');
    }
    public function ReporteServicio(Request $consulta){
    	$label=array();
    	$labels=array();
        $previos=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";
        // return response()->json($consulta->all());
        $periodos=$this->periodos($consulta); //fechas meses para consulta
       // $labels=$this->labelsPeriodos($periodos);
        if($consulta->tipo!="Busqueda"){
			if($consulta->filtros){
                for ($pp=0; $pp < count($periodos); $pp++) {
                    for($f=0;$f<count($consulta->filtros);$f++){
                        switch ($consulta->filtros[$f]) {
                            case 'Destino':
                                for($dF=0;$dF<count($consulta->destinosF);$dF++){
                                    for($p=0;$p<count($consulta->parametros);$p++){
                                        switch ($consulta->parametros[$p]) {
                                            case 'Vuelos':
                                                if(count($consulta->filtrosV)>0){
                                                    for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                                        $destino=DW_Sucursal::buscar($consulta->destinosF[$dF]);
                                                        $labelsAux="Vuelos ".$consulta->filtrosV[$fv]." Del Destino: ".$destino->nombre;
                                                        array_push($labels,$labelsAux);
                                                        $info=$this->consultaVuelosDestino($periodos[$pp],$destino->sucursal_id,$consulta->filtrosV[$fv]);
                                                        array_push($previos, $info);
                                                        return response()->JSON($info);
                                                    }
                                                }
                                                else{
                                                    $labelsAux="Vuelos Del Destino: ".$destino->nombre;
                                                    array_push($labels,$labelsAux);
                                                    $info=$this->consultaVuelosDestino($periodos[$pp],$destino->sucursal_id,$consulta->filtrosV[$fv]);
                                                    array_push($previos, $info);
                                                    return response()->JSON($info);
                                                }
                                                return response()->JSON($previos);
                                                break;
                                            case 'Pasajeros':
                                                if(count($consulta->filtrosV)>0){
                                                    for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                                        $labelsAux="Vuelos ".$consulta->filtrosV[$fv]." Del Destino: ".$consulta->destinosF[$dF];
                                                        array_push($labels,$labelsAux);
                                                        $info=$this->consultaVuelosDestino($periodos[$pp],$consulta->destinosF[$dF],$consulta->filtrosV[$fv]);
                                                        array_push($previos, $info);
                                                        return response()->JSON($info);
                                                    }
                                                }
                                                else{
                                                    $labelsAux="Vuelos ".$consulta->filtrosV[$fv]." Del Destino: ".$consulta->destinosF[$dF];
                                                    array_push($labels,$labelsAux);
                                                    $info=$this->consultaVuelosDestino($periodos[$pp],$consulta->destinosF[$dF],$consulta->filtrosV[$fv]);
                                                    array_push($previos, $info);
                                                    return response()->JSON($info);
                                                }
                                                return response()->JSON($previos);
                                                break;
                                        }
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

    public function consultaVuelosDestino($periodo,$destino,$filtroV){
        if($filtroV!=null){
            return DW_ReporteServicio::VuelosDestino($periodo,$destino,$filtroV);
        }
        else{
            return DW_ReporteServicio::Destino($periodo,$destino);
        }
    }
}

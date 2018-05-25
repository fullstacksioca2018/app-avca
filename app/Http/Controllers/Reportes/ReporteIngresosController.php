<?php

namespace App\Http\Controllers\reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\reporte\DW_Temporada;
use stdClass;

class ReporteIngresosController extends Controller
{
    public function periodos($consulta){
    	$fechas=array();
        switch ($consulta->periodo) {
            case 'Intervalo':
                $mesD=DW_Fecha::numeroMes($consulta->mesD);
                $mesH=DW_Fecha::numeroMes($consulta->mesH);
                $desde=Carbon::parse("01-".$mesD."-".$yearD);
                $hasta=Carbon::parse("01-".$mesH."-".$yearH);
                if($hasta->gt($desde)){ 
                    while ($hasta->gte($desde)) {
                        $obj= new stdClass();
                        $obj->tipo="Fecha";
                        $obj->desde=$desde;
                        $obj->hasta=$hasta;
                        array_push($fechas, $obj);
                        $desde->addMonth();
                    }
                    return $fechas;
                }
                else{
                    //reponder error
                }
                break;
            case 'Personalizado':
                $mesD=DW_Fecha::numeroMes($consulta->mesD);
                $yearD=$consulta->yearD;
                $desde=Carbon::parse("01-".$mesD."-".$yearD);
                $auxfecha=DW_Fecha::buscar($desde->year,$desde->month);
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$desde;
                $obj->hasta=null;
                array_push($fechas, $obj);
            case 'Personalizado':
                $mesD=DW_Fecha::numeroMes($consulta->mesD);
                $yearD=$consulta->yearD;
                $desde=Carbon::parse("01-".$mesD."-".$yearD);
                $auxfecha=DW_Fecha::buscar($desde->year,$desde->month);
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$desde;
                $obj->hasta=null;
                array_push($fechas, $obj);
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
            case 'Mes anterior':
                $actual=Carbon::now();
                $actual->subMonth();
                $auxfecha=DW_Fecha::buscar($actual->year,$actual->month);
                $obj= new stdClass();
                $obj->tipo="Fecha";
                $obj->desde=$desde;
                $obj->hasta=null;
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
        $actual->subWeeks(2);
        while ($actual->dayOfWeekIso!=1) {
            $actual->addDay();
        }
        $obj= new stdClass();
        $obj->desde=$actual;
        $obj->hasta=$actual->copy()->addDays(6);
        return response()->JSON($obj);
    }

    ////////////////////////////////////////////////////////////////
    ////////INGRESOS/////////////////////////////////////INGRESOS///
    ////////////////////INGRESOS///////////////////////////////////
    ////////////////////////////////////////////////////////////////
    /////////INGRESOS///////////////////////////INGRESOS////////////
    ////////////////////////////////////////////////////////////////

    public function ReporteIngreso(Request $consulta){
        $label=array();
        $stack=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";

        // return response()->json($consulta->all());
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        return response()->json($periodos);
        // $labels=$this->labelsPeriodos($periodos);
        if($consulta->tipo!="Busqueda"){
            if($consulta->filtros){
                for($f=0;$f<count($consulta->filtros);$f++){
                    switch ($consulta->filtros[$f]) {
                        case 'Ruta':
                            return "F Ruta";
                            break;
                        case 'Origen':
                            return "F Origen";
                            break;
                        case 'Destino':
                            return "F Destino";
                            break;
                    }
                }
            }
            else{
                //sin filtros
            }
        }
        else{
            //si es una busqueda
        }
        return $consulta->all();
    }
}

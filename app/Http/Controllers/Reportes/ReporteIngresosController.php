<?php

namespace App\Http\Controllers\reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\reporte\DW_Temporada;
use App\Models\reporte\DW_Ruta;
use App\Models\reporte\DW_ReporteIngresos;
use stdClass;

class ReporteIngresosController extends Controller
{
    public function __construct(){
        Carbon::resetToStringFormat();
      Carbon::setLocale('es');
      date_default_timezone_set('America/Caracas');
    }

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
                        while ($desde->month==$hasta->month) {
                            $hasta->addDay();
                        }
                        $hasta->subDay();
                    }
                    return $fechas;
                }
                else{
                    return "Error";
                    //reponder error
                }
                break;
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
        $actual->subWeeks(2);
        while ($actual->dayOfWeekIso!=1) {
            $actual->addDay();
        }
        $obj= new stdClass();
        $obj->tipo="Fecha";
        $obj->desde=$actual;
        $obj->hasta=$actual->copy()->addDays(6);
        return DW_ReporteIngresos::PorRutaFecha($obj->desde,$obj->hasta,4);
    }

    ////////////////////////////////////////////////////////////////
    ////////INGRESOS/////////////////////////////////////INGRESOS///
    ////////////////////INGRESOS///////////////////////////////////
    ////////////////////////////////////////////////////////////////
    /////////INGRESOS///////////////////////////INGRESOS////////////
    ////////////////////////////////////////////////////////////////

    public function ReporteIngreso(Request $consulta){
        $label=array();
        $labels=array();
        $stack=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";
        $previos=array();
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        // return response()->json($periodos);
        // $labels=$this->labelsPeriodos($periodos);
        if($consulta->tipo!="Busqueda"){
            if($consulta->filtros){
                for ($pp=0; $pp < count($periodos); $pp++) {
                    for($f=0;$f<count($consulta->filtros);$f++){
                        switch ($consulta->filtros[$f]) {
                            case 'Ruta':
                                for ($r=0; $r <count($consulta->rutasF) ; $r++) {
                                    $ruta=DW_Ruta::find($consulta->rutasF[$r]);
                                    $labelsAux="Ruta ".$ruta->ruta_id.'. '.$ruta->origen->sigla.'-'.$ruta->destino->sigla;
                                    array_push($labels,$labelsAux);
                                    $info=$this->consultaIngresoRuta($periodos[$pp],$consulta->rutasF[$r]);
                                    array_push($previos, $info);
                                    // return $info;
                                }
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
                $datos=$this->formatiarLabelData($previos);
                // return $datos;
                $obj= new stdClass();
                if(((count($consulta->filtros))>1)||((count($consulta->rutasF))>1)||((count($consulta->origenesF))>1)||((count($consulta->destinosF))>1)){ //GRAFICA BARG
                    $obj->titulo="Ingresos";
                    $obj->grafico="Bar";
                    $obj2= new stdClass();
                    $obj2->label=$labels;
                    $obj2->labels=$datos->label2;
                    // $obj2->stack=$stack;
                    $obj2->tipo="Ingresos";
                    $obj2->data=$datos->data;
                    $obj->datos=$obj2;
                }
                else{ //GRAFICA TORTA PIE
                    $acumulador=0;
                    if($consulta->tipo!='Busqueda'){
                        foreach ($data as $key) {
                            $acumulador=$acumulador+$key;
                        }
                    }
                    else{
                        foreach ($data as $key) {
                            $acumulador=$acumulador+$key[0];
                        }
                    }
                    $aux=100-$acumulador;
                    array_push($label, "Otro");
                    array_push($data, $aux);
                    
                    $obj->titulo=$titulo;
                    $obj->grafico="Torta";
                    $obj2=  new stdClass();
                    $obj2->labels=$label;
                    // $obj2->label=$label;
                    $obj2->data=$data;
                    $obj->datos=$obj2;
                }
                    // return "algo";
                return response()->json($obj); 
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

    public function consultaIngresoRuta($periodo,$ruta){
        $myArray = explode('.', $ruta);
        $ruta_id=$myArray[0];
        switch ($periodo->tipo) {
            case 'Temporada':
                return 'Temporada';
                break;
            case 'Fecha':
                $info=DW_ReporteIngresos::PorRutaFecha($periodo->desde,$periodo->hasta,$ruta_id);
                return $info;
                break;
        }

    }

    public function formatiarLabelData($previos){
        $labels=array();
        if(count($previos[0])!=0){
            $actual=Carbon::parse($previos[0][0]->fecha_ingreso);
            $desde=Carbon::parse($actual->year."-".$actual->month."-1");
            $hasta=$desde->copy();
            while ($desde->month==$hasta->month) {
                $hasta->addDay();
            }

            $hasta->subDay();
            $label=array(); 
            $label2=array(); 
            $data=array(); 
            for ($dia=1; $dia < $hasta->day; $dia++) {
                for ($i=0; $i < count($previos); $i++) { 
                    for ($j=0; $j < count($previos[$i]); $j++) { 
                        $actual=Carbon::parse($previos[$i][$j]->fecha_ingreso);
                        if($actual->day==$dia){
                            array_push($label, $actual->toDateTimeString());
                            array_push($label2, $actual->format('Y-m-d'));
                            $j=count($previos[$i]);
                            $i=count($previos);
                            break;
                        }
                        else{
                            if($actual->day>$dia){
                                $j=count($previos[$i]);
                                break;
                            }
                        }
                        
                    }
                }
            }
            for ($i=0; $i < count($previos); $i++) {
                $dataAux=array();
                for($indL=0;$indL<count($label);$indL++){
                    for ($j=0; $j < count($previos[$i]); $j++) { 
                        $actual1=Carbon::parse($previos[$i][$j]->fecha_ingreso);
                        $actual2=Carbon::parse($label[$indL]);
                        if($actual1->day==$actual2->day){
                            array_push($dataAux, $previos[$i][$j]->total);
                            $j=count($previos[$i]);
                        }
                        else{
                            if($actual1->day>$actual2->day){
                                array_push($dataAux, 0);
                                $j=count($previos[$i]);
                            }
                        } 
                    }
                }
                array_push($data, $dataAux);
            }
            // return "sdgsdgdf";
            $obj=new stdClass();
            $obj->data=$data;
            $obj->label=$label;
            $obj->label2=$label2;

            return $obj;
            
        }
        else{
            $obj=new stdClass();
            $obj->data=array();
            $obj->label=array();
            $obj->label2=array();

            return $obj;
        }

    }
}

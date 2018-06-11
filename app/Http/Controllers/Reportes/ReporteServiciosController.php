<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Pasajero;
use App\Models\reporte\DW_ReporteServicio;
use App\Models\reporte\DW_Vuelo;
use App\Models\reporte\DW_Sucursal;
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
                $aux=2;
                if($actual->dayOfWeekIso==1){
                    $aux=1;
                }
                $actual->subWeeks($aux);
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
            if($periodo->desde->toDateString()!=$periodo->hasta->toDateString())
                $inferior=$periodo->desde->toDateString()." / ".$periodo->hasta->toDateString();
            else
                $inferior=$periodo->desde->toDateString();
            array_push($labels, $inferior);
        }
        return $labels;

    }

    public function prueba(){
        $horas="18:34:23";
        $myArray = explode(':', $horas);
        return $myArray[0];
        // $actual=Carbon::now();
        // $actual->subMonth();
        // $desde=Carbon::parse("01-".$actual->month."-".$actual->year);
        // $hasta=$desde->copy();
        // while ($desde->month==$hasta->month) {
        //     $hasta->addDay();
        // }
        // $hasta->subDay();
        // $obj= new stdClass();
        // $obj->tipo="Fecha";
        // $obj->desde=$desde;
        // $obj->hasta=$hasta;
        // return  DW_ReporteServicio::VuelosDestino($obj,6,'Ejecutados');
    }
    public function ReporteServicio(Request $consulta){
        $label=array();
        $stack=array();
        $labels=array();
        $previos=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        $labels=$this->labelsPeriodos($periodos);
        for($p=0;$p<count($consulta->parametros);$p++){
            if($titulo=='')
                $titulo=$consulta->parametros[$p];
            else
                $titulo=$titulo.", ".$consulta->parametros[$p];
        }
        if($consulta->tipo!="Búsqueda Avanzada"){
			if($consulta->filtros){
                for($f=0;$f<count($consulta->filtros);$f++){
                    switch ($consulta->filtros[$f]) {
                        case 'Destino':
                            for($dF=0;$dF<count($consulta->destinosF);$dF++){
                                $destino=DW_Sucursal::buscar($consulta->destinosF[$dF]);
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            if(count($consulta->filtrosV)>0){
                                                for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                                    $auxlabel="Vuelos ".$consulta->filtrosV[$fv]." Del Destino: ".$destino->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaVuelosDestino($periodos[$pp],$destino->sucursal_id,$consulta->filtrosV[$fv]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);

                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaVuelosDestino($periodos[0],$destino->sucursal_id,$consulta->filtrosV[$fv]);
                                                        //return $info;
                                                        $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }
                                            }
                                            else{
                                                $auxlabel="Vuelos Del Destino: ".$destino->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaVuelosDestino($periodos[$pp],$destino->sucursal_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaVuelosDestino($periodos[0],$destino->sucursal_id,null);
                                                    //return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                            // return response()->JSON($label);
                                            break;
                                        case 'Pasajeros':
                                            if(count($consulta->filtrosP)>0){
                                                for($fp=0;$fp<(count($consulta->filtrosP));$fp++){
                                                    $auxlabel="Pasajeros ".$consulta->filtrosP[$fp]." Del Destino: ".$destino->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosP))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaPasajerosDestino($periodos[$pp],$destino->sucursal_id,$consulta->filtrosP[$fp]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);

                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaPasajerosDestino($periodos[0],$destino->sucursal_id,$consulta->filtrosP[$fp]);
                                                        //return $info;
                                                        $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }

                                            }
                                            else{
                                                $auxlabel="Pasajeros Del Destino: ".$destino->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaPasajerosDestino($periodos[$pp],$destino->sucursal_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaPasajerosDestino($periodos[0],$destino->sucursal_id,null);
                                                    //return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                           // return response()->JSON($previos);
                                            break;
                                    }
                                }                                
                                $cont++;
                            }
                            break;
                        case 'Origen':                        
                            for($oF=0;$oF<count($consulta->origenesF);$oF++){
                                $origen=DW_Sucursal::buscar($consulta->origenesF[$oF]);
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            if(count($consulta->filtrosV)>0){
                                                for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                                    $auxlabel="Vuelos ".$consulta->filtrosV[$fv]." del Origin: ".$origen->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaVuelosOrigen($periodos[$pp],$origen->sucursal_id,$consulta->filtrosV[$fv]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaVuelosOrigen($periodos[0],$origen->sucursal_id,$consulta->filtrosV[$fv]);
                                                        //return $info;
                                                        $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }
                                            }
                                            else{
                                                $auxlabel="Vuelos Del Origen: ".$origen->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaVuelosOrigen($periodos[$pp],$origen->sucursal_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaVuelosOrigen($periodos[0],$origen->sucursal_id,null);
                                                    //return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                            // return response()->JSON($label);
                                            break;
                                        case 'Pasajeros':
                                            if(count($consulta->filtrosP)>0){
                                                for($fp=0;$fp<(count($consulta->filtrosP));$fp++){
                                                    $auxlabel="Pasajeros ".$consulta->filtrosP[$fp]." Del Origen: ".$origen->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosP))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaPasajerosOrigen($periodos[$pp],$origen->sucursal_id,$consulta->filtrosP[$fp]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);

                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaPasajerosOrigen($periodos[0],$origen->sucursal_id,$consulta->filtrosP[$fp]);
                                                        //return $info;
                                                        $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }

                                            }
                                            else{
                                                $auxlabel="Pasajeros Del Origen: ".$origen->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaPasajerosOrigen($periodos[$pp],$origen->sucursal_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaPasajerosOrigen($periodos[0],$origen->sucursal_id,null);
                                                    //return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                           // return response()->JSON($previos);
                                            break;
                                    }
                                }
                                $cont++;
                            }
                            break;
                        case 'Ruta':
                            for($rF=0;$rF<count($consulta->rutasF);$rF++){
                                $ruta=new stdClass();
                                $ruta->nombre=$consulta->rutasF[$rF];
                                $ruta->ruta_id=explode('.', $consulta->rutasF[$rF])[0];
                                for($p=0;$p<count($consulta->parametros);$p++){
                                    switch ($consulta->parametros[$p]) {
                                        case 'Vuelos':
                                            if(count($consulta->filtrosV)>0){
                                                for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                                    $auxlabel="Vuelos ".$consulta->filtrosV[$fv]." de la Ruta: ".$ruta->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaVuelosRuta($periodos[$pp],$ruta->ruta_id,$consulta->filtrosV[$fv]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);

                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaVuelosRuta($periodos[0],$ruta->ruta_id,$consulta->filtrosV[$fv]);
                                                        //return $info;
                                                        $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }
                                            }
                                            else{
                                                $auxlabel="Vuelos de la Ruta: ".$ruta->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaVuelosRuta($periodos[$pp],$ruta->ruta_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaVuelosRuta($periodos[0],$ruta->ruta_id,null);
                                                    // return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                            // return response()->JSON($label);
                                            break;
                                        case 'Pasajeros':
                                            if(count($consulta->filtrosP)>0){
                                                for($fp=0;$fp<(count($consulta->filtrosP));$fp++){
                                                    $auxlabel="Pasajeros ".$consulta->filtrosP[$fp]." de la Ruta: ".$ruta->nombre;
                                                    if(((count($periodos))>1)||((count($consulta->filtrosP))>1)){
                                                        $dataAux=array();
                                                        for($pp=0;$pp<(count($periodos));$pp++){
                                                            $info=$this->consultaPasajerosRuta($periodos[$pp],$ruta->ruta_id,$consulta->filtrosP[$fp]);
                                                            array_push($dataAux, $info);
                                                        }
                                                        array_push($data, $dataAux);
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                    }
                                                    else{
                                                        array_push($label, $auxlabel);
                                                        array_push($stack, $cont);
                                                        $info=$this->consultaPasajerosRuta($periodos[0],$ruta->ruta_id,$consulta->filtrosP[$fp]);
                                                        //return $info;
                                                    $dataAux=array();
                                                        array_push($dataAux, $info);
                                                        array_push($data, $dataAux);
                                                    }
                                                }

                                            }
                                            else{
                                                $auxlabel="Pasajeros de la Ruta: ".$ruta->nombre;
                                                if(((count($periodos))>1)||((count($consulta->filtrosV))>1)){
                                                    $dataAux=array();
                                                    for($pp=0;$pp<(count($periodos));$pp++){
                                                        $info=$this->consultaPasajerosRuta($periodos[$pp],$ruta->ruta_id,null);
                                                        array_push($dataAux, $info);
                                                    }
                                                    array_push($data, $dataAux);
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);

                                                }
                                                else{
                                                    array_push($label, $auxlabel);
                                                    array_push($stack, $cont);
                                                    $info=$this->consultaPasajerosRuta($periodos[0],$ruta->ruta_id,null);
                                                    //return $info;
                                                    $dataAux=array();
                                                    array_push($dataAux, $info);
                                                    array_push($data, $dataAux);
                                                }
                                            }
                                           // return response()->JSON($previos);
                                            break;
                                    }
                                }
                                $cont++;
                            }
                            break;
                    }
                }
                // return "consulta con filtros";
            }
            else{ //sin filtros
                for($p=0;$p<count($consulta->parametros);$p++){
                    switch ($consulta->parametros[$p]) {
                        case 'Vuelos':
                            if(count($consulta->filtrosV)>0){
                                for($fv=0;$fv<(count($consulta->filtrosV));$fv++){
                                    $auxlabel="Vuelos ".$consulta->filtrosV[$fv];
                                    if((count($periodos)>1)||((count($consulta->filtrosV))>1)){
                                        $dataAux=array();
                                        for($pp=0;$pp<(count($periodos));$pp++){
                                            $info=$this->consultaVuelos($periodos[$pp],$consulta->filtrosV[$fv]);
                                            array_push($dataAux, $info);
                                        }
                                        array_push($data, $dataAux);
                                        array_push($label, $auxlabel);
                                        array_push($stack, $cont);
                                    }
                                    else{
                                        array_push($label, $auxlabel);
                                        array_push($stack, $cont);
                                        $info=$this->consultaVuelos($periodos[0],$consulta->filtrosV[$fv]);
                                        //return $info;
                                        $dataAux=array();
                                        array_push($dataAux, $info);
                                        array_push($data, $dataAux);
                                    }
                                }
                            }
                            else{
                                $auxlabel="Vuelos";
                                if((count($periodos))>1){
                                    $dataAux=array();
                                    for($pp=0;$pp<(count($periodos));$pp++){
                                        $info=$this->consultaVuelos($periodos[$pp],null);
                                        array_push($dataAux, $info);
                                    }
                                    array_push($data, $dataAux);
                                    array_push($label, $auxlabel);
                                    array_push($stack, $cont);
                                }
                                else{
                                    array_push($label, $auxlabel);
                                    array_push($stack, $cont);
                                    $info=$this->consultaVuelos($periodos[0],null);
                                // return response()->JSON($info);
                                    //return $info;
                                    $dataAux=array();
                                    array_push($dataAux, $info);
                                    array_push($data, $dataAux);
                                }
                            }
                            // return response()->JSON($label);
                            break;
                        case 'Pasajeros':
                            if(count($consulta->filtrosP)>0){
                                for($fp=0;$fp<(count($consulta->filtrosP));$fp++){
                                    $auxlabel="Pasajeros ".$consulta->filtrosP[$fp];
                                    if(((count($periodos))>1)||((count($consulta->filtrosP))>1)){
                                        $dataAux=array();
                                        for($pp=0;$pp<(count($periodos));$pp++){
                                            $info=$this->consultaPasajeros($periodos[$pp],$consulta->filtrosP[$fp]);
                                            array_push($dataAux, $info);
                                        }
                                        array_push($data, $dataAux);
                                        array_push($label, $auxlabel);
                                        array_push($stack, $cont);
                                    }
                                    else{
                                        array_push($label, $auxlabel);
                                        array_push($stack, $cont);
                                        $info=$this->consultaPasajeros($periodos[0],$consulta->filtrosP[$fp]);
                                        //return $info;
                                        $dataAux=array();
                                        array_push($dataAux, $info);
                                        array_push($data, $dataAux);
                                    }
                                }
                            }
                            else{                                
                                $auxlabel="Pasajeros";
                                if((count($periodos))>1){
                                    $dataAux=array();
                                    for($pp=0;$pp<(count($periodos));$pp++){
                                        $info=$this->consultaPasajeros($periodos[$pp],null);
                                        array_push($dataAux, $info);
                                    }
                                    array_push($data, $dataAux);
                                    array_push($label, $auxlabel);
                                    array_push($stack, $cont);
                                }
                                else{
                                    array_push($label, $auxlabel);
                                    array_push($stack, $cont);
                                    $info=$this->consultaPasajeros($periodos[0],null);
                                    //return $info;
                                    $dataAux=array();
                                    array_push($dataAux, $info);
                                    array_push($data, $dataAux);
                                }
                            }
                           // return response()->JSON($previos);
                            break;
                    }
                }
                // return "consulta sin filtros";
            }
        }
        else{
        	return "búsqueda Avanzada";
        }
        $obj= new stdClass();
        $obj->titulo=$titulo;
        $obj->grafico="BarG";
        $obj2= new stdClass();
        $obj2->labels=$labels;
        $obj2->label=$label;
        $obj2->stack=$stack;
        $obj2->tipo=$consulta->consulta;
        $obj2->data=$data;
        $obj->datos=$obj2;
        return response()->json($obj);  
    }

    public function consultaVuelosDestino($periodo,$destino,$filtroV){
        if($filtroV!=null){
            return DW_ReporteServicio::VuelosDestino($periodo,$destino,$filtroV);
        }
        else{
            return DW_ReporteServicio::DestinoV($periodo,$destino);
        }
    }

    public function consultaVuelosOrigen($periodo,$origen,$filtroV){
        if($filtroV!=null){
            return DW_ReporteServicio::VuelosOrigen($periodo,$origen,$filtroV);
        }
        else{
            return DW_ReporteServicio::OrigenV($periodo,$origen);
        }
    }

    public function consultaVuelosRuta($periodo,$ruta,$filtroV){
        if($filtroV!=null){
            return DW_ReporteServicio::VuelosRuta($periodo,$ruta,$filtroV);
        }
        else{
            return DW_ReporteServicio::RutaV($periodo,$ruta);
        }
    }

    public function consultaPasajerosDestino($periodo,$destino,$filtroP){
        if($filtroP!=null){
            return DW_ReporteServicio::PasajerosDestino($periodo,$destino,$filtroP);
        }
        else{
            return DW_ReporteServicio::DestinoP($periodo,$destino);
        }
    }

    public function consultaPasajerosOrigen($periodo,$origen,$filtroP){
        if($filtroP!=null){
            return DW_ReporteServicio::PasajerosOrigen($periodo,$origen,$filtroP);
        }
        else{
            return DW_ReporteServicio::OrigenP($periodo,$origen);
        }
    }

    public function consultaPasajerosRuta($periodo,$ruta,$filtroP){
        if($filtroP!=null){
            return DW_ReporteServicio::PasajerosRuta($periodo,$ruta,$filtroP);
        }
        else{
            return DW_ReporteServicio::RutaP($periodo,$ruta);
        }
    }

    public function consultaVuelos($periodo,$filtroV){
        if($filtroV!=null){
            return DW_ReporteServicio::VuelosEstado($periodo,$filtroV);
        }
        else{
            return DW_ReporteServicio::Vuelos($periodo);
        }
    }
    public function consultaPasajeros($periodo,$filtroP){
        if($filtroP!=null){
            return DW_ReporteServicio::PasajerosEdad($periodo,$filtroP);
        }
        else{
            return DW_ReporteServicio::Pasajeros($periodo);
        }
    }

}

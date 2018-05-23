<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\reporte\DW_Fecha;
use App\Models\reporte\DW_Cargo;
use App\Models\reporte\DW_Sucursal;
use Carbon\Carbon;
use stdClass;

class PanelController extends Controller
{
    public function reportes(Request $consulta){
        // return response()->json($consulta->all());
    	switch ($consulta->consulta) {
    		case 'Personal':
        		return $this->ReportePersonal($consulta);
    			break;
    		case 'Ingresos':
        		return $this->ReporteIngresos($consulta);
    			break;
    		case 'Servicios':
        		return $this->ReporteServicios($consulta);
    			break;
    	}
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



    public function ReporteIngresos($consulta){
        return response()->json($consulta->all());
    }

    public function ReporteServicios(Request $consulta){

    }

    public function prueba(){
        return "hola";
    }

    ////////////////////////////////////////////////////////////////
    ////////PERSONAL/////////////////////////////////////PERSONAL///
    ////////////////////PERSONAL///////////////////////////////////
    ////////////////////////////////////////////////////////////////
    /////////PERSONAL///////////////////////////PERSONAL////////////
    ////////////////////////////////////////////////////////////////
    
    public function consultaPersonalVacaciones($tipo,$sucursal,$cargo,$periodo){
        return 0;
    }
    public function consultaPersonalAusencias($tipo,$sucursal,$cargo,$periodo){
        switch ($tipo) {
            case '1':
                $asistencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
                $licencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $asistencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
                $licencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $asistencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
                $licencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $asistencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
                $licencia=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal y Cargo
                break;
        }
        if($asistencia[0]->total!=null){
            if($licencia[0]->total!=null){
                return 100-$asistencia[0]->total-$licencia[0]->total;
            }
            else{
                return 100-$asistencia[0]->total;
            }
        }
        else{
            if($licencia[0]->total!=null){
                return 100-$licencia[0]->total;
            }
            else{
                return 100;
            }
        }
    }
    public function consultaPersonalLicencia($tipo,$sucursal,$cargo,$periodo){
        switch ($tipo) {
            case '1':
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
                        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwlicencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal y Cargo
                break;
        }
        if($dato[0]->total!=null)
            return $dato[0]->total;
        else
            return 0;
    }
    public function consultaPersonalAsistencia($tipo,$sucursal,$cargo,$periodo){
        switch ($tipo) {
            case '1':
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DB::table('dwempleados')
                        ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
                        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
                        ->where('cargo_id',$cargo->cargo_id)
                        ->where('sucursal_id',$sucursal->sucursal_id)
                        ->where('dwasistencias.fecha_id',$periodo)
                        ->get();
            //Filtro Sucursal y Cargo
                break;
        }
        if($dato[0]->total!=null)
            return $dato[0]->total;
        else
            return 0;
    }
    public function consultaPersonal($tipo,$sucursal,$cargo,$parametro,$periodo){
                // return $parametro;
        switch ($parametro) {
            case 'Asistencias':
                return $this->consultaPersonalAsistencia($tipo,$sucursal,$cargo,$periodo);
                break;
            case 'Vacaciones':
                return $this->consultaPersonalVacaciones($tipo,$sucursal,$cargo,$periodo);
                break;

            case 'Licencias':
                return $this->consultaPersonalLicencia($tipo,$sucursal,$cargo,$periodo);
                break;

            case 'Inasistencias':
                return $this->consultaPersonalAusencias($tipo,$sucursal,$cargo,$periodo);
                break;
        }
        return 0;
    }
    public function ReportePersonal($consulta){
        $label=array();
        $stack=array();
        $data=array();
        $cont=0;
        $titulo="";
        // return response()->json($consulta->all());
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        $labels=$this->labelsPeriodos($periodos);
        if($consulta->filtros){
            if((count($consulta->filtros))>1){
                for($s=0;$s<count($consulta->sucursalesF);$s++){
                    for($c=0;$c<count($consulta->cargosF);$c++){
                        for($p=0;$p<count($consulta->parametros);$p++){
                            $auxlabel=$consulta->parametros[$p].": ".$consulta->cargosF[$c].", Suc.".$consulta->sucursalesF[$s];
                            if(((count($periodos))>1)||((count($consulta->sucursalesF))>1)||((count($consulta->cargosF))>1)){
                                $dataAux=array();
                                for($pp=0;$pp<(count($periodos));$pp++){
                                    $info=$this->consultaPersonal("4",$consulta->sucursalesF[$s],$consulta->cargosF[$c],$consulta->parametros[$p],$periodos[$pp]);
                                    array_push($dataAux, $info);
                                }
                                array_push($data, $dataAux);
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                            }
                            else{
                                //ES GRAFICA PIE 'TORTA'
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                                $info=$this->consultaPersonal("4",$consulta->sucursalesF[$s],$consulta->cargosF[$c],$consulta->parametros[$p],$periodos[0]);
                                //return $info;
                                array_push($data, $info);
                            }
                        }       
                        $cont++;
                    }   
                }
                for($p=0;$p<count($consulta->parametros);$p++){
                    if($titulo=='')
                        $titulo=$consulta->parametros[$p];
                    else
                        $titulo=$titulo.", ".$consulta->parametros[$p];
                }
                // return "filtro por sucursal y cargo";
            }
            else{
                if($consulta->filtros[0]=='Sucursal'){
                    for($s=0;$s<count($consulta->sucursalesF);$s++){
                        for($p=0;$p<count($consulta->parametros);$p++){
                            $auxlabel=$consulta->parametros[$p].": Suc.".$consulta->sucursalesF[$s];
                            if(((count($periodos))>1)||((count($consulta->sucursalesF))>1)){
                                $dataAux=array();
                                for($pp=0;$pp<(count($periodos));$pp++){
                                    $info=$this->consultaPersonal("2",$consulta->sucursalesF[$s],null,$consulta->parametros[$p],$periodos[$pp]);
                                    array_push($dataAux, $info);
                                }
                                array_push($data, $dataAux);
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                            }
                            else{
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                                $info=$this->consultaPersonal("2",$consulta->sucursalesF[$s],null,$consulta->parametros[$p],$periodos[0]);
                                array_push($data, $info);
                                //ES GRAFICA PIE 'TORTA'
                            }
                        }       
                        $cont++;
                    }   
                    for($p=0;$p<count($consulta->parametros);$p++){
                        if($titulo=='')
                            $titulo=$consulta->parametros[$p];
                        else
                            $titulo=$titulo.", ".$consulta->parametros[$p];
                    }
                    // return "filtro por sucursal";
                }
                else{
                    for($c=0;$c<count($consulta->cargosF);$c++){
                        for($p=0;$p<count($consulta->parametros);$p++){
                            $auxlabel=$consulta->parametros[$p].": ".$consulta->cargosF[$c];
                            if(((count($periodos))>1)||((count($consulta->cargosF))>1)){
                                $dataAux=array();
                                for($pp=0;$pp<(count($periodos));$pp++){
                                    $info=$this->consultaPersonal("3",null,$consulta->cargosF[$c],$consulta->parametros[$p],$periodos[$pp]);
                                    array_push($dataAux, $info);
                                }
                                array_push($data, $dataAux);
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                            }
                            else{
                                array_push($label, $auxlabel);
                                array_push($stack, $cont);
                                $info=$this->consultaPersonal("3",null,$consulta->cargosF[$c],$consulta->parametros[$p],$periodos[0]);
                                array_push($data, $info);
                                //ES GRAFICA PIE 'TORTA'
                            }
                        }       
                        $cont++;
                    }
                    for($p=0;$p<count($consulta->parametros);$p++){
                        if($titulo=='')
                            $titulo=$consulta->parametros[$p];
                        else
                            $titulo=$titulo.", ".$consulta->parametros[$p];
                    }
                    // return "filtro por cargo";
                }
            }
        }
        else{
                return "sin filtros";
        }
        $obj= new stdClass();
        if(((count($periodos))>1)||((count($consulta->cargosF))>1)||((count($consulta->sucursalesF))>1)){ //GRAFICA BARG
            $obj->titulo=$titulo;
            $obj->grafico="BarG";
            $obj2= new stdClass();
            $obj2->labels=$labels;
            $obj2->label=$label;
            $obj2->stack=$stack;
            $obj2->tipo=$consulta->consulta;
            $obj2->data=$data;
            $obj->datos=$obj2;
        }
        else{ //GRAFICA TORTA PIE
            $acumulador=0;
            foreach ($data as $key) {
                $acumulador=$acumulador+$key;
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
}

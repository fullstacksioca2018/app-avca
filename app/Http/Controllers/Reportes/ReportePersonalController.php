<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\reporte\DW_Fecha;
use App\Models\reporte\DW_Cargo;
use App\Models\reporte\DW_Reporte;
use App\Models\reporte\DW_Sucursal;
use Carbon\Carbon;
use stdClass;

class ReportePersonalController extends Controller
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
        $dato=DW_Reporte::CargosAusenciaAlta("1","1");
        return response()->JSON($dato);
        // return "hola";
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
                $asistencia=DW_Reporte::AsistenciaGeneral($periodo);
                $licencia=DW_Reporte::LicenciaGeneral($periodo);
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $asistencia=DW_Reporte::SucursalAsistencia($periodo,$sucursal);
                $licencia=DW_Reporte::SucursalLicencia($periodo,$sucursal);
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $asistencia=DW_Reporte::CargoAsistencia($periodo,$sucursal);
                $licencia=DW_Reporte::CargoLicencia($periodo,$sucursal);
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $asistencia=DW_Reporte::SucursalCargoAsistencia($periodo,$sucursal);
                $licencia=DW_Reporte::SucursalCargoLicencia($periodo,$sucursal);
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
                $dato=DW_Reporte::LicenciaGeneral($periodo);
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DW_Reporte::SucursalLicencia($periodo,$sucursal);
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $dato=DW_Reporte::CargoLicencia($periodo,$cargo);
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DW_Reporte::SucursalCargoAsistencia($periodo,$cargo,$sucursal);
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
                $dato=DW_Reporte::AsistenciaGeneral($periodo);
            //Sin filtros
                break;
            case '2':
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DW_Reporte::SucursalAsistencia($periodo,$sucursal);
            //Filtro Sucursal
                break;
            case '3':
                $cargo=DW_Cargo::buscar($cargo);
                $dato=DW_Reporte::CargoAsistencia($periodo,$cargo);
            //Filtro Cargo
                break;
            case '4':
                $cargo=DW_Cargo::buscar($cargo);
                $sucursal=DW_Sucursal::buscar($sucursal);
                $dato=DW_Reporte::SucursalCargoAsistencia($periodo,$cargo,$sucursal);
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
    public function ReportePersonal(Request $consulta){
        $label=array();
        $stack=array();
        $data=array();
        $auxdata=array();
        $cont=0;
        $titulo="";
        $periodos=$this->periodos($consulta); //fechas meses para consulta
        // return $periodos;
        $labels=$this->labelsPeriodos($periodos);
        if($consulta->tipo!="Busqueda"){
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
                for($p=0;$p<count($consulta->parametros);$p++){
                    $auxlabel=$consulta->parametros[$p];
                    if((count($periodos))>1){
                        $dataAux=array();
                        for($pp=0;$pp<(count($periodos));$pp++){
                            $info=$this->consultaPersonal("1",null,null,$consulta->parametros[$p],$periodos[$pp]);
                            array_push($dataAux, $info);
                        }
                        array_push($data, $dataAux);
                        array_push($label, $auxlabel);
                        array_push($stack, $cont);
                    }
                    else{
                        array_push($label, $auxlabel);
                        array_push($stack, $cont);
                        $info=$this->consultaPersonal("1",null,null,$consulta->parametros[$p],$periodos[0]);
                        // return $info;
                        array_push($data, $info);
                        //ES GRAFICA PIE 'TORTA'
                    }
                }       
                
                $cont++;
                for($p=0;$p<count($consulta->parametros);$p++){
                    if($titulo=='')
                        $titulo=$consulta->parametros[$p];
                    else
                        $titulo=$titulo.", ".$consulta->parametros[$p];
                }
         // return "sin filtros";
            }
        }
        else{ //Es una busqueda
            $titulo=$this->tituloString($consulta->parametros,$consulta->busqueda,$consulta->busquedaMonto,$consulta->busquedaRow);
            if($consulta->filtros){
                $consultaFiltro;
                if((count($consulta->filtros))>1){ 
                    $consultaFiltro=4;
                    // return "busqueda filtro sucursal y cargo";
                }
                else{
                    if($consulta->filtros[0]=='Sucursal'){
                        $consultaFiltro=2;
                        // return "busqueda filtro sucursal";
                    }
                    else{
                        $consultaFiltro=3;
                        // return "busqueda filtro cargo";
                    }
                }
                for($p=0;$p<count($consulta->parametros);$p++){
                    $info=$this->busquedaPersonal($consultaFiltro,$consulta->parametros[$p],$periodos[0],$consulta->busqueda,$consulta->busquedaMonto,$consulta->busquedaRow);
                    for ($i=0; $i < count($info->labels) ; $i++) {
                        array_push($data, [$info->data[$i]]);
                        array_push($label, $info->labels[$i]);
                        array_push($stack, $cont);
                        $cont++;
                    }
                }
            }
            else{ //La busqueda no se puede realizar sin filtros
                return "Error";
            }
        }
         $obj= new stdClass();
        // return response()->json($consulta->sucursalesF);
         if(((count($periodos))>1)||((count($consulta->sucursalesF))>1)||((count($consulta->cargosF))>1)||($consulta->tipo=="Busqueda"&&(count($label))>1)){ //GRAFICA BARG
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

    public function tituloString($parametros,$busqueda,$Monto,$Row){
        $textC='';
        for ($i=0; $i < count($parametros); $i++) { 
            $textC=$textC.$parametros[$i].", ";
        }
        $textC = trim($textC, ', ');
        $textC=$textC.': [';
        if($busqueda=='Más alto'||$busqueda=='Más bajo'){
            if($Row=='1'){
                $textC=$textC."El ".$busqueda;
            }
            else{
                $textC=$textC."Los ".$Row." ".$busqueda;
            }
        }
        else{
            if($Row=='1'){
                $textC=$textC."El ".$busqueda." ".$Monto;
            }
            else{
                if($busqueda=='Mayor que')
                    $textC=$textC."Los ".$Row." Mayores que ".$Monto;
                else
                    $textC=$textC."Los ".$Row." Menores que ".$Monto;
            }
        }
        $textC=$textC.']';
        return $textC;
    }
    public function busquedaPersonal($tipo,$parametro,$periodo,$busqueda,$Monto,$Row){
                // return $parametro;
        switch ($parametro) {
            case 'Asistencias':
                return $this->busquedaPersonalAsistencia($tipo,$parametro,$periodo,$busqueda,$Monto,$Row);
                break;
            case 'Vacaciones':
                return $this->busquedaPersonalVacaciones($tipo,$parametro,$periodo,$busqueda,$Monto,$Row);
                break;

            case 'Licencias':
                return $this->busquedaPersonalLicencia($tipo,$parametro,$periodo,$busqueda,$Monto,$Row);
                break;

            case 'Inasistencias':
        return $this->busquedaPersonalAusencias($tipo,$parametro,$periodo,$busqueda,$Monto,$Row);
                break;
        }
        return 0;
    }

    public function busquedaPersonalAsistencia($tipo,$parametro,$periodo,$busqueda,$Monto,$Row){
        $Monto = trim($Monto, '%');
                    // return $tipo;
        switch ($tipo) {
            case '1':
                return "Error";
            //Sin filtros
                break;
            case '2':
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesAsistenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesAsistenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesAsistenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                    // return "Entro";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesAsistenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales[$i]->label);
                    array_push($datos, $sucursales[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal
                break;
            case '3':
                switch ($busqueda) {
                    case "Más alto":
                        $cargos=DW_Reporte::CargosAsistenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $cargos=DW_Reporte::CargosAsistenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $cargos=DW_Reporte::CargosAsistenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $cargos=DW_Reporte::CargosAsistenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($cargos); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos[$i]->label);
                    array_push($datos, $cargos[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Cargo
                break;
            case '4':            
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesAsistenciaAlta($periodo,$Row);
                        $cargos=DW_Reporte::CargosAsistenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesAsistenciaBaja($periodo,$Row);
                        $cargos=DW_Reporte::CargosAsistenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesAsistenciaMayor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosAsistenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesAsistenciaMenor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosAsistenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales[$i]->label);
                    array_push($datos, $sucursales[$i]->data);
                }
                for ($i=0; $i < count($cargos); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos[$i]->label);
                    array_push($datos, $cargos[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal y Cargo
                break;
        }
        if($dato!=null)
            return $dato;
        else
            return null;
    }

    public function busquedaPersonalVacaciones($tipo,$parametro,$periodo,$busqueda,$Monto,$Row){
        return 0;
    }

    public function busquedaPersonalLicencia($tipo,$parametro,$periodo,$busqueda,$Monto,$Row){
        $Monto = trim($Monto, '%');
                    // return $tipo;
        switch ($tipo) {
            case '1':
                return "Error";
            //Sin filtros
                break;
            case '2':
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesLicenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesLicenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesLicenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                    // return "Entro";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesLicenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales[$i]->label);
                    array_push($datos, $sucursales[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal
                break;
            case '3':
                switch ($busqueda) {
                    case "Más alto":
                        $cargos=DW_Reporte::CargosLicenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $cargos=DW_Reporte::CargosLicenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $cargos=DW_Reporte::CargosLicenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $cargos=DW_Reporte::CargosLicenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($cargos); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos[$i]->label);
                    array_push($datos, $cargos[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Cargo
                break;
            case '4':            
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesLicenciaAlta($periodo,$Row);
                        $cargos=DW_Reporte::CargosLicenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesLicenciaBaja($periodo,$Row);
                        $cargos=DW_Reporte::CargosLicenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesLicenciaMayor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosLicenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesLicenciaMenor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosLicenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales[$i]->label);
                    array_push($datos, $sucursales[$i]->data);
                }
                for ($i=0; $i < count($cargos); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos[$i]->label);
                    array_push($datos, $cargos[$i]->data);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal y Cargo
                break;
        }
        if($dato!=null)
            return $dato;
        else
            return null;
    }

    public function busquedaPersonalAusencias($tipo,$parametro,$periodo,$busqueda,$Monto,$Row){
        $Monto = trim($Monto, '%');
                    // return $tipo;
        switch ($tipo) {
            case '1':
                return "Error";
            //Sin filtros
                break;
            case '2':
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesAusenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesAusenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesAusenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                    // return "Entro";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesAusenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales->label); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales->label[$i]);
                    array_push($datos, $sucursales->data[$i]);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal
                break;
            case '3':
                switch ($busqueda) {
                    case "Más alto":
                        $cargos=DW_Reporte::CargosAusenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $cargos=DW_Reporte::CargosAusenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $cargos=DW_Reporte::CargosAusenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $cargos=DW_Reporte::CargosAusenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($cargos->label); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos->label[$i]);
                    array_push($datos, $cargos->data[$i]);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Cargo
                break;
            case '4':            
                switch ($busqueda) {
                    case "Más alto":
                        $sucursales=DW_Reporte::SucursalesAusenciaAlta($periodo,$Row);
                        $cargos=DW_Reporte::CargosAusenciaAlta($periodo,$Row);
                        // return "Más alto";
                        break;
                    case "Más bajo":
                        $sucursales=DW_Reporte::SucursalesAusenciaBaja($periodo,$Row);
                        $cargos=DW_Reporte::CargosAusenciaBaja($periodo,$Row);
                        // return "Más bajo";
                        break;
                    case "Mayor que":
                        $sucursales=DW_Reporte::SucursalesAusenciaMayor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosAusenciaMayor($periodo,$Row,$Monto);
                        // return "Mayor que";
                        break;
                    case "Menor que":
                        $sucursales=DW_Reporte::SucursalesAusenciaMenor($periodo,$Row,$Monto);
                        $cargos=DW_Reporte::CargosAusenciaMenor($periodo,$Row,$Monto);
                        break;
                }
                $obj= new stdClass();
                $labels=array();
                $datos=array();
                for ($i=0; $i < count($sucursales->label); $i++) { 
                    array_push($labels, $parametro.": Suc. ".$sucursales->label[$i]);
                    array_push($datos, $sucursales->data[$i]);
                }
                for ($i=0; $i < count($cargos->label); $i++) { 
                    array_push($labels, $parametro.": Cargo ".$cargos->label[$i]);
                    array_push($datos, $cargos->data[$i]);
                }
                $obj->labels=$labels;
                $obj->data=$datos;
                return $obj;
            //Filtro Sucursal y Cargo
                break;
        }
        if($dato!=null)
            return $dato;
        else
            return null;
    }
}

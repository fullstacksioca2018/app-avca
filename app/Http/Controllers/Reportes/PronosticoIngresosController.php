<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Sucursal;
use App\Models\reporte\DW_Ingreso;
use App\Models\reporte\DW_Fecha;

class PronosticoIngresosController extends Controller
{
	public function prueba(){
		$datos=DW_Ingreso::Muestra();
		return $datos;
		// return DW_Pasajero::OrigenEdadMuestra(8,"Bebe");
	}
    public function PanelPronosticar(Request $consulta){
    	$label= array();
    	$labels= array();
		$stack= array();
		$data= array();
		$cont=0;
    	if((count($consulta->filtros))>=1){
	    	for ($f=0; $f < count($consulta->filtros) ; $f++) { 
	    		switch ($consulta->filtros[$f]) {
	    			case 'Origen':
	    				for ($o=0; $o < count($consulta->origenesF) ; $o++) { 
	    					$origen=DW_Sucursal::buscar($consulta->origenesF[$o]);
	    						$labelsAux="Ingresos Del Origen ".$origen->nombre;
                        		$dataAux=$this->ConsultaPronosticoIngresosOrigen($origen->sucursal_id);
                    			array_push($label, $labelsAux);
                                array_push($stack, $cont);
                    			array_push($data, $dataAux);
							$cont++;
	    				}
	    				break;
	    			case 'Destino':
	    				for ($d=0; $d < count($consulta->destinosF) ; $d++) { 
	    					$destino=DW_Sucursal::buscar($consulta->destinosF[$d]);
    						$labelsAux="Ingresos Del Destino ".$destino->nombre;
                    		$dataAux=$this->ConsultaPronosticoIngresosDestino($destino->sucursal_id);
                			array_push($label, $labelsAux);
                            array_push($stack, $cont);
                			array_push($data, $dataAux);
							$cont++;
	    				}
	    				break;
	    			case 'Ruta':
	    				$auxBanderaFiltro=true;
	    				for ($r=0; $r < count($consulta->rutasF) ; $r++) { 
	    					$ruta=new stdClass();
	                        $ruta->nombre=$consulta->rutasF[$r];
	                        $ruta->ruta_id=explode('.', $consulta->rutasF[$r])[0];
	                        $labelsAux="Ruta ".$ruta->nombre;
    						$labelsAux="Ingresos De la Ruta ".$ruta->nombre;
                    		$dataAux=$this->ConsultaPronosticoIngresosRuta($ruta->ruta_id);
                			array_push($label, $labelsAux);
                            array_push($stack, $cont);
                			array_push($data, $dataAux);
							$cont++;
	    				}
	    				break;
	    		}
	    	}
	    }
	    else{
	    	$labelsAux="Avca";
            array_push($label,$labelsAux);
            $dataAux=$this->ConsultaPronosticoIngresos();
            array_push($stack, $cont);
			array_push($data, $dataAux);
	    }

	    $auxArray= array(0,0,0,0,0,0);
	   for($i=0;$i<count($data);$i++){
	   		if(count($data[$i])>0){
	   			$data[$i]=$this->HoltWinters($data[$i],6);
	   		}
	   		else{
	   			$data[$i]=$auxArray;
	   		}
	   }
	   $obj= new stdClass();
        $obj->titulo=$this->contruccionTitulo($consulta->parametros[0]);
        $obj->grafico="BarG";
        $obj2= new stdClass();
        $obj2->labels=$this->contruccionLabels();
        $obj2->label=$label;
        $obj2->stack=$stack;
        $obj2->tipo="Pronostico";
        $obj2->data=$data;
        $obj->datos=$obj2;
        return response()->json($obj); 
    } 
    public function contruccionLabels(){
    	$labels=array();
	    $actual=Carbon::now();
    	for ($i=0; $i < 6; $i++) { 
	    	$actual->addMonth();
	    	$nu=DW_Fecha::Stringmes($actual->month);
	    	array_push($labels,$nu);
    	}
    	return $labels;
    }

    public function contruccionTitulo($parametro){
    	$actual=Carbon::now();
    	$titulo="Estimación de ".$parametro." Desde ".DW_Fecha::SringMinMes($actual->month)."-".$actual->year." a ";
    	$actual->addMonths(6);
    	$titulo=$titulo.DW_Fecha::SringMinMes($actual->month)."-".$actual->year;
    	return $titulo;
    }

	public function ConsultaPronosticoIngresosOrigen($origen){
		$datos=DW_Ingreso::OrigenMuestra($origen);
		return $datos;
	}

	public function ConsultaPronosticoIngresosDestino($destino){
		$datos=DW_Ingreso::DestinoMuestra($destino);
		return $datos;
	}

	public function ConsultaPronosticoIngresosRuta($ruta){
		$datos=DW_Ingreso::RutaMuestra($ruta);
		return $datos;
	}

	public function ConsultaPronosticoIngresos(){
		$datos=DW_Ingreso::Muestra();
		return $datos;
	}




	//datos es la muestra p periodos a pronosticar y l longitud de estacionalidad
//-99999 para identificar indefinido
    public function HoltWinters($datos,$p=4,$l=12){
        if(count($datos)<$l)
        $l=count($datos); //validacion para que la longitud no sea mas grande que la muestra
        $alfa=0.1;
        $beta=0.2;
        $gamma=0.7;
        for ($i=0; $i <($l-1) ; $i++) { 
            array_unshift($datos, -99999);
        }
        $At=array(); //Valor Atenuado del periodo t
        $Tt=array(); //Estimación de la tendencia del periodo t
        $St=array(); //Estimación de la estabilidad del periodo t
        $Ytp=array(); //pronostico del periodo t
        $resultados=array();  //solo los pronosticos de p

        //Inicializo $St
        for ($i=0; $i <($l-1) ; $i++) { 
            array_push($St, 1);
            array_push($At, -99999);
            array_push($Tt, -99999);
            array_push($Ytp, -99999);
        }
        array_push($Ytp, -99999);
        array_push($At, $datos[$l-1]);
        array_push($Tt, 0);
        array_push($St, 1);


        for($i=$l;$i<(2*$l-1);$i++){
            $ValorAtenuadot=$alfa*($datos[$i]/$St[$i-$l])+(1-$alfa)*($At[$i-1]+$Tt[$i-1]);
            array_push($At, $ValorAtenuadot);
            $EstimacionTendencia=$beta*($At[$i]-$At[$i-1])+(1-$beta)*$Tt[$i-1];
            array_push($Tt, $EstimacionTendencia);
        }
        for($i=$l;$i<(2*$l-1);$i++){
            $EstimacionEstabilidad=$gamma*($datos[$i]/$At[$i])+(1-$gamma)*$St[$i-$l];
            array_push($St, $EstimacionEstabilidad);
        }

        for($i=(2*$l-2);$i<(count($datos)-1);$i++){
            $EstimacionEstabilidad=$gamma*($datos[$i]/$At[$i])+(1-$gamma)*$St[$i-$l];
            array_push($St, $EstimacionEstabilidad);
            $ValorAtenuadot=$alfa*($datos[$i]/$St[$i-$l])+(1-$alfa)*($At[$i-1]+$Tt[$i-1]);
            array_push($At, $ValorAtenuadot);
            $EstimacionTendencia=$beta*($At[$i]-$At[$i-1])+(1-$beta)*$Tt[$i-1];
            array_push($Tt, $EstimacionTendencia);
        }

        for($i=$l;$i<(count($datos)+1);$i++){
            $Pronostico=($At[$i-1]+1*$Tt[$i-1])*$St[$i-1-$l+1];
            array_push($Ytp, $Pronostico);
        }
        array_push($resultados, round($Ytp[(count($Ytp)-1)]));
        $contP=2;
        for ($i=(count($datos)+1); $i < (count($datos)+$p); $i++) { 
            $Pronostico=($At[(count($At)-1)]+$contP*$Tt[(count($Tt)-1)])*$St[(count($datos)+1)-2-$l+$contP];
            $contP++;
            array_push($resultados, round($Pronostico));
        }
        return $resultados;
    }
}
<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Pasajero;
use App\Models\reporte\DW_Sucursal;
use App\Models\reporte\DW_Fecha;

class PronosticoPasajerosController extends Controller
{
	public function prueba(){
		$datos=DW_Pasajero::Muestra();
		return $datos;
		// return DW_Pasajero::OrigenEdadMuestra(8,"Bebe");
	}
     public function PanelPronosticar(Request $consulta){
						// return response()->JSON(($consulta->all()));
    	$label= array();
    	$labels= array();
		$stack= array();
		$data= array();
		$cont=0;
    	$auxBanderaFiltro=false;
    	if((count($consulta->filtros))>=1){
	    	for ($f=0; $f < count($consulta->filtros) ; $f++) { 
	    		switch ($consulta->filtros[$f]) {
	    			case 'Origen':
	    				$auxBanderaFiltro=true;
	    				for ($o=0; $o < count($consulta->origenesF) ; $o++) { 
	    					$origen=DW_Sucursal::buscar($consulta->origenesF[$o]);
	    					if(count($consulta->filtrosP)>=1){
	    						for ($fp=0; $fp < count($consulta->filtrosP) ; $fp++) { 
	    							switch ($consulta->filtrosP[$fp]) {
	    								case 'Edad':
	    									for($fpe=0;$fpe<count($consulta->edadesF);$fpe++){
			                        			$labelsAux="Pasajeros ".$consulta->edadesF[$fpe]." Del Origen ".$origen->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosEdadOrigen($origen->sucursal_id,$consulta->edadesF[$fpe]);
			                        			array_push($label, $labelsAux);
                                                array_push($stack, $cont);
			                        			array_push($data, $dataAux);
	    									}
	    									break;
	    								case 'Genero':
	    									for($fpg=0;$fpg<count($consulta->generosF);$fpg++){
			                        			$labelsAux="Pasajeros ".$consulta->generosF[$fpg]." Del Origen ".$origen->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosGeneroOrigen($origen->sucursal_id,$consulta->generosF[$fpg]);
			                        			array_push($label, $labelsAux);
                                                array_push($stack, $cont);
			                        			array_push($data, $dataAux);
	    									}
	    									break;
	    							}
	    						}

	    					}
	    					else{//sin filtros de persona
	    						$labelsAux="Pasajeros Del Origen ".$origen->nombre;
                        		$dataAux=$this->ConsultaPronosticoPasajerosOrigen($origen->sucursal_id);
                        			array_push($label, $labelsAux);
                                    array_push($stack, $cont);
                        			array_push($data, $dataAux);
	    					}
	    				}
	    				$cont++;
	    				break;
	    			case 'Destino':
	    				$auxBanderaFiltro=true;
	    				for ($d=0; $d < count($consulta->destinosF) ; $d++) { 
	    					$destino=DW_Sucursal::buscar($consulta->destinosF[$d]);
	    					if(count($consulta->filtrosP)>=1){
	    						for ($fp=0; $fp < count($consulta->filtrosP) ; $fp++) { 
	    							switch ($consulta->filtrosP[$fp]) {
	    								case 'Edad':
	    									for($fpe=0;$fpe<count($consulta->edadesF);$fpe++){
			                        			$labelsAux="Pasajeros ".$consulta->edadesF[$fpe]." Del Destino ".$destino->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosEdadDestino($destino->sucursal_id,$consulta->edadesF[$fpe]);
			                        			array_push($label, $labelsAux);
                                                array_push($stack, $cont);
			                        			array_push($data, $dataAux);
	    									}
	    									break;
	    								case 'Genero':
	    									for($fpg=0;$fpg<count($consulta->generosF);$fpg++){
			                        			$labelsAux="Pasajeros ".$consulta->generosF[$fpg]." Del Destino ".$destino->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosGeneroDestino($destino->sucursal_id,$consulta->generosF[$fpg]);
			                        			array_push($label, $labelsAux);
                                                array_push($stack, $cont);
			                        			array_push($data, $dataAux);
	    									}
	    									break;
	    							}
	    						}

	    					}
	    					else{//sin filtros de persona
	    						$labelsAux="Pasajeros Del Destino ".$destino->nombre;
                        		$dataAux=$this->ConsultaPronosticoPasajerosDestino($destino->sucursal_id);
                        			array_push($label, $labelsAux);
                                    array_push($stack, $cont);
                        			array_push($data, $dataAux);
	    					}
	    				}
	    				$cont++;
	    				break;
	    			case 'Ruta':
	    				$auxBanderaFiltro=true;
	    				for ($r=0; $r < count($consulta->rutasF) ; $r++) { 
	    					$ruta=new stdClass();
	                        $ruta->nombre=$consulta->rutasF[$r];
	                        $ruta->ruta_id=explode('.', $consulta->rutasF[$r])[0];
	                        $labelsAux="Ruta ".$ruta->nombre;

	                        if(count($consulta->filtrosP)>=1){
	    						for ($fp=0; $fp < count($consulta->filtrosP) ; $fp++) { 
	    							switch ($consulta->filtrosP[$fp]) {
	    								case 'Edad':
	    									for($fpe=0;$fpe<count($consulta->edadesF);$fpe++){
			                        			$labelsAux="Pasajeros ".$consulta->edadesF[$fpe]." De la Ruta ".$ruta->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosEdadRuta($ruta->ruta_id,$consulta->edadesF[$fpe]);
				                        			array_push($label, $labelsAux);
	                                                array_push($stack, $cont);
				                        			array_push($data, $dataAux);
	    									}
	    									break;
	    								case 'Genero':
	    									for($fpg=0;$fpg<count($consulta->generosF);$fpg++){
			                        			$labelsAux="Pasajeros ".$consulta->generosF[$fpg]." De la Ruta ".$ruta->nombre;
			                        			$dataAux=$this->ConsultaPronosticoPasajerosGeneroRuta($ruta->ruta_id,$consulta->generosF[$fpg]);
				                        			array_push($label, $labelsAux);
		                                            array_push($stack, $cont);
				                        			array_push($data, $dataAux);
	    									}
	    									break;
	    							}
	    						}

	    					}
	    					else{//sin filtros de persona
	    						$labelsAux="Pasajeros De la Ruta ".$ruta->nombre;
                        		$dataAux=$this->ConsultaPronosticoPasajerosRuta($ruta->ruta_id);
                        			array_push($label, $labelsAux);
                                    array_push($stack, $cont);
                        			array_push($data, $dataAux);
	    					}
	    				}
	    				$cont++;
	    				break;
	    		}
	    	}
	    }
	    else{
	    	$labelsAux="Avca";
            array_push($label,$labelsAux);
            $dataAux=$this->ConsultaPronosticoPasajeros();
            array_push($label, $labelsAux);
            array_push($stack, $cont);
			array_push($data, $dataAux);
	    }
	    if(!$auxBanderaFiltro&&((count($consulta->filtros))>=1)){//solo filtros de persona
	    	for ($fp=0; $fp < count($consulta->filtrosP) ; $fp++) { 
				switch ($consulta->filtrosP[$fp]) {
					case 'Edad':
						for($fpe=0;$fpe<$consulta->edadesF;$fpe++){
                			$labelsAux="Pasajeros ".$consulta->edadesF[$fpe];
                			$dataAux=$this->ConsultaPronosticoPasajerosEdad($consulta->edadesF[$fpe]);
                			array_push($label, $labelsAux);
                            array_push($stack, $cont);
                			array_push($data, $dataAux);
	    					$cont++;
						}
						break;
					case 'Genero':
						for($fpg=0;$fpg<$consulta->generosF;$fpg++){
                			$labelsAux="Pasajeros ".$consulta->generosF[$fpg];
                			$dataAux=$this->ConsultaPronosticoPasajerosGenero($consulta->generosF[$fpg]);
                			array_push($label, $labelsAux);
                            array_push($stack, $cont);
                			array_push($data, $dataAux);
	    					$cont++;
						}
						break;
				}
			}
	    }

	   		// return response()->JSON($data[3]);
	   		// $data[9]=$this->HoltWinters($data[9],6);
	   		// return response()->JSON($data[9]);

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

	public function ConsultaPronosticoPasajerosEdadOrigen($origen,$edad){
		$datos=DW_Pasajero::OrigenEdadMuestra($origen,$edad);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosGeneroOrigen($origen,$genero){
		$datos=DW_Pasajero::GeneroOrigenMuestra($origen,$genero);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosOrigen($origen){
		$datos=DW_Pasajero::OrigenMuestra($origen);
		return $datos;
	}

	public function ConsultaPronosticoPasajerosEdadDestino($destino,$edad){
		$datos=DW_Pasajero::DestinoEdadMuestra($destino,$edad);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosGeneroDestino($destino,$genero){
		$datos=DW_Pasajero::GeneroDestinoMuestra($destino,$genero);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosDestino($destino){
		$datos=DW_Pasajero::DestinoMuestra($destino);
		return $datos;
	}

	public function ConsultaPronosticoPasajerosEdadRuta($ruta,$edad){
		$datos=DW_Pasajero::RutaEdadMuestra($ruta,$edad);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosGeneroRuta($ruta,$genero){
		$datos=DW_Pasajero::GeneroRutaMuestra($ruta,$genero);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosRuta($ruta){
		$datos=DW_Pasajero::RutaMuestra($ruta);
		return $datos;
	}

	public function ConsultaPronosticoPasajeros(){
		$datos=DW_Pasajero::Muestra();
		return $datos;
	}
	public function ConsultaPronosticoPasajerosEdad($edad){
		$datos=DW_Pasajero::EdadMuestra($edad);
		return $datos;
	}
	public function ConsultaPronosticoPasajerosGenero($genero){
		$datos=DW_Pasajero::GeneroMuestra($genero);
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
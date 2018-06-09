<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;

class PronosticoVuelosController extends Controller
{
    public function PanelPronosticar(Request $consulta){
    	return $consulta->all();
    	if((count($this->consulta->filtros))>=1){
	    	for ($f=0; $f < count($this->consulta->filtros) ; $f++) { 
	    		switch ($this->consulta->filtros[$f]) {
	    			case 'Origen':
	    				for ($o=0; $o < count($this->consulta->origenesF) ; $o++) { 
	    					$origen=DW_Sucursal::buscar($consulta->origenesF[$o]);
	                        $labelsAux="Origen ".$origen->nombre;
	                        array_push($labels,$labelsAux);
	                        $dataAux=$this->ConsultaPronosticoVuelosOrigen($origen->sucursal_id);
	                        array_push($data, $dataAux);
	    				}
	    				break;
	    			case 'Destino':
	    				for ($d=0; $d < count($this->consulta->destinosF) ; $d++) { 
	    					$destino=DW_Sucursal::buscar($consulta->destinosF[$d]);
	                        $labelsAux="Destino ".$destino->nombre;
	                        array_push($labels,$labelsAux);
	                        $dataAux=$this->ConsultaPronosticoVuelosDestino($destino->sucursal_id);
	                        array_push($data, $dataAux);
	    				}
	    				break;
	    			case 'Ruta':
	    				for ($r=0; $r < count($this->consulta->rutasF) ; $r++) { 
	    					$ruta=new stdClass();
	                        $ruta->nombre=$consulta->rutasF[$rF];
	                        $ruta->ruta_id=explode('.', $consulta->rutasF[$rF])[0];
	                        $labelsAux="Destino ".$ruta->nombre;
	                        array_push($labels,$labelsAux);
	                        $dataAux=$this->ConsultaPronosticoVuelosRuta($ruta->ruta_id);
	                        array_push($data, $dataAux);
	    				}
	    				break;
	    		}
	    	}
	    }
	    else{
	    	$labelsAux="Avca";
            array_push($labels,$labelsAux);
            $dataAux=$this->ConsultaPronosticoVuelos();
            array_push($data, $dataAux);
	    }
    } 
    public function ConsultaPronosticoVuelosOrigen($origen){
    	return "consulta pronostico vuelos origen";
    } 
    public function ConsultaPronosticoVuelosDestino($destino){
    	return "consulta vuelos destino";
    } 
    public function ConsultaPronosticoVuelosRuta($ruta){
    	return "consulta vuelos ruta";
    } 
    public function ConsultaPronosticoVuelos(){
    	return "consulta vuelos sin filtro";
    } 
}




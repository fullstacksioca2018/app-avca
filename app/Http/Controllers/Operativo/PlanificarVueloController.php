<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\operativo\Vuelo;
use App\Models\operativo\Ruta;
use App\Models\operativo\Tripulante;
use stdClass;

class PlanificarVueloController extends Controller
{
    public function vuelo(){
        return view('Operativo.Vuelo.vuelo');
    }

    public function vuelos(){           
      
     
        $obj = array();
        //$sucursales= Sucursal::orderBy('nombre','ASC')->get();
        $vuelos= Vuelo::orderBy('id')->get();
        foreach($vuelos as $vuelo){
            $objAux = new stdClass();  
            $segmentos = $vuelo->segmentos;
            foreach($segmentos as $segmento){
                $segmento->ruta;
            }
          //$vuelo->segmentos->aeronave;   
         // $vuelo->tripulantes; 
          $objAux->vuelo = $vuelo;
          array_push($obj,$objAux);
         
         
        }
        return $obj;

       
    }
}

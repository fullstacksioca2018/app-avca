<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\operativo\Vuelo;
use App\Models\operativo\Ruta;
use App\Models\operativo\Aeronave;
use App\Models\operativo\Tripulante;
use Carbon\Carbon;
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
               // $objAux2 = new stdClass();  
                $segmento->ruta;
               $segmento->aeronave;
                //array_push($objAux,$objAux2);
            } 
            
        
             foreach($vuelo->tripulantes as $tripulante){
           
                $tripulante->empleado;
                //$tripulante->empleado2->experiencia = 
                $tripulante->empleado->experiencia = $tripulante->HorasExperiencia($tripulante->id);
                
            }
            //$vuelo->tripulantes;  
          $objAux->vuelo = $vuelo;   
          array_push($obj,$objAux);
         
         
        }
        return $obj;

       
    }

    public function rutas(){
        $obj = array();
        //$sucursales= Sucursal::orderBy('nombre','ASC')->get();
        $rutas= Ruta::orderBy('id')->get();
        foreach($rutas as $ruta){
          $objAux = new stdClass();
        
         
         $ruta->origen;
         $ruta->destino;
       
         $objAux->ruta = $ruta;
          array_push($obj,$objAux);
         
         
        }
        return $obj;
    }

    public function pilotos(){
        $obj = array();
         
        $tripulantes = Tripulante::orderBy('id')->get();
        foreach($tripulantes as $tripulante){
            $objAux = new stdClass(); 
            $tripulante->empleado2 = $tripulante->HorasExperiencia($tripulante->id);
            $objAux->tripulante = $tripulante;   
            array_push($obj,$objAux);
        }
        return $obj;
    }
}

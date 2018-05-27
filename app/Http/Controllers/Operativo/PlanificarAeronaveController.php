<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\operativo\Aeronave;

use stdClass;

class PlanificarAeronaveController extends Controller
{
    public function __construct(){
        Carbon::setLocale('es');
        date_default_timezone_set('America/Caracas');
    }
    public function aeronave(){
        
        return view('Operativo.Aeronave.aeronave');
        
    }

    public function aeronaves(){
        $obj = array();
        $aeronaves= Aeronave::orderBy('id')->get();   
        $actual = Carbon::now();
        foreach($aeronaves as $aeronave){    
            $aeronave->aehm = Aeronave::HorasUso($aeronave->id,$actual->toDateTimeString());
            $aeronave->aehp = Aeronave::HorasPlanificadas($aeronave->id,$actual->toDateTimeString());
        }
        return $aeronaves;       
     
    }

    public function deshabilitar(Request $datos){   
        
        $aeronave =Aeronave::find($datos['id']);
        $aeronave->estado="mantenimiento";
        $aeronave->ultimo_mantenimiento = Carbon::now();
        $aeronave->save();
        return "La Ruta ha sido colocada en mantenimiento";
    }

    public function habilitar(Request $datos){        
        $aeronave =Aeronave::find($datos['id']);
        $aeronave->estado="activo";
        $aeronave->save();
        return "La Ruta ha sido colocada en mantenimiento";
    }

    public function modificar(Request $datos){
      

        $aeronave = Aeronave::find($datos['id']);
       
        $aeronave->matricula=$datos['matricula'];
        
        $aeronave->modelo=$datos['modelo'];
 
        $aeronave->capacidad_asientos=$datos['capacidad'];   

		

  
     
        
        //return $datos;
        $aeronave->save();
        return "La Aeronave Fue Actualizada Correctamente";
    }


}
?>
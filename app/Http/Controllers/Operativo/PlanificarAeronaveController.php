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

    public function guardar(Request $datos){
   
        $aeronave = new Aeronave();
        $aeronave->modelo = $datos['modelo'];      
        $aeronave->capacidad_asientos = $datos['capacidad'];
        $aeronave->matricula = $datos['matricula'];
        $aeronave->estado = 'activo';
        $aeronave->ultimo_mantenimiento = Carbon::now();
        $aeronave->capacidad_equipaje = "68";
        $aeronave->asiento_primera_clase = "20";
        $aeronave->asiento_economicos = "34";
        $aeronave->asiento_observacion = "10";
       
        $aeronave->save();
        return "se ha guardado exitosamente la aeronave";
       
    }


}
?>

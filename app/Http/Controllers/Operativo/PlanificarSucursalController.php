<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operativo\Sucursal;
use App\Models\Operativo\Ruta;

class PlanificarSucursalController extends Controller
{
    public function ruta(){
        return Sucursal::orderBy('nombre','ASC')->get();        
    }

    public function sucursal(){
        return view('Operativo.Sucursal.Sucursal');
    }

    public function deshabilitar(Request $datos){   
      
        $sucursal = Sucursal::find($datos['id']);
    
        $sucursal->estatus = 'inactiva';
     
        $sucursal->save();
     
        return "La sucursal ".$sucursal->nombre ." ha sido deshabilitada";

    }

    public function habilitar(Request $datos){   
      
        $sucursal = Sucursal::find($datos['id']);
    
        $sucursal->estatus = 'activa';
     
        $sucursal->save();
     
        return "La sucursal ".$sucursal->nombre ." ha sido deshabilitada";

    }

    public function modificar(Request $datos){
        $sucursal = Sucursal::find($datos['id']);
        $sucursal->nombre = $datos['Nombre'];
        $sucursal->sigla = $datos['Sigla'];
        $sucursal->ciudad = $datos['Ciudad'];
        $sucursal->save();
        return "La sucursal ".$sucursal->nombre ." ha sido actualizada";

    }

    public function guardar(Request $datos){
        $sucursal = new Sucursal();
        $sucursal->nombre = $datos['Nombre'];
        $sucursal->sigla = $datos['Siglas'];
        $sucursal->ciudad = $datos['Ciudad'];
        $sucursal->tipo_sucursal = "operativa";
        $sucursal->estatus = "activa";
        
        $sucursal->save();
        return "La sucursal ".$sucursal->nombre ." ha sido creada";
    }

    
}

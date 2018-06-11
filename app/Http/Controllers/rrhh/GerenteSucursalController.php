<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Grupo;
use Illuminate\Http\Request;
use App\Models\rrhh\Empleado;
use App\Http\Controllers\Controller;

class GerenteSucursalController extends Controller
{
    public function obtenerGrupos()
    {
        $grupos = Grupo::all();
        return response()->json($grupos, 200);
    }

    public function actualizarGrupo(Request $request, $grupo)
    {
        $empleado = Empleado::findOrFail($request->empleado_id);
        $empleado->grupo_id = $grupo;
        
        if ($empleado->save()) {
            return response()->json('Grupo actualizado', 200);
        }else {
            return response()->json('El grupo no pudo ser actualizado', 500);
        }

    }
}

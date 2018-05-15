<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Area;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Sucursal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerSucursales()
    {
        $data = Sucursal::all();
        return response()->json($data);
    }

    public function obtenerAreas()
    {
        $data = Area::all();
        return response()->json($data);
    }

    public function obtenerCargos($area_id)
    {
        $data = Cargo::where('area_id', $area_id)->get();
        return response()->json($data);
    }
}

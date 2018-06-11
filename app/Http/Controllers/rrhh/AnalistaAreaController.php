<?php

namespace App\Http\Controllers\rrhh;

use Illuminate\Http\Request;
use App\Models\rrhh\Empleado;
use App\Http\Controllers\Controller;

class AnalistaAreaController extends Controller
{
    public function empleados()
    {
        // Obtengo los datos del analista logueado
        $analista = Empleado::where('empleado_id', auth()->user()->id)->first();

        // Filtro los empleados por area
        $empleados = Empleado::where([
            ['estatus', 'activo'],
            ['area_id', $analista->area_id]
        ])->paginate();
        return view('rrhh.backend.analista_area.empleados', compact('empleados'));
    }
}

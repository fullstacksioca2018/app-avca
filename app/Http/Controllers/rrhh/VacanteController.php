<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Vacante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VacanteController extends Controller
{
    public function create()
    {
        return view('rrhh.backend.vacantes.create');
    }

    public function store(Request $request)
    {
        $vacante = new Vacante();
        $vacante->fecha_publicacion = Carbon::now();
        $vacante->sucursal_id = $request->sucursal;
        $vacante->area_id = $request->area;
        $vacante->cargo_id = $request->cargo;

        $vacante->save();

        return response()->json(['message' => 'Vacante publicada exitosamente!']);
    }
}

<?php

namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiControllerDW extends Controller
{
    public function listCargos()
    {
        $cargos = DB::table('cargos')
            ->join('tabuladores_salariales', 'cargos.tabulador_salarial_id', '=', 'tabuladores_salariales.tabulador_salarial_id')
            ->join('areas', 'cargos.area_id', '=', 'areas.area_id')
            ->select('tabuladores_salariales.sueldo_base', 'areas.nombre', 'cargos.*')
            ->get();
        return response()->json($cargos);
    }
}
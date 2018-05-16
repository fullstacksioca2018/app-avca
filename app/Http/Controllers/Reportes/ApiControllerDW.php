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
    public function ingresosProyeccion(Request $consulta){

    }
    /*
    
	a = 2(PMS) – PMD
	a = 2 (37.50) – 30 = 45
	a = 45
	b = n/n-1 (PMS – PMD)
	b = 15
	Paso 5
	ynov = a + b(x) = 45+15 (2) = 75 unidades
	ydic = a + b(x) = 45+15 (3) = 90 unidades
	yene = a + b(x) = 45+15 (4) = 105 unidades

     */
}
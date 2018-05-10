<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Aspirante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusquedaController extends Controller
{
    public function obtenerAspirantesPorCedula($cedula)
    {
        $aspirantes = Aspirante::where([
            ['cedula', 'LIKE', '%'.$cedula.'%'],
            ['estatus', '=', 'por contratar']
        ])
            ->get();

        return $aspirantes;
    }
}

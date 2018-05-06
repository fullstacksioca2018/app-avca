<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Area;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\TabuladorSalarial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    public function list()
    {
        $cargos = DB::table('cargos')
            ->join('tabuladores_salariales', 'cargos.tabulador_salarial_id', '=', 'tabuladores_salariales.tabulador_salarial_id')
            ->join('areas', 'cargos.area_id', '=', 'areas.area_id')
            ->select('tabuladores_salariales.sueldo_base', 'areas.nombre', 'cargos.*')
            ->get();
        return view('rrhh.backend.cargos.list', compact('cargos'));
    }

    public function edit($id)
    {
        $cargo = DB::table('cargos')
            ->join('tabuladores_salariales', 'cargos.tabulador_salarial_id', '=', 'tabuladores_salariales.tabulador_salarial_id')
            ->join('areas', 'cargos.area_id', '=', 'areas.area_id')
            ->select('tabuladores_salariales.sueldo_base', 'areas.nombre', 'cargos.*')
            ->where('cargo_id', $id)
            ->get();

        return view('rrhh.backend.cargos.edit', compact('cargo'));
    }
    public function update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->perfil = $request->perfil;
        $cargo->save();

        return redirect()->route('cargo.list');
    }
}

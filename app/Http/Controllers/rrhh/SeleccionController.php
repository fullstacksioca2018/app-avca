<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Aspirante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SeleccionController extends Controller
{
    public function index()
    {
        return view('rrhh.backend.captacion.seleccion.list');
    }

    public function obtenerAspirantes(Request $request)
    {
        $sucursal_id = $request->sucursal_id;
        $area_id = $request->area_id;
        $cargo_id = $request->cargo_id;

        $aspirantes = DB::table('sucursales')
            ->join('vacantes', 'sucursales.sucursal_id', '=', 'vacantes.sucursal_id')
            //->join('areas', 'vacantes.area_id', '=', 'areas.area_id')
            ->join('aspirantes', 'vacantes.vacante_id', '=', 'aspirantes.vacante_id')
            ->where([
                ['sucursales.sucursal_id', $sucursal_id],
                ['vacantes.area_id', $area_id],
                ['vacantes.cargo_id', $cargo_id],
                ['aspirantes.estatus', $request->estatus]
            ])            
            //->where([
                //['aspirantes.sucursal_id', '=', $sucursal_id],
                //['vacantes.area_id', '=', $area_id],
                //['vacantes.cargo_id', '=', $cargo_id]
            //])
            ->get();
        return $aspirantes;
    }

    public function obtenerAspirantesEstatus($estatus)
    {
        $aspirantes = Aspirante::where('estatus', $estatus)->get();

        return $aspirantes;
    }

    public function cambiarEstatus(Request $request)
    {
        $aspirante = Aspirante::findOrFail($request->aspirante_id);
        $aspirante->estatus = $request->estatus;
        $aspirante->save();

        $aspirantes = [];

        //return $request->estatus;
        //return response()->json([], 201);
        switch ($request->estatus) {
            case 'verificados':
                $aspirantes = $this->obtenerAspirantesEstatus('registrados');
                break;
            case 'convocados':
                $aspirantes = $this->obtenerAspirantesEstatus('verificados');
                break;
            case 'entrevistados':
                $aspirantes = $this->obtenerAspirantesEstatus('convocados');
                break;
            case 'seleccionados':
                $aspirantes = $this->obtenerAspirantesEstatus('entrevistados');
                break;
        }
        return $aspirantes;
    }
}

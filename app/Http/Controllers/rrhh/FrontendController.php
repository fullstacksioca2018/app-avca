<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Area;
use App\Models\rrhh\Aspirante;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Vacante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $areas = Area::all();
        $vacantes = Vacante::all();
        $vacantes = $vacantes->unique('area_id');

        return view('rrhh.frontend.home', compact('areas', 'vacantes'));
    }

    public function obtenerCargos($slug)
    {
        $vacantes = DB::table("cargos")
            ->join("areas", "areas.area_id", "=", "cargos.area_id")
            ->join("vacantes", "vacantes.cargo_id", "=", "cargos.cargo_id")
            ->join('sucursales', "sucursales.sucursal_id", "=", "vacantes.sucursal_id")
            ->where([
                ["areas.slug", "=", $slug],
                ["vacantes.estatus", "=", "activa"]
            ])
            /*->where("areas.slug", "=", $slug)
            ->orWhere("cargos.cargo_id", "=", "vacantes.cargo_id")*/
            ->select("cargos.*", "vacantes.*", "sucursales.*")
            ->get();

        return view('rrhh.frontend.offers', [
            'vacantes' => $vacantes,
            'area' => $slug
        ]);
    }

    /**
     * @param $vacante_id
     * @param $cargo_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra el perfil del cargo en funcion de la vacante y el cargo
     */
    public function verPerfil($vacante_id, $cargo_id)
    {
        $cargo = Cargo::findOrFail($cargo_id);
        //dd($cargo);

        return view('rrhh.frontend.profile', compact('cargo', 'vacante_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Registra solicitud del aspirante desde el frontend
     */
    public function registrarAspirante(Request $request)
    {
        $aspirante = new Aspirante($request->all());

        $aspirante->curriculum = $request->file('curriculum')->getClientOriginalName();
        if ($aspirante->save()) {
            // Almaceno el pdf subido
            if ($request->hasFile('curriculum')) {
                Storage::put('aspirantes', $request->curriculum);
            }
        }

        alert()->success('Registro exitoso', 'Solicitud registrada')->autoclose(3000);

        return redirect()->route('home');
    }
}

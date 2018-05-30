<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Area;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Vacante;
use Illuminate\Http\Request;
use App\Models\rrhh\Sucursal;
use App\Models\rrhh\Aspirante;
use App\Models\rrhh\Entrevista;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\rrhh\ConvocatoriaEnviada;
use Illuminate\Support\Facades\Validator;

class AspiranteController extends Controller
{
    public function obtenerAreasVacantes()
    {
        $vacantes = db::table('vacantes')
            ->join('cargos', 'vacantes.cargo_id', '=', 'cargos.cargo_id')
            ->join('sucursales', 'vacantes.sucursal_id','=','sucursales.sucursal_id')
            ->join('areas', 'cargos.area_id','=','areas.area_id')

            ->select('cargos.titulo','sucursales.nombre','vacantes.*','areas.nombre as nombre_a')
            ->where('areas.slug','=','administrativa')->get();

        return view('rrhh.backend.captacion.seleccion.areas-list', compact('vacantes'));
    }

    /**
     * @param $vacante
     * @param $estatus
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Muestra listado de aspirantes segun la vacante al cargo y el estatus
     */
    public function obtenerAspirantes($vacante, $estatus)
    {
        $aspirantes = Aspirante::orderBy('aspirante_id', 'DESC')
                        ->where([
                            ['vacante_id', $vacante],
                            ['estatus', $estatus]
                        ])
                        ->get();

        return view('rrhh.backend.captacion.seleccion.aspirantes-list', compact('aspirantes', 'vacante', 'estatus'));
    }

    // Metodos para consultas con AJAX
    public function aspirantesPorEstatus(Request $request)
    {        
        $aspirantes = Aspirante::where([
            ['vacante_id', '=', $request->vacante],
            ['estatus', '=', $request->estatus]
        ])
        ->get();        
        return response()->json([$aspirantes, $request->estatus]);
    }

    public function cambiarEstatus(Request $request)
    {
        $aspirante = Aspirante::findOrFail($request->aspirante);

        $aspirante->estatus = $request->estatus;
        
        $aspirante->save();

        $aspirantes = Aspirante::where([
            ['vacante_id', '=', $request->vacante],
            ['estatus', '=', $request->estatus]
        ])
        ->get();        
        return response()->json([$aspirantes, $request->estatus]);
    }

    public function enviarConvocatoria(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'lugar' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'recaudos' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['isValid' => false, 'errors' => $validator->messages()]);
        }

        $data = $request->all();

        //Mail::to($request->email)->send(new ConvocatoriaEnviada($data));

        $aspirante = Aspirante::findOrFail($request->aspirante_id);
        $aspirante->estatus = 'convocados';
        $aspirante->save();

        $aspirantes = Aspirante::where([
            ['vacante_id', '=', $request->vacante],
            ['estatus', '=', $request->estatus]
        ])
        ->get();        
        return response()->json([$aspirantes, $request->estatus]);
    }

    public function guardarEntrevista(Request $request)
    {        
        $entrevista = new Entrevista($request->except('vacante'));        

        if ($entrevista->save()) {
            $aspirante = Aspirante::findOrFail($request->aspirante_id);
            $aspirante->estatus = 'entrevistados';
            $aspirante->save();
            
            $aspirantes = Aspirante::where([
                ['vacante_id', '=', $request->vacante],
                ['estatus', '=', $request->estatus]
            ])
            ->get();        
            return response()->json([$aspirantes, $request->estatus]);
        }
        else {
            return response()->json(['isValid' => false], 500);
        }        

    }

    public function obtenerDatosEntrevista($aspirante_id)
    {
        //return $aspirante_id;
        $entrevista  = Entrevista::where('aspirante_id', '=', $aspirante_id)->first();
        
        return response()->json($entrevista);
    }
}

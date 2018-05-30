<?php

namespace App\Http\Controllers\rrhh;

use Validator;
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

class SeleccionController extends Controller
{
    public function listadoCargosVacante()
    {   
        $vacantes = DB::table("cargos")
            ->join("areas", "areas.area_id", "=", "cargos.area_id")
            ->join("vacantes", "vacantes.cargo_id", "=", "cargos.cargo_id")
            ->join('sucursales', "sucursales.sucursal_id", "=", "vacantes.sucursal_id")
            ->where([
                //["areas.area_id", "=", 1],
                ["vacantes.estatus", "=", "activa"]
            ])
            /*->where("areas.slug", "=", $slug)
            ->orWhere("cargos.cargo_id", "=", "vacantes.cargo_id")*/
            ->select("cargos.*", "vacantes.*", "sucursales.*")
            ->get();
        

        return $vacantes;        


        $data = [];
        $area = Area::findOrFail(1);
        //return $area->cargos;
        $vacantes = Vacante::all();

        foreach ($area->cargos as $cargo) {
            foreach ($vacantes as $vacante) {
                if ($vacante->cargo_id === $cargo->cargo_id && $vacante->estatus === 'activa') {
                    $data = [
                        'cargo' => $cargo->titulo,
                        'f_pub' => $vacante->fecha_publicacion
                    ];
                }
            }
        }
        return $data;
        return $area->cargos;

        
    }

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
            case 'por contratar':
                $aspirantes = $this->obtenerAspirantesEstatus('seleccionados');
                break;
        }
        return $aspirantes;
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

        Mail::to($request->email)->send(new ConvocatoriaEnviada($data));

        $aspirante = Aspirante::findOrFail($request->aspirante_id);
        $aspirante->estatus = 'convocados';
        $aspirante->save();

        $aspirantes = $this->obtenerAspirantesEstatus('verificados');

        return $aspirantes;
    }

    public function guardarEntrevista(request $request)
    {
        $entrevista = new Entrevista($request->all());

        if ($entrevista->save()) {
            $aspirante = Aspirante::findOrFail($request->aspirante_id);
            $aspirante->estatus = 'entrevistados';
            $aspirante->save();

            $aspirantes = $this->obtenerAspirantesEstatus('convocados');

            return $aspirantes;
        } else {
            return response()->json(['isValid' => false], 500);
        }

    }

    public function obtenerDatosEntrevista($aspirante_id)
    {
        //return $aspirante_id;
        $entrevista  = Entrevista::where('aspirante_id', '=', $aspirante_id)->first();

        return $entrevista;
    }
}

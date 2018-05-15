<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Aspirante;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Departamento;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Profesion;
use App\Models\rrhh\Sucursal;
use App\Models\rrhh\TabuladorSalarial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ContratacionController extends Controller
{
    public function formContratacion()
    {
        //$aspirante = Aspirante::where('cedula', $request->cedula)->first();
        //if($request->aspirante_id !== null) return $aspirante;
        return view('rrhh.backend.captacion.contratacion.contratacion');
    }

    public function procesarContratacion(Request $request)
    {
        $empleado = new Empleado($request->all());
        $empleado->foto = $request->file('foto')->hashName();

        if ($empleado->save()) {
            // Guardando el archivo de la foto
            if ($request->hasFile('foto')) {
                Storage::disk('public')->put('empleados/' . $request->cedula . '/foto/', $request->file('foto'));
            }

            // Elimino el aspirante de la tabla aspirantes
            $aspirante = Aspirante::where('cedula', $request->cedula)->first();
            $aspirante->delete();

            // Generando el contrato en pdf
            //$datosEmpleado = $request->all();
            //$this->generarContrato($datosEmpleado);
            return response()->json();
        }
    }

    public function generarContrato($datosEmpleado)
    {

    }

    public function obtenerAspiranteInfo($aspirante_id)
    {
        $aspirante = Aspirante::findOrFail($aspirante_id);

        return $aspirante;
    }

    public function obtenerEstados()
    {
        $estados = Storage::get('public/json/venezuela.json');
        return $estados;
    }

    public function obtenerProfesiones(Request $request)
    {
        //return $request->nivel_academico;
        $profesiones = Profesion::where('nivel_academico', '=', 'especialista 1')->get();
        //return $profesiones;
        return response()->json($profesiones);
        //return "Hola";
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerSucursales()
    {
        $data = Sucursal::all();
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerDepartamentos()
    {
        $data = Departamento::all();
        return response()->json($data);
    }

    public function obtenerCargos()
    {
        $cargos = Cargo::all();
        return response()->json($cargos);
    }

    public function obtenerTabuladorSalarial(Request $request)
    {
        $tabulador = TabuladorSalarial::where('tabulador_salarial_id', $request->tabulador_salarial_id)->get();
        return response()->json($tabulador);
    }

    public function obtenerBancos()
    {
        $bancos = Storage::get('public/json/bancos.json');
        return $bancos;
    }
}

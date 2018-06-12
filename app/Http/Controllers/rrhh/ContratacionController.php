<?php

namespace App\Http\Controllers\rrhh;

use App\User;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Vacante;
use Illuminate\Http\Request;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Sucursal;
use App\Models\rrhh\Aspirante;
use App\Models\rrhh\Profesion;
use App\Models\rrhh\Departamento;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\operativo\Tripulante;
use App\Models\rrhh\TabuladorSalarial;
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
        $empleado = new Empleado($request->except(['nombre_cargo']));        

        $empleado->cuenta_bancaria = $request->codigo_cuenta.$request->cuenta_bancaria;

        if ($request->hasFile('foto')) {            
            $empleado->foto = $request->file('foto')->hashName();
        }        

        if ($empleado->save()) {            
            // Guardando el archivo de la foto
            if ($request->hasFile('foto')) {
                Storage::disk('public')->put('empleados/' . $request->cedula . '/foto/', $request->file('foto'));
            }

            // Obteniendo el empleado recien ingresado
            $empleado_registrado = Empleado::latest()->first();            

            // Guardando datos en la tabla tripulantes si el cargo del empleado es tripulante
            /* if ($request->area_id == 6 && $request->nombre_cargo != 'Analista de Talento Humano Área Tripulación') { 
                $tripulante = new Tripulante;
                $tripulante->rango = strtolower($request->nombre_cargo);
                $tripulante->licencia = $empleado_registrado->licencia;
                $tripulante->personal_id = $empleado_registrado->empleado_id;

                $tripulante->save();
            } */

            // Guardando datos a la tabla users
            $user = new User;
            $user->name = $empleado_registrado->nombre . ' ' . $empleado_registrado->apellido;
            $user->modulo = 'rrhh';
            $user->email = $empleado_registrado->email;
            $user->password = bcrypt(substr($empleado_registrado->cedula, -4));

            $user->save();


            // Elimino el aspirante de la tabla aspirantes
            $aspirante = Aspirante::where('cedula', $request->cedula)->first();
            $aspirante->delete();            

            return response()->json();
        }
    }

    // Muestra el listad de empleados junto a boton para generar el contrato en pdf
    public function listarEmpleados()
    {
        $empleados = Empleado::where('estatus', 'activo')->get();
        return view('rrhh.backend.captacion.contratacion.contrato', compact('empleados'));
    }

    // Genera el contrato en pdf
    public function generarContratoPdf(Empleado $empleado)
    {  
        $pdf = PDF::loadView('rrhh.backend.pdf.contrato', ['empleado' => $empleado]);        

        return $pdf->download($empleado->cedula.'.pdf');
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
        $profesiones = Profesion::where('nivel_academico', '=', $request->nivel_academico)->get();
        //return $profesiones;
        return response()->json($profesiones);
        //return "Hola";
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerSucursal(Request $request)
    {
        $vacante = Vacante::where('vacante_id', $request->vacante_id)->first();

        $sucursal = Sucursal::where('sucursal_id', $vacante->sucursal_id)->first();

        return response()->json($sucursal);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerDepartamentos()
    {
        $data = Departamento::all();
        return response()->json($data);
    }

    public function obtenerCargo(Request $request)
    {
        $cargo = Cargo::where('cargo_id', $request->cargo_id)->first();
        return response()->json($cargo);
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

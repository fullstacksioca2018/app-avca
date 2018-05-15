<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Empleado;
use App\Models\rrhh\Expediente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function obtenerExpedientes($empleado_id)
    {
        $expedientes = Expediente::where('empleado_id', $empleado_id)->get();

        return response()->json($expedientes);
    }

    public function guardarExpediente(Request $request)
    {
        $expediente = new Expediente($request->all());

        $expediente->fecha = Carbon::now()->toDateString();

        $expediente->soporte_pdf = $request->file('soporte_pdf')->hashName();

        $empleado = Empleado::findOrFail($request->empleado_id);

        if ($expediente->save()) {
            // Guardando el archivo de la foto
            if ($request->hasFile('soporte_pdf')) {
                Storage::disk('public')->put('empleados/' . $empleado->cedula . '/expediente/', $request->file('soporte_pdf'));
            }

            return response()->json();
        }
    }
}

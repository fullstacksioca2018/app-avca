<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Asistencia;
use App\Models\rrhh\CalendarioFeriado;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Grupo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function registrarIngreso()
    {
        return view('rrhh.backend.asistencia.asistencia');
    }

    public function obtenerEmpleado($codigo)
    {
        //$empleado = Empleado::where('cedula', $codigo)->first();
        $empleado = DB::table('empleados')
            ->join('sucursales', 'sucursales.sucursal_id', '=', 'empleados.sucursal_id')
            ->join('cargos', 'cargos.cargo_id', '=', 'empleados.cargo_id')
            ->join('departamentos', 'departamentos.departamento_id', '=', 'empleados.departamento_id')
            ->select('empleados.*', 'sucursales.nombre as nombre_sucursal', 'cargos.titulo as nombre_cargo', 'departamentos.descripcion as nombre_departamento')
            ->where('empleados.cedula', '=', $codigo)
            ->first();

        //  Inicio del proceso de guardado en la tabla "asistencias"

        // 1. verificar si existe un registro del empleado en la tabla asistencias con (fecha== fecha_actual_computador) y una h_entrada
        $empleado_id = $empleado->empleado_id;
        $fecha = Carbon::now();
        $fecha_actual = $fecha->format('Y-m-d');
        $hora_actual = $fecha->toTimeString();  // Hora entrada - Hora salida

        $asistencia = Asistencia::where([
            ['fecha', $fecha_actual],
            ['empleado_id', $empleado_id]
        ])->first();

        // Si cumple la condicion de busqueda...
        if (count($asistencia) > 0) {

            return response()->json($empleado, 200);
            // Obtenemos la jornada basado en el grupo del empleado
            $jornada = $this->obtener_jornada($empleado->grupo_id);

            // Obtenemos la hora de entrada del empleado en la tabla asistencias
            $hora_entrada = $asistencia->h_entrada;

            // Metodo que calcula la diff de horas
            return $this->calcular_diff_horas($hora_entrada, $hora_actual);


            // Se debe actualizar el registro del empleado
            /*$asistencia->update([
                'h_salida' => $hora_actual,
                'h_extras_diurnas' => 0,
                'h_faltantes_diurnas' => 0,
                'h_extras_nocturnas' => 0,
                'h_faltantes_nocturnas' => 0,
                'h_extras_diurnas_feriado' => 0,
                'h_faltantes_diurnas_feriado' => 0,
                'h_extras_nocturnas_feriado' => 0,
                'h_faltantes_nocturnas_feriado' => 0,
                'empleado_id' => $empleado_id
            ]);*/
        }

        // Verificamos si la fecha es o no feriada
        $fecha_feriada = $this->fecha_feriada($fecha_actual);

        //return response()->json($fecha_feriada);


        // Se procede a registrar el ingreso del empleado en la tabla asistencias
        $data_asistencia = Asistencia::create([
            'fecha' => $fecha_actual,
            'h_entrada' => $hora_actual,
            'h_salida' => null,
            'dia_feriado' => $fecha_feriada == false ? 0 : 1,   // Si es cero la fecha no es feriada sino si lo es
            'h_extras_diurnas' => 0,
            'h_faltantes_diurnas' => 0,
            'h_extras_nocturnas' => 0,
            'h_faltantes_nocturnas' => 0,
            'h_extras_diurnas_feriado' => 0,
            'h_faltantes_diurnas_feriado' => 0,
            'h_extras_nocturnas_feriado' => 0,
            'h_faltantes_nocturnas_feriado' => 0,
            'empleado_id' => $empleado_id
        ]);

        return response()->json($empleado, 200);
    }


    /**
     * @param $fecha
     * @return bool
     */
    public function fecha_feriada($fecha)
    {
        $calendario_feriado = CalendarioFeriado::where('fecha_feriado', $fecha)->get();

        if (count($calendario_feriado) > 0) return true;
        else return false;
    }

    /**
     * @param $grupo_id
     * @return mixed
     */
    public function obtener_jornada($grupo_id)
    {
        $grupo = Grupo::findOrFail($grupo_id);

        return $grupo;
    }

    public function calcular_diff_horas($hora_entrada, $hora_salida)
    {
        $arr_entrada = explode(":", $hora_entrada);
        $arr_salida = explode(":", $hora_salida);

        $hora_entrada = Carbon::createFromTime($arr_entrada[0], $arr_entrada[1], $arr_entrada[2]);
        $hora_salida = Carbon::createFromTime($arr_salida[0], $arr_salida[1], $arr_salida[2]);

        $diff_horas = $hora_salida->diffInRealHours($hora_entrada);

        return $diff_horas;
    }
}

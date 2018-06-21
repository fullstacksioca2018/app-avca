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

    /**
     * Obtiene registro del empleado por su cedula
     */
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

        $empleado_id = $empleado->empleado_id;

        /**
         *  Obtenemos los datos de las fechas
         * [0] => fecha actual
         * [1] => hora actual
         */
        $fecha = $this->obtenerFechas();

        // Verificamos si la fecha es o no feriada
        $fecha_feriada = $this->fecha_feriada($fecha[0]);

        // Obtenermos la asistencia del empleado que esta ingresando en el dia
        $asistencia = $this->obtenerAsistencia($empleado_id, $fecha[0]);

        if ($asistencia == '') {            
            $this->registrarAsistencia($fecha, $fecha_feriada, $empleado_id);

            return response()->json([$empleado, $asistencia], 200);
        } else {
            // El usuario esta marcando la hora de salida

            // Obtenemos la jornada basado en el grupo del empleado (Tabla Grupos)
            $jornada = $this->obtener_jornada($empleado->grupo_id);            

            // Obtenemos la hora de entrada del empleado en la tabla asistencias
            $hora_entrada = $asistencia->h_entrada;

            // Metodo que calcula la diff de horas (hora salida - hora entrada)
            $diff_horas = $this->calcular_diff_horas($hora_entrada, $fecha[1]);

            if ($diff_horas === $jornada->horas_jornada) {
                // Cumplio su horario cabalmente, y se guarda todo en cero
                // Se debe actualizar el registro del empleado
                $this->actualizarAsistencia($asistencia, $jornada, $diff_horas, $fecha, $empleado_id);
                
            } elseif ($diff_horas < $jornada->horas_jornada) {
                // Si entra aqui significa que no cumplio toda la jornada...
                
                if ($jornada->tipo_grupo === 'A') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
                        'h_extras_diurnas' => 0,
                        'h_faltantes_diurnas' => $asistencia->dia_feriado === 0 ? $jornada->horas_jornada - $diff_horas : 0,
                        'h_extras_nocturnas' => 0,
                        'h_faltantes_nocturnas' => 0,
                        'h_extras_diurnas_feriado' => 0,
                        'h_faltantes_diurnas_feriado' => $asistencia->dia_feriado === 1 ? $jornada->horas_jornada - $diff_horas : 0,
                        'h_extras_nocturnas_feriado' => 0,
                        'h_faltantes_nocturnas_feriado' => 0,
                        'empleado_id' => $empleado_id
                    ]);
                }

                if ($jornada->tipo_grupo === 'B') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
                        'h_extras_diurnas' => 0,
                        'h_faltantes_diurnas' => $asistencia->dia_feriado === 0 ? $jornada->horas_jornada - $diff_horas : 0,
                        'h_extras_nocturnas' => 0,
                        'h_faltantes_nocturnas' => 0,
                        'h_extras_diurnas_feriado' => 0,
                        'h_faltantes_diurnas_feriado' => $asistencia->dia_feriado === 1 ? $jornada->horas_jornada - $diff_horas : 0,
                        'h_extras_nocturnas_feriado' => 0,
                        'h_faltantes_nocturnas_feriado' => 0,
                        'empleado_id' => $empleado_id
                    ]);
                }

                if ($jornada->tipo_grupo === 'C') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
                        'h_extras_diurnas' => 0,
                        'h_faltantes_diurnas' => 0,
                        'h_extras_nocturnas' => 0,
                        'h_faltantes_nocturnas' => $asistencia->dia_feriado === 0 ? $jornada->horas_jornada - $diff_horas : 0,
                        'h_extras_diurnas_feriado' => 0,
                        'h_faltantes_diurnas_feriado' => 0,
                        'h_extras_nocturnas_feriado' => 0,
                        'h_faltantes_nocturnas_feriado' => $asistencia->dia_feriado === 1 ? $jornada->horas_jornada - $diff_horas : 0,
                        'empleado_id' => $empleado_id
                    ]);
                }
            } else {
                // Este es el caso cuando el empleado ha trabajados horas extras
                if ($jornada->tipo_grupo === 'A') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
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
                }

                if ($jornada->tipo_grupo === 'B') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
                        'h_extras_diurnas' => $asistencia->dia_feriado === 0 ? $diff_horas - $jornada->horas_jornada : 0,
                        'h_faltantes_diurnas' => 0,
                        'h_extras_nocturnas' => 0,
                        'h_faltantes_nocturnas' => 0,
                        'h_extras_diurnas_feriado' => $asistencia->dia_feriado === 1 ? $diff_horas - $jornada->horas_jornada : 0,
                        'h_faltantes_diurnas_feriado' => 0,
                        'h_extras_nocturnas_feriado' => 0,
                        'h_faltantes_nocturnas_feriado' => 0,
                        'empleado_id' => $empleado_id
                    ]);
                }

                if ($jornada->tipo_grupo === 'C') {
                    $asistencia->update([
                        'h_salida' => $fecha[1],
                        'h_extras_diurnas' => 0,
                        'h_faltantes_diurnas' => 0,
                        'h_extras_nocturnas' => $asistencia->dia_feriado === 0 ? $diff_horas - $jornada->horas_jornada : 0,
                        'h_faltantes_nocturnas' => 0,
                        'h_extras_diurnas_feriado' => 0,
                        'h_faltantes_diurnas_feriado' => 0,
                        'h_extras_nocturnas_feriado' => $asistencia->dia_feriado === 1 ? $diff_horas - $jornada->horas_jornada : 0,
                        'h_faltantes_nocturnas_feriado' => 0,
                        'empleado_id' => $empleado_id
                    ]);
                }
            }

            // Retorna los datos del empleado
            return response()->json([$empleado, $asistencia], 200);
        }
    }

    /**
     * Obtenemos la fecha y hora actual del sistema
     */
    public function obtenerFechas()
    {        
        //$empleado_id = $empleado->empleado_id;
        $fecha = Carbon::now();
        $fecha_actual = $fecha->format('Y-m-d');
        $hora_actual = $fecha->toTimeString();  // Hora entrada - Hora salida

        $arr_fechas = [$fecha_actual, $hora_actual];

        return $arr_fechas;
    }

    /**
     * Obtenemos el registro de asistencia del empleado
     */
    public function obtenerAsistencia($empleado_id, $fecha_actual)
    {                
        $asistencia = Asistencia::where([
            ['fecha', $fecha_actual],
            ['empleado_id', $empleado_id]
        ])->first();

        return $asistencia;
    }

    public function registrarAsistencia($fecha, $fecha_feriada, $empleado_id)
    {
        // Se procede a registrar el ingreso del empleado en la tabla asistencias
        $data_asistencia = Asistencia::create([
            'fecha' => $fecha[0],
            'h_entrada' => $fecha[1],
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

        return $hora_salida->diffInRealHours($hora_entrada);        
    }    
}

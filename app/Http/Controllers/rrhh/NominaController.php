<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\CargaFamiliar;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Nomina;
use App\Models\rrhh\TabuladorSalarial;
use App\Models\rrhh\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class NominaController extends Controller
{
    public function generarNominas()
    {
        return view('rrhh.backend.nomina.generate');
    }

    public function obtenerNominas()
    {
        $nominas = Nomina::all();

        return response()->json($nominas);
    }

    public function procesarNomina(Request $request)
    {
        $asignaciones = count($request->asignaciones) > 0 ? $request->asignaciones : [];
        $deducciones = count($request->deducciones) > 0 ? $request->deducciones : [];

        $conceptos = array_merge($asignaciones, $deducciones);

        $nomina = Nomina::findOrFail($request->nombre);

        $nomina->conceptos()->attach($conceptos);

        // Obtener todos los empleados
        $empleados = Empleado::all();

        foreach ($empleados as $empleado) {
            $sueldo_basico = $this->calculoSueldoBase($empleado);

            $num_hijos = $this->calculoNumHijos($empleado);

            foreach ($empleado->conceptos as $concepto_empleado) {
                foreach ($nomina->conceptos as $concepto_nomina) {
                    if ($concepto_empleado->concepto_id === $concepto_nomina->concepto_id) {
                        switch ($concepto_nomina->tipo_concepto) {
                            case 101:
                                $sueldo_basico = $sueldo_basico;
                                $monto = $sueldo_basico;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 103:
                                $antiguedad = $this->calcularAntiguedad($empleado->fecha_ingreso);
                                $prima_antiguedad = $sueldo_basico * $antiguedad * ($concepto_nomina->porcentaje/100);
                                $monto = $prima_antiguedad;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 105:
                                $prima_hijos = $concepto_nomina->valor_fijo * $num_hijos;
                                $monto = $prima_hijos;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 107:
                                $bono_asistencia_perfecta = $concepto_nomina->valor_fijo;
                                $monto = $bono_asistencia_perfecta;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 109:
                                $bono_riesgo = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $bono_riesgo;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 111:
                                $hora_vuelo_piloto = $concepto_nomina->valor_fijo;
                                $monto = $hora_vuelo_piloto;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 113:
                                $hora_vuelo_oficial_copiloto = $concepto_nomina->valor_fijo;
                                $monto = $hora_vuelo_oficial_copiloto;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 115:
                                $hora_vuelo_sobrecargo = $concepto_nomina->valor_fijo;
                                $monto = $hora_vuelo_sobrecargo;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 117:
                                $prima_hogar = $concepto_nomina->valor_fijo;
                                $monto = $prima_hogar;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 119:
                                $prima_profesionalizacion_tsu = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $prima_profesionalizacion_tsu;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 121:
                                $prima_profesionalizacion_grado = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $prima_profesionalizacion_grado;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 123:
                                $prima_profesionalizacion_magister = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $prima_profesionalizacion_magister;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 125:
                                $prima_profesionalizacion_doctorado = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $prima_profesionalizacion_doctorado;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 127:
                                $bono_productividad = $concepto_nomina->valor_fijo;
                                $monto = $bono_productividad;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 129:
                                $media_hora_resposo_comida = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $media_hora_resposo_comida;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 502:
                                $aporte_seguro_social_obligatorio = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $aporte_seguro_social_obligatorio;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 504:
                                $aporte_paro_forzoso = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $aporte_paro_forzoso;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 506:
                                $aporte_faov = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $aporte_faov;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 508:
                                $embargo_judicial = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $embargo_judicial;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 510:
                                $descuento_dia_ausencia = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $descuento_dia_ausencia;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 512:
                                $descuento_hora_ausencia = ($concepto_nomina->porcentaje/100) * $sueldo_basico;
                                $monto = $descuento_hora_ausencia;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                        }
                    }
                }
            }
        }
        // Elimina la tabla pivote concepto-nomina
        $nomina->conceptos()->detach($conceptos);

        return response()->json('success');

    }

    // Calculo de sueldo base
    public function calculoSueldoBase($empleado)
    {        
        $cargo = Cargo::findOrFail($empleado->cargo_id);
        $tabulador_salarial = TabuladorSalarial::findOrFail($cargo->tabulador_salarial_id);
        return $tabulador_salarial->sueldo_base;
    }

    //  Calculo de numero de hijos
    public function calculoNumHijos($empleado)
    {
        $num_hijos = CargaFamiliar::where('empleado_id', $empleado->empleado_id)
            ->where('parentesco', 'hijos')
            ->count();
        return $num_hijos;
    }

    public function calcularAntiguedad($fecha_ingreso)
    {
        $antiguedad = Carbon::createFromFormat('Y-m-d', $fecha_ingreso)->age;
        return $antiguedad;
    }

    public function registrarVoucher($empleado, $concepto_nomina, $nomina, $monto)
    {
        Voucher::create([
            'empleado_id' => $empleado->empleado_id,
            'concepto_id' => $concepto_nomina->concepto_id,
            'nomina_id' => $nomina->nomina_id,
            'monto' => $monto,
            'fecha' => Carbon::now()
        ]);
    }

    /**
     *  consulta de nomina
     */
    public function consultarNomina()
    {
        return view('rrhh.backend.nomina.consult');
    }

    public function obtenerVouchers(Request $request)
    {
        //return $request->nomina;

        $vouchers = Voucher::whereMonth('fecha', $request->fecha)
                    ->where('nomina_id', $request->nomina)
                    ->get();

        return response()->json($vouchers);
    }
}

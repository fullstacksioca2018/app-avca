<?php

namespace App\Http\Controllers\rrhh;

use Carbon\Carbon;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Nomina;
use App\Models\rrhh\Voucher;
use Illuminate\Http\Request;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Asistencia;
use App\Models\rrhh\CargaFamiliar;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\rrhh\TabuladorSalarial;

class NominaController extends Controller
{
    public function empleados()
    {
        // Filtro los empleados por area
        $empleados = Empleado::where([
            ['estatus', 'activo'],            
        ])->paginate();
        return view('rrhh.backend.nomina.empleados', compact('empleados'));
    }

    public function generarNominas()
    {
        return view('rrhh.backend.nomina.generate');
    }

    public function verNominasGeneradas()
    {
        return view('rrhh.backend.nomina.nominas_generadas');
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
            $anios_servicio = $this->calcularAniosServicio($empleado);
            $prima_antiguedad = $this->calcularAntiguedad($sueldo_basico, $anios_servicio);

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
                            case 520:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_extra_diurna = $hora_diurna * 1.5;
                                $calculo_horas = $this->calculoHoras($empleado);                                 
                                $monto = $calculo_horas['horas_extras_diurnas'] * $hora_extra_diurna;
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 521:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;                                  
                                $calculo_horas = $this->calculoHoras($empleado);                                
                                $monto = $calculo_horas['horas_faltantes_diurnas'] * $hora_diurna;                                
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 522:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_nocturna = $hora_diurna * 1.3;
                                $hora_extra_nocturna = $hora_nocturna * 1.5;                                
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_extras_nocturnas'] * $hora_extra_nocturna;      
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 523:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_nocturna = $hora_diurna * 1.3; 
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_faltantes_nocturnas'] * $hora_nocturna;   
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 524:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_diurna_feriado = $hora_diurna * 1.5;
                                $hora_extra_diurna_feriado = $hora_diurna_feriado * 1.5;                                
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_extras_diurnas_feriado'] * $hora_extra_diurna_feriado;    
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 525:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_diurna_feriado = $hora_diurna * 1.5;     
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_faltantes_diurnas_feriado'] * $hora_diurna_feriado;                 
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 526:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_diurna_feriado = $hora_diurna * 1.5;
                                $hora_nocturna_feriado = $hora_diurna_feriado * 1.3;
                                $hora_extra_nocturna_feriado = $hora_nocturna_feriado * 1.5;
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_extras_nocturnas_feriado'] * $hora_extra_nocturna_feriado;  
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 527:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_diurna_feriado = $hora_diurna * 1.5;
                                $hora_nocturna_feriado = $hora_diurna_feriado * 1.3;
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_faltantes_nocturnas_feriado'] * $hora_nocturna_feriado;          
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                            case 528:
                                $sueldo_normal = $this->calculoSueldoNormal($sueldo_basico, $prima_antiguedad);
                                $hora_diurna = ($sueldo_normal / 30) / 8;
                                $hora_diurna_feriado = $hora_diurna * 1.5;
                                $hora_nocturna_feriado = $hora_diurna_feriado * 1.3;
                                $calculo_horas = $this->calculoHoras($empleado);
                                $monto = $calculo_horas['horas_faltantes_nocturnas_feriado'] * $hora_nocturna_feriado;          
                                $this->registrarVoucher($empleado, $concepto_nomina, $nomina, $monto);
                                break;
                        }
                    }
                }
            }
        }
        // Elimina la tabla pivote concepto-nomina
        //$nomina->conceptos()->detach($conceptos);

        return response()->json('success');

    }

    // Calculo de sueldo base
    public function calculoSueldoBase($empleado)
    {        
        $cargo = Cargo::findOrFail($empleado->cargo_id);
        $tabulador_salarial = TabuladorSalarial::findOrFail($cargo->tabulador_salarial_id);
        return $tabulador_salarial->sueldo_base;
    }

    public function calculoSueldoNormal($sueldo_basico, $prima_antiguedad)
    {
        return $sueldo_basico + $prima_antiguedad;
    }

    public function calculoHoras($empleado)
    {
        $asistencias = Asistencia::where('empleado_id', $empleado->empleado_id)->get();
        $horas_extras_diurnas = 0;
        $horas_faltantes_diurnas = 0;
        $horas_extras_nocturnas = 0;
        $horas_faltantes_nocturnas = 0;
        $horas_extras_diurnas_feriado = 0;
        $horas_faltantes_diurnas_feriado = 0;
        $horas_extras_nocturnas_feriado = 0;
        $horas_faltantes_nocturnas_feriado = 0;

        foreach ($asistencias as $asistencia)
        {
            if (Carbon::now()->month == Carbon::createFromFormat('Y-m-d', $asistencia->fecha)->month) {
                $horas_extras_diurnas += $asistencia->h_extras_diurnas;
                $horas_faltantes_diurnas += $asistencia->h_faltantes_diurnas;
                $horas_extras_nocturnas += $asistencia->h_extras_nocturnas;
                $horas_faltantes_nocturnas += $asistencia->h_faltantes_nocturnas;
                $horas_extras_diurnas_feriado += $asistencia->h_extras_diurnas_feriado;
                $horas_faltantes_diurnas_feriado += $asistencia->h_faltantes_diurnas_feriado;
                $horas_extras_nocturnas_feriado += $asistencia->h_extras_nocturnas_feriado;
                $horas_faltantes_nocturnas_feriado += $asistencia->h_faltantes_nocturnas_feriado;                
            }
        }
        return [
            'horas_extras_diurnas' => $horas_extras_diurnas, 
            'horas_faltantes_diurnas' => $horas_faltantes_diurnas, 
            'horas_extras_nocturnas' => $horas_extras_nocturnas, 
            'horas_faltantes_nocturnas' => $horas_faltantes_nocturnas, 
            'horas_extras_diurnas_feriado' => $horas_extras_diurnas_feriado, 
            'horas_faltantes_diurnas_feriado' => $horas_faltantes_diurnas_feriado, 
            'horas_extras_nocturnas_feriado' => $horas_extras_nocturnas_feriado, 
            'horas_faltantes_nocturnas_feriado' => $horas_faltantes_nocturnas_feriado
        ];        
    }    

    //  Calculo de numero de hijos
    public function calculoNumHijos($empleado)
    {
        $num_hijos = CargaFamiliar::where('empleado_id', $empleado->empleado_id)
            ->where('parentesco', 'hijos')
            ->count();
        return $num_hijos;
    }

    public function calcularAniosServicio($empleado)
    {
        return Carbon::createFromFormat('Y-m-d', $empleado->fecha_ingreso)->age;
    }

    public function calcularAntiguedad($sueldo_basico, $anios_servicio)
    {                        
        return $sueldo_basico * $anios_servicio * (2/100);        
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
                    ->orderBy('concepto_id', 'ASC')
                    ->get();

        return response()->json($vouchers);
    }

    // Obtener los conceptos por mes
    public function conceptosPorMes(Request $request)
    {                
        $nomina = $request->nomina != null ? $request->nomina : 1;
        
        $nomina = Nomina::findOrFail($nomina);

        $conceptos_nomina = [];

        foreach ($nomina->conceptos as $concepto) {
            if ($concepto->pivot->created_at->month == $request->mes) {                
                $conceptos_nomina[] = $concepto;
            }
        }

        return collect($conceptos_nomina)->toJson();
    }
}

<?php

namespace App\Http\Controllers\rrhh;

use Illuminate\Http\Request;
use App\Models\rrhh\Concepto;
use Illuminate\Http\Response;
use App\Models\rrhh\Variables;
use App\Http\Controllers\Controller;
use App\Models\rrhh\TabuladorSalarial;

class ParametrosController extends Controller
{
    public function listadoParametros()
    {
        return view('rrhh.backend.mantenimiento.parametros.list');
    }

    public function obtenerConceptos()
    {
        $conceptos = Concepto::orderBy('concepto_id', 'DESC')->get();

        return response()->json($conceptos);
    }

    public function registrarConcepto(Request $request)
    {        
        $concepto = new Concepto;

        $concepto->fill($request->except(['tipo_valor']));

        if ($concepto->save()) {
            return response()->json('success');
        } else {
            return response()->json('error');            
        }        
    }

    public function obtenerConcepto($concepto_id)
    {
        $concepto = Concepto::findOrFail($concepto_id);

        return response()->json($concepto);
    }

    public function actualizarConcepto(Request $request)
    {        
        $concepto = Concepto::findOrFail($request->concepto_id);
        //return $request->all();
        $concepto->fill([
            'tipo_concepto' => $request->tipo_concepto,
            'descripcion' => $request->descripcion,
            'porcentaje' => $request->porcentaje,
            'valor_fijo' => $request->valor_fijo,
            'bono_vacacional' => isset($request->bono_vacacional) ? $request->bono_vacacional : 0,
            'utilidades' => isset($request->utilidades) ? $request->utilidades : 0,
            'prestaciones' => isset($request->prestaciones) ? $request->prestaciones : 0,
            'islr' => isset($request->islr) ? $request->islr : 0,
        ]);
        $concepto->save();

        return response(null, Response::HTTP_OK);
    }

    // Variables
    public function obtenerVariables()
    {
        $variables = Variables::orderBy('variable_id', 'DESC')->get();

        return response()->json($variables);
    }

    public function registrarVariable(Request $request)
    {        
        $variable = new Variables;

        $variable->fill($request->except(['tipo_valor']));

        if ($variable->save()) {
            return response()->json('success');
        } else {
            return response()->json('error');            
        }        
    }

    public function obtenerVariable($variable_id)
    {
        $variable = Variables::findOrFail($variable_id);

        return response()->json($variable);
    }

    public function actualizarVariable(Request $request)
    {        
        $variable = Variables::findOrFail($request->variable_id);
        //return $request->all();
        $variable->fill([            
            'nombre' => $request->nombre,
            'valor' => $request->valor,
            'monto_fijo' => $request->monto_fijo,
            'base_calculo' => $request->base_calculo
        ]);
        $variable->save();

        return response(null, Response::HTTP_OK);
    }

    // Tabulador salarial
    public function obtenerTabuladores()
    {
        $tabuladores = TabuladorSalarial::orderBy('tabulador_salarial_id', 'DESC')->get();

        return response()->json($tabuladores);
    }

    public function registrarTabulador(Request $request)
    {        
        $tabulador = new TabuladorSalarial;

        $tabulador->fill($request->except(['tipo_valor']));

        if ($tabulador->save()) {
            return response()->json('success');
        } else {
            return response()->json('error');            
        }        
    }

    public function obtenerTabulador($tabulador_id)
    {
        $tabulador = TabuladorSalarial::findOrFail($tabulador_id);

        return response()->json($tabulador);
    }

    public function actualizarTabulador(Request $request)
    {        
        $tabulador = TabuladorSalarial::findOrFail($request->tabulador_id);
        //return $request->all();
        $tabulador->fill([            
            'cod_nivel' => $request->cod_nivel,
            'nivel' => $request->nivel,
            'sueldo_base' => $request->sueldo_base,            
        ]);
        $tabulador->save();

        return response(null, Response::HTTP_OK);
    }
}

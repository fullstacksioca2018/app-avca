<?php

namespace App\Http\Controllers\Reportes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;
use App\Models\reporte\DW_Ingreso;

class ApiControllerDW extends Controller
{
    public function listCargos()
    {
        $cargos = DB::table('cargos')
            ->join('tabuladores_salariales', 'cargos.tabulador_salarial_id', '=', 'tabuladores_salariales.tabulador_salarial_id')
            ->join('areas', 'cargos.area_id', '=', 'areas.area_id')
            ->select('tabuladores_salariales.sueldo_base', 'areas.nombre', 'cargos.*')
            ->get();
        return response()->json($cargos);
    }
    public function reporteIngresos(Request $consulta){
        // dd($consulta->all());
        $ingresos=DW_Ingreso::IngresosFecha($consulta->inicio,$consulta->final);
        $obj =new stdClass();
        $obj->labels= array();
        $obj->data= array();
        Carbon::setLocale(LC_TIME, 'Spanish');
        foreach ($ingresos as $ingreso) {
            $carboAux=Carbon::parse($ingreso->fecha_ingreso);
            array_push($obj->data, $ingreso->total);
            array_push($obj->labels, $carboAux->formatLocalized('%d %B'));
        }
        return response()->json($obj);
    }

    public function PROMEDIOMOVILDOBLE(){
        $inicio="01-01-2017";
        $final="31-12-2017";
        $meses=[1,2,3,4,5,6,7,8,9,10,11,12];
        $ingresos=DW_Ingreso::IngresosFechaMes($meses,"2017");
        return response()->json($ingresos);

        
    }
    /*
    PMS=muestra/numero de muestras
     < (D-P)2 El error minimo



	a = 2(PMS) – PMD
	a = 2 (37.50) – 30 = 45
	a = 45
	b = n/n-1 (PMS – PMD)
	b = 15
	Paso 5
	ynov = a + b(x) = 45+ 15(2) = 75 unidades
	ydic = a + b(x) = 45+ 15(3) = 90 unidades
	yene = a + b(x) = 45+ 15(4) = 105 unidades

     */
}
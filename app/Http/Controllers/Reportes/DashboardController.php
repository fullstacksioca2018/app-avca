<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\reporte\DW_Vuelo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function vuelosEstado($estado){
    	return json_decode(DW_Vuelo::VuelosEstado($estado));
    }

    public function vuelosEstado($estado,$fecha){
    	$actual2=Carbon::now();
		$mes2=DATE("m",strtotime($salidaCarbon->toDateTimeString()));
		$year2=DATE("Y",strtotime($salidaCarbon->toDateTimeString()));
		$day=DATE("d",strtotime($salidaCarbon->toDateTimeString()));
		if($fechaincio<15){ //dia de partida para calcular las horas de vuelos planificadas en la quicena
			$fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
			$fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
		}
		else{
			$fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
			$fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
		}
		if($estado!="retrasado"){
    		return json_decode(DW_Vuelo::VuelosEstadoFecha($estado,$fechaincio,$fechafin));
		}
		else{
    		return json_decode(DW_Demorado::VuelosDemoradosFecha($estado,$fechaincio,$fechafin));
		}
    }
}

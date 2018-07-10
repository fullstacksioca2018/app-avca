<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\reporte\DW_Vuelo;
use App\Models\reporte\DW_Demorado;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // public function vuelosEstado($estado){
    // 	return json_decode(DW_Vuelo::VuelosEstado($estado));
    // }

    public function vuelosEstadoQuincena($estado){
    	$actual2=Carbon::now();
		$mes2=DATE("m",strtotime($actual2->toDateTimeString()));
		$year2=DATE("Y",strtotime($actual2->toDateTimeString()));
		$day=DATE("d",strtotime($actual2->toDateTimeString()));
		switch($estado){
            case 'ejecutado':
	            if($actual2->day<15){ 
					$fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
				}
				else{
					$fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
				}
				$fechafin=$actual2->toDateTimeString();
            	break;
            case 'abierto':
				$fechaincio=$actual2->toDateTimeString();
            	if($actual2->day<15){ 
					$fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
				}
				else{
					$fechafin=$year2.'-'.$mes2.'-'.'30 12:00:00';
				}
            	break;
            case 'cancelado':
            	if($actual2->day<15){ 
					$fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
					$fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
				}
				else{
					$fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
					$fechafin=$year2.'-'.$mes2.'-'.'30 12:00:00';
				}
            	break;
            break;
            case 'demorado':
            	if($actual2->day<15){ 
					$fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
				}
				else{
					$fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
				}
				$fechafin=$actual2->toDateTimeString();
            break;

		}
		// dd(date("n"));
		if($estado!="demorado"){
    		return json_decode(DW_Vuelo::VuelosEstadoFecha($estado,$fechaincio,$fechafin));
		}
		else{
    		return json_decode(DW_Demorado::VuelosDemoradosFecha($fechaincio,$fechafin));
		}
    }
}

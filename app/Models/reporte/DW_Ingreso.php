<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DW_Ingreso extends Model
{
    protected $table = "DwIngresos";
    protected $primaryKey = "ingreso_id";
    protected $fillable = [
			'monto'
			,'fecha_ingreso'
    ];


    public function scopeIngresosFecha($query, $inicio, $final){
		return DB::table('dwingresos')
                        ->select('fecha_ingreso', DB::raw('SUM(monto) as total'))
                        ->whereBetween('fecha_ingreso',array($inicio,$final))
                        ->groupBy('fecha_ingreso')
                        ->orderBy('fecha_ingreso','asc')
                        ->get();
	}

	public function scopeIngresosFechaMes($query,$meses,$year){
		$array=array();
		for($i=0;$i<12;$i++){
			array_push($array, DB::table('dwingresos')
				->select(DB::raw('MONTH(fecha_ingreso) mes, SUM(monto) as total'))
	            ->whereMonth('fecha_ingreso',$meses[$i])
	            ->whereYear('fecha_ingreso',$year)
	            ->groupBy('mes')
	            ->orderBy('fecha_ingreso','asc')
	            ->first());
		}
		return $array; 
	}
}

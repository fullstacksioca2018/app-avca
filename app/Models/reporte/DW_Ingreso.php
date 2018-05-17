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
}

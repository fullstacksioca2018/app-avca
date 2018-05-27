<?php

namespace App\models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\reporte\DW_Ruta;
use Carbon\Carbon;

class DW_ReporteIngresos extends Model
{


    public function scopePorRutaFecha($query,$desde,$hasta,$ruta_id){
    	$ruta=DW_Ruta::find($ruta_id);
        $ruta2=DB::table('DwRutas')
            ->select('ruta_id')
            ->where([
                ['DwRutas.origen_id', '=', $ruta->origen_id],
                ['DwRutas.destino_id', '=', $ruta->destino_id],
            ])
            ->orWhere([
                ['DwRutas.destino_id', '=', $ruta->origen_id],
                ['DwRutas.origen_id', '=', $ruta->destino_id],
            ])->get();
        if(count($ruta2)==1){
            return DB::table('dwingresos')
        		->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta_id)
                ->whereDate('dwingresos.fecha_ingreso','>=',$desde->toDateTimeString())
        		->whereDate('dwingresos.fecha_ingreso','<=',$hasta->toDateTimeString())
                ->groupBy('dwingresos.fecha_ingreso')
                ->get();
        }
        else{
            return DB::table('dwingresos')
                ->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta_id)
                ->orWhere('DwRutas.ruta_id',$ruta_id)
                ->whereDate('dwingresos.fecha_ingreso','>=',$desde->toDateTimeString())
                ->whereDate('dwingresos.fecha_ingreso','<=',$hasta->toDateTimeString())
                ->groupBy('dwingresos.fecha_ingreso')
                ->get();
        }

    }
}

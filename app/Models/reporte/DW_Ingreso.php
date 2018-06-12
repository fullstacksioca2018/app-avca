<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\reporte\DW_Ruta;

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

	public function scopeOrigenMuestra($query, $origen){
		 $result =array();
		 $datos= DB::table('dwingresos')
            ->select( DB::raw('SUM(dwingresos.monto) as total'),DB::raw('MONTH(dwingresos.fecha_ingreso) month,YEAR(dwingresos.fecha_ingreso) year'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.origen_id',$origen)
            ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;

	}
	public function scopeDestinoMuestra($query,$destino){
		$result =array();
		$datos= DB::table('dwingresos')
            ->select( DB::raw('SUM(dwingresos.monto) as total'), DB::raw('MONTH(dwingresos.fecha_ingreso) month,YEAR(dwingresos.fecha_ingreso) year'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeRutaMuestra($query,$ruta_id){
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
            $result =array();
            $datos= DB::table('dwingresos')
        		->select( DB::raw('SUM(dwingresos.monto) as total'),DB::raw('MONTH(dwingresos.fecha_ingreso) month,YEAR(dwingresos.fecha_ingreso) year'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta_id)
                ->groupBy('month','year')
                ->get();
        }
        else{
            $result =array();
            $datos= DB::table('dwingresos')
                ->select( DB::raw('SUM(dwingresos.monto) as total'),DB::raw('MONTH(dwingresos.fecha_ingreso) month,YEAR(dwingresos.fecha_ingreso) year'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta2[0])
                ->orWhere('DwRutas.ruta_id',$ruta2[1])
                ->groupBy('month','year')
                ->get();
        }
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeMuestra($query){
		$result =array();
		$datos= DB::table('dwingresos')
            ->select( DB::raw('SUM(dwingresos.monto) as total'), DB::raw('MONTH(dwingresos.fecha_ingreso) month,YEAR(dwingresos.fecha_ingreso) year'))
            ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
}

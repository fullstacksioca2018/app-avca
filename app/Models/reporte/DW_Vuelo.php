<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DW_Vuelo extends Model
{
	protected $table = "DwVuelos";
    protected $primaryKey = "vuelo_id";
    protected $fillable = [
			'ruta_id'
			,'estado'
			,'aerolinea'
			,'fecha_creacion'
			,'fecha_cambio_estado'
			,'salida'
    ];

	public function ruta()
	{
		return $this->belongsTo('App\Models\reporte\DW_Ruta');
	}
	public function scopeVuelosEstado($query, $estado){
    	return $query->where('estado', '=', $estado)->count();
    }

    public function scopeVuelosEstadoFecha($query, $estado,$inicio,$final){
    	return $query->where('estado', '=', $estado)
    				->whereDate('salida','>=',$inicio)
    				->whereDate('salida','<=',$final)
    				->count();

    }

	public function scopeOrigenMuestra($query,$origen){
		$result =array();
		$datos= DB::table('DwVuelos')
		 	->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.origen_id',$origen)
            ->where('DwVuelos.estado','ejecutado')
	        ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeDestinoMuestra($query,$destino){
		$result =array();
		$datos= DB::table('DwVuelos')
		 	->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->where('DwVuelos.estado','ejecutado')
	        ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeRutaMuestra($query,$ruta_id){
		$result =array();
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
			$datos= DB::table('DwVuelos')
			 	->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
	            ->where('DwVuelos.ruta_id',$ruta_id)
	            ->where('DwVuelos.estado','ejecutado')
		        ->groupBy('month','year')
	            ->get();
        }
        else{
        	$datos= DB::table('DwVuelos')
			 	->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
                ->where('DwRutas.ruta_id',$ruta2[0])
                ->orWhere('DwRutas.ruta_id',$ruta2[1])
	            ->where('DwVuelos.estado','ejecutado')
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
		$datos= DB::table('DwVuelos')
		 	->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->where('DwVuelos.estado','ejecutado')
	        ->groupBy('month','year')
            ->get();
        foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
}

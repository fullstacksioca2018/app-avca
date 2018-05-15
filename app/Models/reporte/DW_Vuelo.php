<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

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
}

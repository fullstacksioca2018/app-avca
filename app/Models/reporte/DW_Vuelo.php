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
    ];

	public function ruta()
	{
		return $this->belongsTo('App\Models\reporte\DW_Ruta');
	}
	public function scopeVuelosEstado($query, $estado){
    	return $query->where('estado', '=', $estado)->count();
    }

    public function scopeVuelosEstado($query, $estado,$fecha){
    	return $query->where('estado', '=', $estado)
    				->whereDate('fecha_creacion','>=',$fecha)
    				->whereDate('fecha_cambio_estado','<=',$fecha)
    				->count();
    }
}

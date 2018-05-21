<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aeronave extends Model
{
	protected $table = "aeronaves";
	

    protected $fillable = [

		'id',
		'capacidad_asientos',
		'modelo',
		'matricula',
		'estado',
		'ultimo_mantenimiento',
		'capacidad_equipaje',
		'asiento_primera_clase',
		'asiento_economicos',
		'asiento_observacion',

    ];


    public function segmentos()
    {
    	return $this->hasMany('App\Models\operativo\Segmento');
	}
	
	public function scopeDisponibilidad($query,$antes,$despues){
        return DB::select("SELECT SUM(rutas.duracion) as horas
		FROM vuelos 
			 JOIN segmentos ON vuelos.id=segmentos.vuelo_id 
			 JOIN aeronaves ON segmentos.aeronave_id=aeronaves.id 
			 JOIN rutas ON segmentos.ruta_id=rutas.id 
			 WHERE aeronaves.id='1' AND 
				   vuelos.fecha_salida> aeronaves.ultimo_mantenimiento AND 
				   vuelos.estado!='cancelado'");
    }

}

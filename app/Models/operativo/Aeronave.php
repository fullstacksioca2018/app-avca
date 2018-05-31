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
        return DB::select("SELECT aeronaves.id, aeronaves.modelo, aeronaves.matricula 
                        FROM aeronaves 
                        JOIN segmentos ON aeronaves.id=segmentos.aeronave_id 
                        JOIN vuelos ON segmentos.vuelo_id=vuelos.id 
                        WHERE aeronaves.estado='activo' AND NOT(vuelos.fecha_salida>'$antes' AND 
                                vuelos.fecha_salida<'$despues') 
                            UNION 
                                SELECT aeronaves.id, aeronaves.modelo, aeronaves.matricula 
                                FROM aeronaves
                                WHERE aeronaves.estado='activo' AND aeronaves.id NOT IN(SELECT segmentos.aeronave_id 					  FROM segmentos)");
    }
    
    public function scopeHorasPostMantenimiento($query, $aeronave){
        return DB::select(" SELECT rutas.duracion as horas
                            FROM vuelos 
                            JOIN segmentos ON vuelos.id=segmentos.vuelo_id 
                            JOIN aeronaves ON segmentos.aeronave_id=aeronaves.id 
                            JOIN rutas ON segmentos.ruta_id=rutas.id 
                            WHERE aeronaves.id='$aeronave' AND 
                                vuelos.fecha_salida> aeronaves.ultimo_mantenimiento AND 
                                vuelos.estado!='cancelado'");
    }

    public function scopeHorasUso($query,$aeronave,$actual){
        return DB::select("SELECT rutas.duracion as horas
                           FROM vuelos 
                                JOIN segmentos ON vuelos.id=segmentos.vuelo_id 
                                JOIN aeronaves ON segmentos.aeronave_id=aeronaves.id 
                                JOIN rutas ON segmentos.ruta_id=rutas.id 
                                WHERE aeronaves.id='$aeronave' AND 
                                      vuelos.fecha_salida> aeronaves.ultimo_mantenimiento AND 
                                      vuelos.fecha_salida < '$actual' AND
                                      vuelos.estado!='cancelado'");
    }

    public function scopeHorasPlanificadas($query,$aeronave,$actual){

        return DB::select("SELECT rutas.duracion as horas
                           FROM vuelos 
                                JOIN segmentos ON vuelos.id=segmentos.vuelo_id 
                                JOIN aeronaves ON segmentos.aeronave_id=aeronaves.id 
                                JOIN rutas ON segmentos.ruta_id=rutas.id 
                                WHERE aeronaves.id='$aeronave' AND 
                                      vuelos.fecha_salida> '$actual' AND 
                                      vuelos.estado!='cancelado'");
    }

   

}



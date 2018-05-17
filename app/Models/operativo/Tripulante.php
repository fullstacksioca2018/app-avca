<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tripulante extends Model
{

    protected $table = 'tripulantes';

     protected $fillable = [
        'rango','licencia','empleado_id'
    ];
    
   public function empleado(){
        return $this->hasOne('App\Models\Operativo\Empleado2','id','personal_id');
    } 

    public function vuelos(){
        return $this->belongsToMany('App\Vuelo');
    }
    
    public function scopePersona($query){
        return Personal::find($this->personal_id);
    }
    public function datosPersonal($id){
        return Personal::find($id);
    }
    public function licencia($id){
        return DB::select("SELECT tripulantes.licencia
                            FROM tripulantes
                            WHERE tripulantes.id='$id'");
    }

    public function scopeDisponibilidad($query,$rango,$antes,$despues){
        return DB::select("SELECT tripulantes.id, empleados2.nombre, empleados2.apellido, tripulantes.licencia
            FROM tripulantes 
            JOIN empleados2 ON tripulantes.personal_id=empleados2.id
            WHERE tripulantes.rango='$rango' AND tripulantes.id NOT IN(SELECT   tripulante_vuelo.tripulante_id FROM tripulante_vuelo JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id WHERE vuelos.fecha_salida>'$antes' AND vuelos.fecha_salida<'$despues')
            UNION
            SELECT tripulantes.id, empleados2.nombre, empleados2.apellido,  tripulantes.licencia
                FROM tripulantes 
                JOIN empleados2 ON tripulantes.personal_id=empleados2.id 
                WHERE tripulantes.rango='$rango' AND tripulantes.id NOT IN(SELECT tripulante_vuelo.tripulante_id FROM tripulante_vuelo)");
        }


        

    public function scopeHorasExperiencia($query, $id){
        return DB::select("SELECT rutas.duracion as horas
                            FROM tripulantes 
                            JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id
                            JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id
                            JOIN segmentos ON vuelos.id=segmentos.vuelo_id
                            JOIN rutas ON segmentos.ruta_id=rutas.id
                            WHERE tripulantes.id='$id'  AND vuelos.estado!='cancelado'");
    }

    public function scopeHorasPlanificadas($query, $id, $inicio, $final){ 
        return DB::select("SELECT SUM(rutas.duracion) as horas
                           FROM tripulantes 
                           JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id 
                           JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id 
                           JOIN piernas ON vuelos.id=piernas.vuelo_id 
                           JOIN rutas ON piernas.ruta_id=rutas.id 
                           WHERE tripulantes.id='$id' AND 
                                 vuelos.salida>'$inicio' AND 
                                 vuelos.salida<'$final' AND 
                                 vuelos.estado!='cancelado'");
    }

    public function scopeVuelosPlanificadas($query, $id, $inicio, $final){
        return DB::select("SELECT COUNT(vuelos.id) as cantidad
                           FROM tripulantes 
                           JOIN tripulante_vuelo ON tripulantes.id=tripulante_vuelo.tripulante_id 
                           JOIN vuelos ON tripulante_vuelo.vuelo_id=vuelos.id 
                           JOIN segmentos ON vuelos.id=segmentos.vuelo_id 
                           JOIN rutas ON segmentos.ruta_id=rutas.id 
                           WHERE tripulantes.id='$id' AND 
                                 vuelos.fecha_salida>'$inicio' AND 
                                 vuelos.fecha_salida<'$final' AND 
                                 vuelos.estado!='cancelado'");
    }

    

    
}


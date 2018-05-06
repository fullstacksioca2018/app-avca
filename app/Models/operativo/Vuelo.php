<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = "vuelos";
    protected $fillable = [

		'id',
		'estado',
		'fecha_salida',
        'n_vuelo',

    ];


    public function boletos()
    {
    	return $this->hasMany('App\Boleto');
    }

    public function segmentos()
    {
    	return $this->hasMany('App\Segmento','vuelo_id','id');
    }

    public function scopeFillBuscador($query,$estado,$ruta){
        if($ruta==0){
            return $query->where("vuelos.estado","=",$estado)
                         ->join('segmentos', 'vuelos.id', '=', 'segmentos.vuelo_id')
                         ->select('vuelos.id','vuelos.fecha_salida', 'vuelos.estado','segmentos.ruta_id');
        }
        else{
            return $query->where([["vuelos.estado","=",$estado],["rutas.id","=",$ruta]])
                         ->join('segmentos', 'vuelos.id', '=', 'segmentos.vuelo_id')
                         ->join('rutas', 'segmentos.ruta_id', '=', 'rutas.id')
                         ->select('vuelos.id','vuelos.fecha_salida', 'vuelos.estado','segmentos.ruta_id');
        }
    }

    public function scopeVuelosRetrasados($query, $fecha){

        $vuelos=$query->where([['vuelos.fecha_salida','<',$fecha],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])->get();
        foreach ($vuelos as $vuelo) {
            $vuelo->estado="retrasado";
            $vuelo->save();
        }
    }

}

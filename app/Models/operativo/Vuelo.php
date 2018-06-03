<?php

namespace App\Models\operativo;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $table = "vuelos";
    protected $fillable = [

		'id',
		'estado',
		'fecha_salida',
        'n_vuelo',
        'boletos_vendidos',
        'boletos_reservados'

    ];


    public function boletos()
    {
    	return $this->hasMany('App\Models\operativo\Boleto');
    }

    public function segmentos()
    {
        return $this->hasMany('App\Models\operativo\Segmento','vuelo_id','id');
       
    }

    public function tripulantes(){
    	return $this->belongsToMany('App\Models\operativo\Tripulante');
    }

    public function scopeVuelosRetrasados($query, $fecha){ //fecha=a la fecha actual+1hra

        $vuelos=$query->where([['vuelos.fecha_salida','<',$fecha],['vuelos.estado','!=','retrasado'],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])->get();
        foreach ($vuelos as $vuelo) {
            $vuelo->estado="retrasado";
            $vuelo->save();
        }
    }

    public function scopeVuelosCerrados($query, $fecha){ //fecha=a la fecha actual+1hra

        $vuelos=$query->where([['vuelos.fecha_salida','<',$fecha],['vuelos.estado','!=','ejecutado'],['vuelos.estado','!=','cancelado']])->get();
        foreach ($vuelos as $vuelo) {
            $vuelo->estado="cerrado";
            $vuelo->save();
        }
    }

    public function scopeActualizar($query, $dato, $estado){
        $vuelo =Vuelo::find($dato);
        $vuelo->estado=$estado;
        $vuelo->save();
    }

}

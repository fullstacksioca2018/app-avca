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

    ];


    public function boletos()
    {
    	return $this->hasMany('App\Models\operativo\Boleto');
    }

    public function segmentos()
    {
        return $this->hasMany('App\Models\operativo\Segmento','vuelo_id','id');
       
    }

<<<<<<< HEAD
    public function tripulantes()
    {
        return $this->hasMany('App\Models\operativo\Tripulante','vuelo_id','id');
       
=======
    public function tripulantes(){
    	return $this->belongsToMany('App\Models\operativo\Tripulante');
>>>>>>> fb0d86a4bd8f3ea53a48ce51b2143b45bd9ac79c
    }

}

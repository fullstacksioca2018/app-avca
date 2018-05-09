<?php

namespace App\Models\online;


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
    	return $this->hasMany('App\Models\online\Boleto');
    }

    public function segmentos()
    {
    	return $this->hasMany('App\Models\online\Segmento','vuelo_id','id');
    }

}

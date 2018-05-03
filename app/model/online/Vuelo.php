<?php

namespace App\Model\Online;
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
    	return $this->hasMany('App\Model\Online\Boleto');
    }

    public function segmentos()
    {
    	return $this->hasMany('App\Model\Online\Segmento','vuelo_id','id');
    }

}

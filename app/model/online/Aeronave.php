<?php

namespace App\Model\Online;

use Illuminate\Database\Eloquent\Model;

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
    	return hasMany('App\Model\Online\Segmento');
    }

}

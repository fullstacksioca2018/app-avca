<?php

namespace App\Model\Online;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
	protected $table = "segmentos";
	protected $fillable = [

		'id',
		'vuelo_id',
		'aeronave_id',
		'ruta_id',

	];

	public function aeronave()
	{
		return $this->belongsTo('App\Model\Online\Aeranave');
	}

	public function ruta()
	{
		return $this->belongsTo('App\Model\Online\Ruta');
	}

	public function vuelo()
	{
		return $this->belongsTo('App\Model\Online\Vuelo');
	}

	
}

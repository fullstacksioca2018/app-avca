<?php

namespace App;

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
		return $this->belongsTo('App\Aeranave');
	}

	public function ruta()
	{
		return $this->belongsTo('App\Ruta');
	}

	public function vuelo()
	{
		return $this->belongsTo('App\Vuelo');
	}

	
}

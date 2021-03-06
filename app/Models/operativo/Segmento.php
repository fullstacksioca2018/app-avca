<?php

namespace App\Models\operativo;

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
		return $this->belongsTo('App\Models\operativo\Aeronave');
	}

	public function ruta()
	{
		return $this->belongsTo('App\Models\operativo\Ruta');
	}

	public function vuelo()
	{
		return $this->belongsTo('App\Models\operativo\Vuelo');
	}

	
}

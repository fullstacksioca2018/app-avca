<?php

namespace App\Model\Online;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
	
	protected $table = "facturas";
	protected $fillable =[

		'id',
		'numero_factura',
		'fecha',
		'importe_facturado',
		'numero_control',
		'tarjeta_id',
		'adultos_cant',
		'ninos_cant',
		'NinosBrazos_cant',

	];

	public function boletos()
	{

		return $this->hasMany('App\Model\Online\Boleto');
		
	}

	public function tarjeta()
	{

		return $this->belongsTo('App\Model\Online\tarjeta');
		
	}


}

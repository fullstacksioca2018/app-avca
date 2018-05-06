<?php

namespace App;

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

		return hasMany('App\Boleto');
		
	}

	public function tarjeta()
	{

		return belongsTo('App\tarjeta');
		
	}


}

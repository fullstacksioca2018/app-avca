<?php

namespace App\Model\Online;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    
	protected $table = "tarjetas";
	protected $fillable = [

		'id',
		'titular',
		'numero_tarjeta',
		'fecha_vencimiento',

	];

	public function facturas()
	{
		return $this->hasMany('App\Model\Online\Factura');
	}

}

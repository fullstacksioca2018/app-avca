<?php

namespace App\Models\operativo;
use Illuminate\Support\Facades\DB;
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

		return hasMany('App\Models\operativo\Boleto');
		
	}

	public function tarjeta()
	{

		return belongsTo('App\Models\operativo\Tarjeta');
		
	}


 	public function scopeporpagar($query)
	{
		return DB::table('boletos')
				   ->select('factura_id')
				   ->where('boleto_estado','=','reservado')
				   ->GroupBy('factura_id')
				   ->get();
	} 

}

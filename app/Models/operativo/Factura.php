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

/* public function scopeporpagar($query)
	{
		return DB::table('facturas')
				   ->select('facturas.id')
		           ->join('boletos','boletos.factura_id','=','facturas.id')
				   ->where('boletos.boleto_estado','=','reservado')
				   ->GroupBy('facturas.id')
				   ->get();
	}  */
 	public function scopeporpagar($query)
	{
		return DB::table('boletos')
				   ->select('factura_id')
				   ->where('boleto_estado','=','reservado')
				   ->GroupBy('factura_id')
				   ->get();
	} 

}
/* select 
facturas.numero_factura

  
FROM
 boletos join (facturas) on (boletos.factura_id = facturas.id and boletos.boleto_estado = 'reservado')

GROUP BY facturas.numero_factura ASC
 */
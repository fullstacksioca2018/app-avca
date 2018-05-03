<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $table = "boletos";
    protected $fillable = [

		'boleto_estado',
		'fecha_expiracion',
		'asiento',
		'primerNombre',
        'segundoNombre',
        'documento',
        'genero',
		'apellido',
		'tipo_boleto',
        'fecha_nacimiento',
		'detalles_salud',
		'user_id',
		'factura_id',
		'vuelo_id',

    ];

    public function user()
    {
    	return belongsTo('App\Cliente');
    }

    public function factura()
    {
    	return belongsTo('App\Factura');
    }

    public function vuelo()
    {
    	return belongsTo('App\Factura');
    }

}

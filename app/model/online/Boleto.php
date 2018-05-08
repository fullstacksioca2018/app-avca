<?php

namespace App\Model\Online;

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
        'tipo_documento',
        'documento',
        'genero',
		'apellido',
		'tipo_boleto',
        'fecha_nacimiento',
		'detalles_salud',
		'user_id',
		'factura_id',
		'vuelo_id',
        'localizador',

    ];

    public function user()
    {
    	return $this->belongsTo('App\Online');
    }

    public function factura()
    {
    	return $this->belongsTo('App\Model\Online\Factura');
    }

    public function vuelo()
    {
    	return $this->belongsTo('App\Model\Online\Factura');
    }

}

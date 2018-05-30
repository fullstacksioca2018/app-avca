<?php

namespace App\Models\Operativo;

use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    protected $table = "boletos";
    protected $fillable =[
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
    	return $this->belongsTo('App\Models\operativo\Cliente');
    }

    public function factura()
    {
    	return $this->belongsTo('App\Models\operativo\Factura');
    }

    public function vuelo()
    {
    	return $this->belongsTo('App\Models\operativo\Factura');
    }
    public function scopeCheckin($query, $localizador)
    {
        return DB::table('boletos')->select('id')->where('localizador',$localizador);

    }
   
    public function maleta()
    {
    	return $this->hasOne('App\Models\operativo\Maleta');

	}

}

<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $fillable = [

		'id',
		'nombre',
		'direccion',
		'sigla',
		'aeropuerto',
		'estado',
		'pais',
        'tipo_sucursal',
        'estatus',
        'ciudad'
    ];

    public function rutas()
    {
    	return $this->hasMany('App\Models\operativo\Ruta');
    }

    public function origenes()
    {
    	return $this->hasMany('App\Models\operativo\Ruta','destino_id','id');
    }

    public function destinos()
    {
    	return $this->hasMany('App\Models\operativo\Ruta','origen_id','id');
    }

}

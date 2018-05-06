<?php

namespace App\model\operativo;

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

    ];

    public function rutas()
    {
    	return $this->hasMany('App\Ruta');
    }

    public function origenes()
    {
    	return $this->hasMany('App\Ruta','destino_id','id');
    }

    public function destinos()
    {
    	return $this->hasMany('App\Ruta','origen_id','id');
    }

}

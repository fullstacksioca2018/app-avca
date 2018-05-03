<?php

namespace App\Model\Online;

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
    	return $this->hasMany('App\Model\Online\Ruta');
    }

    public function origenes()
    {
    	return $this->hasMany('App\Model\Online\Ruta','destino_id','id');
    }

    public function destinos()
    {
    	return $this->hasMany('App\Model\Online\Ruta','origen_id','id');
    }

}

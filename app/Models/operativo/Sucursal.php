<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $primaryKey = 'sucursal_id';
    protected $fillable = [

		'sucursal_id',
		'nombre',
		'direccion',
		'sigla',
	
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
    	return $this->hasMany('App\Models\operativo\Ruta','destino_id','sucursal_id');
    }

    public function destinos()
    {
    	return $this->hasMany('App\Models\operativo\Ruta','origen_id','sucursal_id');
    }

}

<?php

namespace App\Models\operativo;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $primaryKey = 'sucursal_id';
    protected $fillable = [

		'sucursal_id',
		'nombre',
		'sigla',	
		'estatus',
        'tipo_sucursal',
      
        'ciudad'
    ];

    public function siglas($id){
        return DB::select('SELECT sigla FROM sucursales WHERE sucursal_id = ?', [$id]);
    }

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

<?php

namespace App\Models\operativo;
use Illuminate\Database\Eloquent\Model;

class Tripulante extends Model
{
    protected $table = "tripulantes";
    protected $fillable = [

		'id',
		'rango',
		'licencia',
        'empleado_id',

    ];


    public function empleados()
    {
    	return $this->hasMany('App\Models\operativo\Empleado2');
    }

}

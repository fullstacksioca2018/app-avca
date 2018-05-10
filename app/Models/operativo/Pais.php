<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = "paises";
    protected $fillable = [

    	'id',
    	'pais'

    ];

    public function clientes()
    {

    	return $this->hasMany('App\Models\operativo\Cliente');
    	
    }
}

<?php

namespace App\Model\Online;

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

    	return hasMany('App\Model\Online\Cliente');
    	
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $fillable = [

        'id',
		'nombre',
		'apellido',
		'tipo_documento',
		'documento', 
		'codigo_postal',
		'direccion',
		'fecha_nacimiento',
		'genero',
		'telefono_fijo',
		'telefono_movil',
		'user_id',
		'pais_id'

    ];

    public function user()
    {
    	
    	return belongsTo('App\User');

    }

    public function pais()
    {
    	
    	return belongsTo('App\Pais');

    }

}

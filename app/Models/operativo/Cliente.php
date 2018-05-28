<?php

namespace App\Models\operativo;

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
    	
    	return $this->belongsTo('App\Models\operativo\User');

    }

    public function pais()
    {
    	
    	return $this->belongsTo('App\Models\operativo\Pais');

	}
	
	public function Cedula($cedula){
        return DB::select('SELECT * FROM clientes WHERE documento = ?', [$cedula]);
    }

}

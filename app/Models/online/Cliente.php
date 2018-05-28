<?php


namespace App\Models\online;
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
    	
    	return $this->belongsTo('App\Models\Online\User');

    }

    public function pais()
    {
    	
    	return $this->belongsTo('App\Models\Online\Pais');

	}
	

}

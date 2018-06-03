<?php

namespace App\Models\Operativo;

use Illuminate\Database\Eloquent\Model;

class Maleta extends Model
{
    protected $table = "maletas";
    protected $fillable =[

        'id',
        'boleto_id',
        'cantidad',
        'peso',
    ];

    public function boleto()
    {
    	
    	return $this->belongsTo('App\Models\operativo\Boleto');

	}


}

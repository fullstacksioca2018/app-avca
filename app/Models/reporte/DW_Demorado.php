<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Demorado extends Model
{
    protected $table = "DwDemorados";
    protected $primaryKey = "demorado_id";
    protected $fillable = [
			'salida'
			,'vuelo_id'
    ];
    

    public function scopeVuelosDemoradosFecha($query,$inicio,$final){
    	return $query->whereDate('salida','>=',$inicio)
    				->whereDate('salida','<=',$final)
    				->count();
    	}
}

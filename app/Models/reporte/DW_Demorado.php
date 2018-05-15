<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Demorado extends Model
{
    protected $table = "DwDemorado";
    protected $primaryKey = "demorado_id";
    protected $fillable = [
			'demora'
			,'vuelo_id'
    ];
    

    public function VuelosDemoradosFecha($query, $estado,$inicio,$final){
    	return $query->whereDate('salida','>=',$inicio)
    				->whereDate('salida','<=',$final)
    				->count();
    	}
}

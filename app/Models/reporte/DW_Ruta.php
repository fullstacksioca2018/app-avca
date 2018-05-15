<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Ruta extends Model
{
    protected $table = "DwRutas";
    protected $primaryKey = "ruta_id";
    protected $fillable = [
			'tarifa_vuelo'
			,'origen_id'
			,'destino_id'
    ];

    public function origen()
    {
      return $this->belongsTo('App\Models\reporte\DW_Sucursal','origen_id','sucursal_id');
    }
    public function destino()
    {
      return $this->belongsTo('App\Models\reporte\DW_Sucursal','destino_id','sucursal_id');
    }

    public function vuelos(){
      return $this->hasMany('App\Models\reporte\DW_Vuelo');
    }

}

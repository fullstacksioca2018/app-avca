<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Sucursal extends Model
{
    protected $table = "DwSucursales";
    protected $primaryKey = "sucursal_id";
    protected $fillable = [
			'nombre'
    ];

    public function origenes()
    {
      return $this->hasMany('App\Models\reporte\DW_Sucursal','origen_id','sucursal_id');
    }
    public function destinos()
    {
      return $this->hasMany('App\Models\reporte\DW_Sucursal','destino_id','sucursal_id');
    }
}

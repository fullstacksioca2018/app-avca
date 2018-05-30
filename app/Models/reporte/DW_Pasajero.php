<?php

namespace App\models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Pasajero extends Model
{
    protected $table = "DwPasajeros";
    protected $primaryKey = "pasajero_id";
    protected $fillable = [
		'fecha_nacimiento'
		,'genero'
		,'discapacidad'
    ];
    
}

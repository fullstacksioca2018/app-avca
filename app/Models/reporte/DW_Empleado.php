<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class Dw_Empleado extends Model
{
    protected $table = "DwEmpleados";
    protected $primaryKey = "empleado_id";
    protected $fillable = [
		'estado'
		,'fecha_contratacion'
		,'cargo_id'
		,'sucursal_id'
    ];
    

}

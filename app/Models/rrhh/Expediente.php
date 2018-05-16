<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = "expedientes";
    protected $primaryKey = "expediente_id";

    protected $fillable = ['num_oficio', 'fecha', 'tipo_oficio', 'descripcion', 'fecha_inicio', 'fecha_final', 'soporte_pdf', 'empleado_id'];
}

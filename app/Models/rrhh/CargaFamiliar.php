<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class CargaFamiliar extends Model
{
    protected $table = 'carga_familiar';
    protected  $primaryKey = 'carga_familiar_id';
    protected $fillable = ['nombre', 'apellido', 'cedula_beneficiario', 'fecha_nacimiento', 'estatus', 'genero', 'parentesco', 'empleado_id'];
}

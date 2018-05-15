<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Empleado2 extends Model
{
    protected $table = "empleados2";
    protected $primaryKey = "id";
    protected $fillable = ['cedula', 'nombre', 'apellido', 'tipo_empleado',];
}
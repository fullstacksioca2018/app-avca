<?php

namespace App\Models\operativo;

use Illuminate\Database\Eloquent\Model;

class Empleado2 extends Model
{
    protected $table = "empleados2";
<<<<<<< HEAD
    protected $primaryKey = "id";
=======
    protected $primaryKey = "empleado_id";
>>>>>>> fb0d86a4bd8f3ea53a48ce51b2143b45bd9ac79c
    protected $fillable = ['cedula', 'nombre', 'apellido', 'tipo_empleado',];
}
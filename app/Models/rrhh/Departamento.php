<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamentos";
    protected $primaryKey = "departamento_id";

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empleado_id', 'departamento_id');
    }
}

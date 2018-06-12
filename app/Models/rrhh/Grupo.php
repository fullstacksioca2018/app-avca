<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    //protected $primaryKey = 'grupo_id';
    protected $fillable = ['tipo_grupo','nombre','horas_jornada','grupo_id'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'empleado_id');
    }
}

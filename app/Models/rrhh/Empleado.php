<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "empleados";
    protected $primaryKey = "empleado_id";
    protected $fillable = ['cedula', 'nombre', 'apellido', 'nacionalidad', 'fecha_nacimiento', 'estado_civil', 'fecha_ingreso', 'sexo', 'foto', 'estado', 'ciudad', 'direccion', 'tipo_discapacidad', 'telefono_fijo', 'telefono_movil', 'email', 'tipo_discapacidad', 'sucursal', 'departamento', 'cargo', 'tipo_empleado', 'nivel_academico', 'profesion', 'condicion_laboral', 'tipo_horario', 'banco', 'cuenta_bancaria'];

    public function conceptos()
    {
        return $this->belongsToMany('App\Models\rrhh\Concepto', 'concepto_empleado', 'empleado_id', 'concepto_id');
    }
}

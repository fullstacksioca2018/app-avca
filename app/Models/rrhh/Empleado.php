<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "empleados";
    protected $primaryKey = "empleado_id";
    protected $fillable = ['cedula', 'nombre', 'apellido', 'nacionalidad', 'fecha_nacimiento', 'estado_civil', 'fecha_ingreso', 'sexo', 'foto', 'estado', 'ciudad', 'direccion', 'tipo_discapacidad', 'telefono_fijo', 'telefono_movil', 'email', 'tipo_discapacidad', 'sucursal_id', 'departamento_id', 'cargo_id', 'area_id', 'nivel_academico', 'profesion', 'condicion_laboral', 'tipo_horario', 'banco', 'cuenta_bancaria', 'licencia'];

    public function conceptos()
    {
        return $this->belongsToMany('App\Models\rrhh\Concepto', 'concepto_empleado', 'empleado_id', 'concepto_id');
    }

    public function obtenerProfesion()
    {        
        $profesion = Profesion::where('profesion_id', $this->profesion)->first();        
        return $profesion;
    }

    public function obtenerCargo()
    {        
        $cargo = Cargo::where('cargo_id', $this->cargo_id)->first();        
        return $cargo;
    }

    public function obtenerSucursal()
    {        
        $sucursal = Sucursal::where('sucursal_id', $this->sucursal_id)->first();        
        return $sucursal;
    }

    public function obtenerTabulador()
    {   
        $cargo = Cargo::where('cargo_id', $this->cargo_id)->first();

        $tabulador_salarial = TabuladorSalarial::where('tabulador_salarial_id', $cargo->tabulador_salarial_id)->first();        
        return $tabulador_salarial;
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'empleado_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'empleado_id', 'departamento_id');
    }    

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}

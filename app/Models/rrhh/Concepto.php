<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    protected $primaryKey = 'concepto_id';

    protected $fillable = ['tipo_concepto','descripcion','porcentaje','valor_fijo','valor_variable','bono_vacacional','prestaciones','isl'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\rrhh\Empleado', 'concepto_empleado', 'concepto_id', 'empleado_id');
    }

    public function nominas()
    {
        return $this->belongsToMany('App\Models\rrhh\Nomina', 'concepto_nomina', 'concepto_id', 'nomina_id');
    }
}

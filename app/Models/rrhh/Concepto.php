<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = 'conceptos';
    protected $primaryKey = 'concepto_id';

    protected $fillable = ['tipo_concepto', 'descripcion', 'porcentaje', 'valor_fijo', 'bono_vacacional', 'utilidades', 'islr', 'prestaciones'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\rrhh\Empleado', 'concepto_empleado', 'concepto_id', 'empleado_id');
    }

    public function nominas()
    {
        return $this->belongsToMany('App\Models\rrhh\Nomina', 'concepto_nomina', 'concepto_id', 'nomina_id');
    }
}

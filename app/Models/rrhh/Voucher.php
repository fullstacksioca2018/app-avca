<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = "vouchers";
    protected $primaryKey = "voucher_id";
    protected $fillable = ['empleado_id', 'concepto_id', 'nomina_id', 'monto', 'fecha'];

    public function empleados()
    {
        return $this->belongsToMany('App\Models\rrhh\Empleado', 'empleados', 'empleado_id', 'voucher_id');
    }

    public function conceptosPorEmpleado()
    {
        $concepto = Concepto::where('concepto_id', $this->concepto_id)->first();
        return $concepto;
    }
}

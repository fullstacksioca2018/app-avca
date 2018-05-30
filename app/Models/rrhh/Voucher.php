<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = "vouchers";
    protected $primaryKey = "voucher_id";
    protected $fillable = ['empleado_id', 'concepto_id', 'nomina_id', 'monto', 'fecha'];
}

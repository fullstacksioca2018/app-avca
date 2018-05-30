<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    protected $table = "variables";
    protected $primaryKey = "variable_id";
    protected $fillable = ['nombre', 'valor', 'monto_fijo', 'base_calculo'];
}

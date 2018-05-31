<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class CalendarioFeriado extends Model
{
    protected $table = "calendario_feriado";
    protected $fillable = ['fecha_feriado', 'descripcion'];
}

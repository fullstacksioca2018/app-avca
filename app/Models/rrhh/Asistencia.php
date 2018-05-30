<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    //protected $primaryKey = 'asistencia_id';
    protected $fillable = [
        'fecha',
        'h_entrada',
        'h_salida',
        'dia_feriado',
        'h_extras_diurnas',
        'h_faltantes_diurnas',
        'h_extras_nocturnas',
        'h_faltantes_nocturnas',
        'h_extras_diurnas_feriado',
        'h_faltantes_diurnas_feriado ',
        'h_extras_nocturnas_feriado ',
        'h_faltantes_nocturnas_feriado ',
        'empleado_id'
    ];
    
    public function empleado()
    {
        return $this->belongsTo (Empleado::class, 'empleado_id');
    }
}

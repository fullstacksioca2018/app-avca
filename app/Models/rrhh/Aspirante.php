<?php

namespace App\Models\rrhh;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    protected $table = "aspirantes";
    protected $primaryKey = "aspirante_id";
    protected $fillable = ['cedula', 'nacionalidad', 'fecha_nacimiento', 'apellido', 'nombre', 'email', 'telefono_movil', 'telefono_fijo', 'curriculum', 'vacante_id','cargo_id'];

    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function getFechaFormateadaAttribute()
    {
        $fecha = Carbon::createFromFormat('Y-m-d', $this->fecha_nacimiento)->format('d/m/Y');
        return $fecha;
    }
}

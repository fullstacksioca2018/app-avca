<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Aspirante extends Model
{
    protected $table = "aspirantes";
    protected $primaryKey = "aspirante_id";
    protected $fillable = ['cedula', 'nacionalidad', 'fecha_nacimiento', 'apellido', 'nombre', 'email', 'telefono_movil', 'telefono_fijo', 'curriculum', 'vacante_id'];
}

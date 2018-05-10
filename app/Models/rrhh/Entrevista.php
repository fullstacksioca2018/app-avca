<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $table = "entrevistas";
    protected $primaryKey = "entrevista_id";
    protected $fillable = ['presentacion', 'inteligencia', 'formacion', 'experiencia', 'facilidad_expresion', 'habilidad', 'otros', 'observaciones', 'aspirante_id'];
}

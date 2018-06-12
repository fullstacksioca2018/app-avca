<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class TabuladorSalarial extends Model
{
    protected $table = "tabuladores_salariales";
    protected $primaryKey = "tabulador_salarial_id";
    protected $fillable = ['cod_nivel', 'nivel', 'sueldo_base'];
}

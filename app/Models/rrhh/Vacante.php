<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    protected $table = "vacantes";
    protected $primaryKey = "vacante_id";

    public function cargo()
    {
        return $this->belongsTo('App\Models\rrhh\Cargo', 'cargo_id', 'vacante_id');
    }
}

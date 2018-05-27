<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargos";
    protected $primaryKey = "cargo_id";

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'cargo_id');
    }

    public function vacantes()
    {
        return $this->hasMany(Vacante::class, 'cargo_id', 'cargo_id');
    }
}

<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "areas";
    protected $primaryKey = "area_id";

    public function cargos()
    {
        return $this->hasMany('App\Models\rrhh\Cargo');
    }
}

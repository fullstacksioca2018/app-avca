<?php

namespace App\Models\rrhh;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table = "nominas";
    protected $primaryKey = "nomina_id";
    protected $fillable = ['tipo', 'periodo'];

    public function conceptos()
    {
        return $this->belongsToMany('App\Models\rrhh\Concepto', 'concepto_nomina', 'nomina_id', 'concepto_id')->withTimestamps();
    }
}

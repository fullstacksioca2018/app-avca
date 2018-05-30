<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Cargo extends Model
{
    protected $table = "DwCargos";
    protected $primaryKey = "cargo_id";
    protected $fillable = [
			'titulo'
    ];

    public function scopebuscar($query,$titulo){
        return $query->where('titulo',$titulo)->first();
    }
}

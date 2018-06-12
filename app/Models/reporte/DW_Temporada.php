<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Temporada extends Model
{
    protected $table = "DwTemporadas";
    protected $primaryKey = "temporada_id";
    protected $fillable = [
			'nombre'
			,'inicio'
			,'final'
    ];

    public function scopebuscar($query, $nombre, $year){
    	return $query->where('nombre','=',$nombre)
    				->whereYear('inicio', $year)
					->first();
    }
}

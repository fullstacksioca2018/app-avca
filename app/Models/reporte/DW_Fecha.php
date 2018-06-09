<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;

class DW_Fecha extends Model
{
    protected $table = "DwFechas";
    protected $primaryKey = "fecha_id";
    protected $fillable = [
			'mes'
			,'year'
    ];

    public function scopenumeroMes($query,$mes){
    	$num;
    	switch ($mes) {
    		case 'Enero': $num=1; break;
    		case 'Febrero': $num=2; break;
    		case 'Marzo': $num=3; break;
    		case 'Abril': $num=4; break;
    		case 'Mayo': $num=5; break;
    		case 'Junio': $num=6; break;
    		case 'Julio': $num=7; break;
    		case 'Agosto': $num=8; break;
    		case 'Septiembre': $num=9; break;
    		case 'Octubre': $num=10; break;
    		case 'Noviembre': $num=11; break;
    		case 'Diciembre': $num=12; break;
    	}
    	return $num;
    }
    public function scopeSringMinMes($query,$mes){
        $mesSting;
        switch ($mes) {
            case 1: $mesSting="Ene"; break;
            case 2: $mesSting="Febr"; break;
            case 3: $mesSting="Mar"; break;
            case 4: $mesSting="Abr"; break;
            case 5: $mesSting="May"; break;
            case 6: $mesSting="Jun"; break;
            case 7: $mesSting="Jul"; break;
            case 8: $mesSting="Ago"; break;
            case 9: $mesSting="Sep"; break;
            case 10: $mesSting="Oct"; break;
            case 11: $mesSting="Nov"; break;
            case 12: $mesSting="Dic"; break;
        }
        return $mesSting;
    }
    public function scopeStringmes($query,$numero){
        switch ($numero) {
            case 1: return "Enero";break;
            case 2: return "Febrero";break;
            case 3: return "Marzo";break;
            case 4: return "Abril";break;
            case 5: return "Mayo";break;
            case 6: return "Junio";break;
            case 7: return "Julio";break;
            case 8: return "Agosto";break;
            case 9: return "Septiembre";break;
            case 10: return "Octubre";break;
            case 11: return "Noviembre";break;
            case 12: return "Diciembre";break;
        }
    }
    public function scopebuscar($query,$year,$mes){
    	return $query->where('mes',$mes)->where('year',$year)->first();
    }

}

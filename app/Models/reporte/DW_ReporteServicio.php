<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
    
class DW_ReporteServicio extends Model
{
    public function scopeDestino($query,$periodo,$destino){
        return DB::table('DwVuelos')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
            ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
            ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
            ->count();
        // return "destino";
    }
    public function scopeVuelosDestino($query,$periodo,$destino,$filtroV){
        switch ($filtroV){
            case 'Abiertos':
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                    ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelados':
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorados':
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutados':
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->where('DwVuelos.estado','ejecutado')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->count();
            break;
        }
       // return "VueloDestino";
    }
}

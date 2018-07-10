<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
    
class DW_ReporteServicio extends Model
{
    //vuelos ejecutados por destino
    public function scopeDestinoV($query,$periodo,$destino){
        //por defecto los vuelos ejecutados
        return DB::table('DwVuelos')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->where('DwVuelos.estado','ejecutado')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
        // return "destino";
    }

    //vuelos destino segun estado 
    public function scopeVuelosDestino($query,$periodo,$destino,$filtroV){
        $actual2=Carbon::now();
        $mes2=$actual2->month;
        $year2=$actual2->year;
        $day=$actual2->day;
        switch ($filtroV){
            case 'Abierto':
                if($periodo->desde==$periodo->hasta){
                    $fechaincio=$actual2->toDateString();
                    if($actual2->day<15){ 
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                    ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    $fechafin=$actual2->toDateTimeString();
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    $fechafin=$actual2->toDateTimeString();
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
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

    //vuelos ejecutados por origen
    public function scopeOrigenV($query,$periodo,$origen){
        //por defecto los vuelos ejecutados
        return DB::table('DwVuelos')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.origen_id',$origen)
            ->where('DwVuelos.estado','ejecutado')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
        // return "destino";
    }
    //vuelos origen segun estado 
    public function scopeVuelosOrigen($query,$periodo,$origen,$filtroV){
        $actual2=Carbon::now();
        $mes2=$actual2->month;
        $year2=$actual2->year;
        $day=$actual2->day;
        switch ($filtroV){
            case 'Abierto':
                if($periodo->desde==$periodo->hasta){
                    $fechaincio=$actual2->toDateString();
                    if($actual2->day<15){ 
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                    // return $periodo->desde."-".$periodo->hasta;
                }
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                    ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                }
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                }
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->where('DwVuelos.estado','ejecutado')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->count();
            break;
        }
    }

        //vuelos ejecutados por ruta
        public function scopeRutaV($query,$periodo,$ruta_id){
            //por defecto los vuelos ejecutados
            $ruta=DW_Ruta::find($ruta_id);
            $ruta2=DB::table('DwRutas')
                ->select('ruta_id')
                ->where([
                    ['DwRutas.origen_id', '=', $ruta->origen_id],
                    ['DwRutas.destino_id', '=', $ruta->destino_id],
                ])
                ->orWhere([
                    ['DwRutas.destino_id', '=', $ruta->origen_id],
                    ['DwRutas.origen_id', '=', $ruta->destino_id],
                ])->get();
            if(count($ruta2)==1){
                return DB::table('DwVuelos')
                    ->where('DwVuelos.ruta_id',$ruta_id)
                    ->where('DwVuelos.estado','ejecutado')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->count();
            }
            else{
                return DB::table('DwVuelos')
                    ->where('DwVuelos.ruta_id',$ruta2[0])
                    ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                    ->where('DwVuelos.estado','ejecutado')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->count();
            }
            // return "destino";
        }

        //vuelos ruta segun estado 
        public function scopeVuelosRuta($query,$periodo,$ruta_id,$filtroV){
        $ruta=DW_Ruta::find($ruta_id);
        $ruta2=DB::table('DwRutas')
            ->select('ruta_id')
            ->where([
                ['DwRutas.origen_id', '=', $ruta->origen_id],
                ['DwRutas.destino_id', '=', $ruta->destino_id],
            ])
            ->orWhere([
                ['DwRutas.destino_id', '=', $ruta->origen_id],
                ['DwRutas.origen_id', '=', $ruta->destino_id],
            ])->get();
        if(count($ruta2)==1){
            $actual2=Carbon::now();
            $mes2=$actual2->month;
            $year2=$actual2->year;
            $day=$actual2->day;
            switch ($filtroV){
                case 'Abierto':
                    if($periodo->desde==$periodo->hasta){
                        $fechaincio=$actual2->toDateString();
                        if($actual2->day<15){ 
                            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                        else{
                            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                        }
                        $periodo->desde=Carbon::parse($fechaincio);
                        $periodo->hasta=Carbon::parse($fechafin);
                    }
                    // return $periodo->desde."-".$periodo->hasta;
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                        ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                        ->count();
                    break;
                case 'Cancelado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                        }
                        $periodo->desde=Carbon::parse($fechaincio);
                        $periodo->hasta=Carbon::parse($fechafin);
                    }
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->where('DwVuelos.estado','cancelado')
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Demorado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                    }
                    return DB::table('DwDemorados')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Ejecutado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                    }
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->where('DwVuelos.estado','ejecutado')
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->count();
                break;
            }
        }
        else{
            $actual2=Carbon::now();
            $mes2=$actual2->month;
            $year2=$actual2->year;
            $day=$actual2->day;
            switch ($filtroV){
                case 'Abierto':
                    if($periodo->desde==$periodo->hasta){
                        $fechaincio=$actual2->toDateString();
                        if($actual2->day<15){ 
                            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                        else{
                            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                        }
                        $periodo->desde=Carbon::parse($fechaincio);
                        $periodo->hasta=Carbon::parse($fechafin);
                    }
                    // return $periodo->desde."-".$periodo->hasta;
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                        ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                        ->count();
                    break;
                case 'Cancelado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                        }
                        $periodo->desde=Carbon::parse($fechaincio);
                        $periodo->hasta=Carbon::parse($fechafin);
                    }
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->where('DwVuelos.estado','cancelado')
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Demorado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                    }
                    return DB::table('DwDemorados')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Ejecutado':
                    if($periodo->desde==$periodo->hasta){
                        if($actual2->day<15){ 
                            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        }
                        else{
                            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        }
                    }
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->where('DwVuelos.estado','ejecutado')
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->count();
                break;
            }
        }
       // return "VueloDestino";
    }

    //PASAJEROS//////////////PASAJEROS///////////PASAJEROS///////////PASAJEROS////
    /////////////PASAJEROS///////////PASAJEROS/////////PASAJEROS/////////PASAJEROS
    //PASAJEROS//////////////PASAJEROS///////////PASAJEROS///////////PASAJEROS////
    
    //Pasajeros por destino
    public function scopeDestinoP($query,$periodo,$destino){
        //por defecto los vuelos ejecutados
        return DB::table('DwBoletos')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
        // return "destino";
    }

    //vuelos destino segun estado 
    public function scopePasajerosDestino($query,$periodo,$destino,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
        }
       // return "VueloDestino";
    }

    //Pasajeros por origen
    public function scopeOrigenP($query,$periodo,$origen){
        //por defecto los vuelos ejecutados
        return DB::table('DwBoletos')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.origen_id',$origen)
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
        // return "origen";
    }

    //Pasajeros de un origen segun edad 
    public function scopePasajerosOrigen($query,$periodo,$origen,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
        }
       // return "VueloDestino";
    }

    //Pasajeros por ruta
    public function scopeRutaP($query,$periodo,$ruta_id){
        $ruta=DW_Ruta::find($ruta_id);
        $ruta2=DB::table('DwRutas')
            ->select('ruta_id')
            ->where([
                ['DwRutas.origen_id', '=', $ruta->origen_id],
                ['DwRutas.destino_id', '=', $ruta->destino_id],
            ])
            ->orWhere([
                ['DwRutas.destino_id', '=', $ruta->origen_id],
                ['DwRutas.origen_id', '=', $ruta->destino_id],
            ])->get();
        if(count($ruta2)==1){
            return DB::table('DwBoletos')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->where('DwVuelos.ruta_id',$ruta_id)
                ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                ->count();
        }
        else{
            return DB::table('DwBoletos')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->where('DwVuelos.ruta_id',$ruta2[0])
                ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                ->count();
        }
        // return "ruta";
    }

    //Pasajeros de una ruta segun edad 
    public function scopePasajerosRuta($query,$periodo,$ruta_id,$filtroP){
        $ruta=DW_Ruta::find($ruta_id);
        $ruta2=DB::table('DwRutas')
            ->select('ruta_id')
            ->where([
                ['DwRutas.origen_id', '=', $ruta->origen_id],
                ['DwRutas.destino_id', '=', $ruta->destino_id],
            ])
            ->orWhere([
                ['DwRutas.destino_id', '=', $ruta->origen_id],
                ['DwRutas.origen_id', '=', $ruta->destino_id],
            ])->get();
        if(count($ruta2)==1){
            switch ($filtroP){
                case 'Bebe':
                    $fechaLimite=$periodo->hasta->copy();
                    $fechaLimite->subYears(2);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Niños':
                    $fechaLimiteD=$periodo->hasta->copy();
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteD->subYears(12);
                    $fechaLimiteH->subYears(2);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
                case 'Adolecente':
                    $fechaLimiteD=$periodo->hasta->copy();
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteD->subYears(18);
                    $fechaLimiteH->subYears(12);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
                case 'Adulto':
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteH->subYears(18);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
            }
        }
        else{
            switch ($filtroP){
                case 'Bebe':
                    $fechaLimite=$periodo->hasta->copy();
                    $fechaLimite->subYears(2);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Niños':
                    $fechaLimiteD=$periodo->hasta->copy();
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteD->subYears(12);
                    $fechaLimiteH->subYears(2);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
                case 'Adolecente':
                    $fechaLimiteD=$periodo->hasta->copy();
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteD->subYears(18);
                    $fechaLimiteH->subYears(12);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
                case 'Adulto':
                    $fechaLimiteH=$periodo->hasta->copy();
                    $fechaLimiteH->subYears(18);
                    return DB::table('DwPasajeros')
                        ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                        ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                        ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                        ->count();
                break;
            }
        }
       // return "VueloDestino";
    }

    public function scopeVuelosEstado($query, $periodo, $filtroV){

            $actual2=Carbon::now();
            $mes2=$actual2->month;
            $year2=$actual2->year;
            $day=$actual2->day;
            switch ($filtroV){
            case 'Abierto':
                if($periodo->desde==$periodo->hasta){
                    $fechaincio=$actual2->toDateString();
                    if($actual2->day<15){ 
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                // return $periodo->desde."-".$periodo->hasta;
                return DB::table('DwVuelos')
                    ->whereDate('DwVuelos.fecha_creacion','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_creacion','<=',$periodo->hasta)
                    ->whereDate('DwVuelos.salida','>=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                        $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
                    }
                    $periodo->desde=Carbon::parse($fechaincio);
                    $periodo->hasta=Carbon::parse($fechafin);
                }
                return DB::table('DwVuelos')
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                }
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutado':
                if($periodo->desde==$periodo->hasta){
                    if($actual2->day<15){ 
                        $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
                    }
                    else{
                        $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
                    }
                }
                return DB::table('DwVuelos')
                    ->where('DwVuelos.estado','ejecutado')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->count();
            break;
        }
    }

    public function scopeVuelos($query, $periodo){
        return DB::table('DwVuelos')
            ->where('DwVuelos.estado','ejecutado')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
    }

    public function scopePasajeros($query, $periodo){
        return DB::table('DwBoletos')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->count();
    }
    public function scopePasajerosEdad($query, $periodo, $filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->count();
            break;
        }
    }

                ///BUSQUEDA(////////)////BUSQUEDA////////////////////
                ///BUSQUEDA(////////)BUSQUEDA////////////////////
                ///BUSQUEDA(////////)/////////////BUSQUEDA//////////
                ///BUSQUEDA(////////)BUSQUEDA////////////////////
                ///BUSQUEDA(////////)BUSQUEDA/////BUSQUEDA/////
                ///BUSQUEDA(////////)//////BUSQUEDA//////BUSQUEDA
    ///VUELOS DESTINO CON FILTROS/////        
    public function scopeAltoVuelosDestinoFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosDestinoFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosDestinoFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosDestinoFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///VUELOS DESTINOS SIN FILTROS/////        
    public function scopeAltoVuelosDestino($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosDestino($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosDestino($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosDestino($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///PASAJEROS DESTINOS CON FILTROS/////        
    public function scopeAltoPasajerosDestinoFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
        }
    }
    public function scopeBajaPasajerosDestinoFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMayorPasajerosDestinoFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) > '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMenorPasajerosDestinoFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) < '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }

    ///PASAJEROS DESTINOS SIN FILTROS/////        
    public function scopeAltoPasajerosDestino($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }

    public function scopeBajaPasajerosDestino($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorPasajerosDestino($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorPasajerosDestino($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }





    ///VUELOS ORIGEN CON FILTRO
    public function scopeAltoVuelosOrigenFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosOrigenFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosOrigenFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosOrigenFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///VUELOS ORIGEN SIN FILTROS/////        
    public function scopeAltoVuelosOrigen($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosOrigen($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosOrigen($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosOrigen($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///PASAJEROS ORIGEN CON FILTROS/////        
    public function scopeAltoPasajerosOrigenFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
        }
    }
    public function scopeBajaPasajerosOrigenFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMayorPasajerosOrigenFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) > '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMenorPasajerosOrigenFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) < '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwSucursales.nombre')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }

    ///PASAJEROS ORIGEN SIN FILTROS/////        
    public function scopeAltoPasajerosOrigen($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }

    public function scopeBajaPasajerosOrigen($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorPasajerosOrigen($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorPasajerosOrigen($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwSucursales.nombre', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }







     ///VUELOS RUTA CON FILTRO
    public function scopeAltoVuelosRutaFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosRutaFiltro($query,$periodo,$Row,$filtro){
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosRutaFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosRutaFiltro($query,$periodo,$Row,$Monto,$filtro){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->where('DwVuelos.estado',$filtro)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///VUELOS RUTA SIN FILTROS/////        
    public function scopeAltoVuelosRuta($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }
    public function scopeBajaVuelosRuta($query,$periodo,$Row){
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorVuelosRuta($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorVuelosRuta($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwVuelos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }

    ///PASAJEROS RUTA CON FILTROS/////        
    public function scopeAltoPasajerosRutaFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'desc')
                    ->limit($Row)
                    ->get();
            break;
        }
    }
    public function scopeBajaPasajerosRutaFiltro($query,$periodo,$Row,$filtroP){
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
            break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMayorPasajerosRutaFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) > '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }
    public function scopeMenorPasajerosRutaFiltro($query,$periodo,$Row,$Monto,$filtroP){
        $having= 'count(*) < '.$Monto;
        switch ($filtroP){
            case 'Bebe':
                $fechaLimite=$periodo->hasta->copy();
                $fechaLimite->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$periodo->hasta)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Niños':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(12);
                $fechaLimiteH->subYears(2);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adolecente':
                $fechaLimiteD=$periodo->hasta->copy();
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteD->subYears(18);
                $fechaLimiteH->subYears(12);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
            case 'Adulto':
                $fechaLimiteH=$periodo->hasta->copy();
                $fechaLimiteH->subYears(18);
                return DB::table('DwPasajeros')
                    ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
                    ->whereDate('DwVuelos.salida','>=',$periodo->desde)
                    ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
                    ->groupBy('DwRutas.ruta_id')
                    ->havingRaw($having)
                    ->orderBy('total', 'asc')
                    ->limit($Row)
                    ->get();
                break;
        }
    }

    ///PASAJEROS RUTA SIN FILTROS/////        
    public function scopeAltoPasajerosRuta($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
    }

    public function scopeBajaPasajerosRuta($query,$periodo,$Row){
        return DB::table('DwPasajeros')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMayorPasajerosRuta($query,$periodo,$Row,$Monto){
        $having= 'count(*) > '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeMenorPasajerosRuta($query,$periodo,$Row,$Monto){
        $having= 'count(*) < '.$Monto;
        return DB::table('DwPasajeros')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('count(*) as `total`'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('DwVuelos.salida','>=',$periodo->desde)
            ->whereDate('DwVuelos.salida','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
    }
}

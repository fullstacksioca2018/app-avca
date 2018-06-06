<?php

namespace App\Models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
    
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
        switch ($filtroV){
            case 'Abiertos':
                // return $periodo->desde."-".$periodo->hasta;
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.destino_id',$destino)
    				->whereDate('salida','>=',$periodo->desde)
    				->whereDate('salida','<=',$periodo->hasta)
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
        switch ($filtroV){
            case 'Abiertos':
                // return $periodo->desde."-".$periodo->hasta;
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
    				->whereDate('salida','>=',$periodo->desde)
    				->whereDate('salida','<=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelados':
                return DB::table('DwVuelos')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorados':
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                    ->where('DwRutas.origen_id',$origen)
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutados':
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
            switch ($filtroV){
                case 'Abiertos':
                    // return $periodo->desde."-".$periodo->hasta;
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('salida','>=',$periodo->desde)
                        ->whereDate('salida','<=',$periodo->hasta)
                        ->count();
                    break;
                case 'Cancelados':
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->where('DwVuelos.estado','cancelado')
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Demorados':
                    return DB::table('DwDemorados')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta_id)
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Ejecutados':
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
            switch ($filtroV){
                case 'Abiertos':
                    // return $periodo->desde."-".$periodo->hasta;
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('salida','>=',$periodo->desde)
                        ->whereDate('salida','<=',$periodo->hasta)
                        ->count();
                    break;
                case 'Cancelados':
                    return DB::table('DwVuelos')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->where('DwVuelos.estado','cancelado')
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Demorados':
                    return DB::table('DwDemorados')
                        ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                        ->where('DwVuelos.ruta_id',$ruta2[0])
                        ->orWhere('DwVuelos.ruta_id',$ruta2[1])
                        ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                        ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                        ->count();
                break;
                case 'Ejecutados':
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
        switch ($filtroV){
            case 'Abiertos':
                // return $periodo->desde."-".$periodo->hasta;
                return DB::table('DwVuelos')
                    ->whereDate('salida','>=',$periodo->desde)
                    ->whereDate('salida','<=',$periodo->hasta)
                    ->count();
                break;
            case 'Cancelados':
                return DB::table('DwVuelos')
                    ->where('DwVuelos.estado','cancelado')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Demorados':
                return DB::table('DwDemorados')
                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwDemorados.vuelo_id')
                    ->whereDate('DwVuelos.fecha_cambio_estado','>=',$periodo->desde)
                    ->whereDate('DwVuelos.fecha_cambio_estado','<=',$periodo->hasta)
                    ->count();
            break;
            case 'Ejecutados':
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
}

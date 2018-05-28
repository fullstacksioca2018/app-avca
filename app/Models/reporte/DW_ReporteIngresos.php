<?php

namespace App\models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\reporte\DW_Ruta;
use Carbon\Carbon;

class DW_ReporteIngresos extends Model
{


    public function scopePorFecha($query,$desde,$hasta){
        if($desde==$hasta){
            $auxCarbo=Carbon::parse($desde);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $hasta=$dateF;
            $auxCarbo->subDays(7);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $desde=$dateF;
        }
        return DB::table('dwingresos')
                ->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
                ->whereDate('dwingresos.fecha_ingreso','>=',$desde)
                ->whereDate('dwingresos.fecha_ingreso','<=',$hasta)
                ->groupBy('dwingresos.fecha_ingreso')
                ->get();
    }

    public function scopePorRutaFecha($query,$desde,$hasta,$ruta_id){
    	$ruta=DW_Ruta::find($ruta_id);
        if($desde==$hasta){
            $auxCarbo=Carbon::parse($desde);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $hasta=$dateF;
            $auxCarbo->subDays(7);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $desde=$dateF;
        }
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
            return DB::table('dwingresos')
        		->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta_id)
                ->whereDate('dwingresos.fecha_ingreso','>=',$desde)
        		->whereDate('dwingresos.fecha_ingreso','<=',$hasta)
                ->groupBy('dwingresos.fecha_ingreso')
                ->get();
        }
        else{
            return DB::table('dwingresos')
                ->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
                ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
                ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
                ->where('DwRutas.ruta_id',$ruta2[0])
                ->orWhere('DwRutas.ruta_id',$ruta2[1])
                ->whereDate('dwingresos.fecha_ingreso','>=',$desde)
                ->whereDate('dwingresos.fecha_ingreso','<=',$hasta)
                ->groupBy('dwingresos.fecha_ingreso')
                ->get();
        }

    }

    public function scopePorOrigenFecha($query,$desde,$hasta,$origen){
        if($desde==$hasta){
            $auxCarbo=Carbon::parse($desde);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $hasta=$dateF;
            $auxCarbo->subDays(7);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $desde=$dateF;
        }
        return DB::table('dwingresos')
            ->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.origen_id',$origen)
            ->whereDate('dwingresos.fecha_ingreso','>=',$desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$hasta)
            ->groupBy('dwingresos.fecha_ingreso')
            ->get();

    }

    public function scopePorDestinoFecha($query,$desde,$hasta,$destino){
        if($desde==$hasta){
            $auxCarbo=Carbon::parse($desde);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $hasta=$dateF;
            $auxCarbo->subDays(7);
            $dateF=$auxCarbo->year."-".$auxCarbo->month."-".$auxCarbo->day;
            $desde=$dateF;
        }
        return DB::table('dwingresos')
            ->select('fecha_ingreso', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->where('DwRutas.destino_id',$destino)
            ->whereDate('dwingresos.fecha_ingreso','>=',$desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$hasta)
            ->groupBy('dwingresos.fecha_ingreso')
            ->get();
    }

    public function scopeAltoRutaIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeBajaRutaIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeMayorRutaIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) > '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('AVG(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }
    public function scopeMenorRutaIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) < '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwRutas.ruta_id as ruta_id', DB::raw('AVG(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwRutas.ruta_id')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }


    //ORIGEN//////
    ///////////////ORIGEN
    //ORIGEN//////
    ///////////////ORIGEN
    public function scopeAltoOrigenIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeBajaOrigenIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeMayorOrigenIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) > '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }
    public function scopeMenorOrigenIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) < '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.origen_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }

    //DESTINO//////
    ///////////////DESTINO
    //DESTINO//////
    ///////////////DESTINO
    public function scopeAltoDestinoIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeBajaDestinoIngreso($query,$periodo,$Row){
        return DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->orderBy('total', 'asc')
            ->limit($Row)
            ->get();
        return "algo";   
    }
    public function scopeMayorDestinoIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) > '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }
    public function scopeMenorDestinoIngreso($query,$periodo,$Row,$Monto){
        $having= 'AVG(dwingresos.monto) < '.$Monto;
        $datos=DB::table('dwingresos')
            ->select('DwSucursales.nombre', DB::raw('SUM(dwingresos.monto) as total'))
            ->join('DwBoletos', 'DwBoletos.ingreso_id', '=', 'dwingresos.ingreso_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
            ->join('DwSucursales', 'DwSucursales.sucursal_id', '=', 'DwRutas.destino_id')
            ->whereDate('dwingresos.fecha_ingreso','>=',$periodo->desde)
            ->whereDate('dwingresos.fecha_ingreso','<=',$periodo->hasta)
            ->groupBy('DwSucursales.nombre')
            ->havingRaw($having)
            ->orderBy('total', 'desc')
            ->limit($Row)
            ->get();
        return $datos;
        // return "algo";   
    }

}

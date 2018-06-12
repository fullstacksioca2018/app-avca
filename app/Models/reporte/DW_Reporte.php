<?php

namespace App\models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\reporte\DW_Cargo;
use App\Models\reporte\DW_Sucursal;
use stdClass;

class DW_Reporte extends Model
{
    public function scopeAsistenciaGeneral($query,$periodo){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeLicenciaGeneral($query,$periodo){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeSucursalAsistencia($query,$periodo,$sucursal){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('sucursal_id',$sucursal->sucursal_id)
            ->where('dwasistencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeSucursalLicencia($query,$periodo,$sucursal){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('sucursal_id',$sucursal->sucursal_id)
            ->where('dwlicencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeCargoAsistencia($query,$periodo,$cargo){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('cargo_id',$cargo->cargo_id)
            ->where('dwasistencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeCargoLicencia($query,$periodo,$cargo){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('cargo_id',$cargo->cargo_id)
            ->where('dwlicencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeSucursalCargoAsistencia($query,$periodo,$cargo,$sucursal){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwasistencias.porcentaje) as total'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('cargo_id',$cargo->cargo_id)
            ->where('sucursal_id',$sucursal->sucursal_id)
            ->where('dwasistencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeSucursalCargoLicencia($query,$periodo,$cargo,$sucursal){
    	return DB::table('dwempleados')
            ->select(DB::raw('AVG(dwlicencias.porcentaje) as total'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->where('cargo_id',$cargo->cargo_id)
            ->where('sucursal_id',$sucursal->sucursal_id)
            ->where('dwlicencias.fecha_id',$periodo)
            ->get();
    }
    public function scopeSucursalesAsistenciaAlta($query,$periodo,$Row){
    	return DB::table('dwempleados')
	        ->select('dwsucursales.nombre as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
	        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	        ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	        ->where('dwasistencias.fecha_id',$periodo)
	        ->groupBy('dwsucursales.nombre')
	        ->orderBy('data', 'desc')
	        ->limit($Row)
	        ->get();
    }
    public function scopeSucursalesAsistenciaBaja($query,$periodo,$Row){
    	return DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->orderBy('data', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeSucursalesAsistenciaMayor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwasistencias.porcentaje) > '.$Monto;
        $sucursales=DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $sucursales;
    }
    public function scopeSucursalesAsistenciaMenor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwasistencias.porcentaje) < '.$Monto;
        $sucursales=DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $sucursales;
    }
    public function scopeCargosAsistenciaAlta($query,$periodo,$Row){
    	return DB::table('dwempleados')
	        ->select('dwcargos.titulo as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
	        ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	        ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	        ->where('dwasistencias.fecha_id',$periodo)
	        ->groupBy('dwcargos.titulo')
	        ->orderBy('data', 'desc')
	        ->limit($Row)
	        ->get();
    }
    public function scopeCargosAsistenciaBaja($query,$periodo,$Row){
    	return DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->orderBy('data', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeCargosAsistenciaMayor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwasistencias.porcentaje) > '.$Monto;
        $cargos=DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $cargos;
    }
    public function scopeCargosAsistenciaMenor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwasistencias.porcentaje) < '.$Monto;
        $cargos=DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwasistencias.porcentaje) as data'))
            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwasistencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $cargos;
    }
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
			//REPORTES.......... DE............ LICENCIAS
    
    public function scopeSucursalesLicenciaAlta($query,$periodo,$Row){
    	return DB::table('dwempleados')
	        ->select('dwsucursales.nombre as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
	        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	        ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	        ->where('dwlicencias.fecha_id',$periodo)
	        ->groupBy('dwsucursales.nombre')
	        ->orderBy('data', 'desc')
	        ->limit($Row)
	        ->get();
    }
    public function scopeSucursalesLicenciaBaja($query,$periodo,$Row){
    	return DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->orderBy('data', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeSucursalesLicenciaMayor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwlicencias.porcentaje) > '.$Monto;
        $sucursales=DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $sucursales;
    }
    public function scopeSucursalesLicenciaMenor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwlicencias.porcentaje) < '.$Monto;
        $sucursales=DB::table('dwempleados')
            ->select('dwsucursales.nombre as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwsucursales.nombre')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $sucursales;
    }
    public function scopeCargosLicenciaAlta($query,$periodo,$Row){
    	return DB::table('dwempleados')
	        ->select('dwcargos.titulo as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
	        ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	        ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	        ->where('dwlicencias.fecha_id',$periodo)
	        ->groupBy('dwcargos.titulo')
	        ->orderBy('data', 'desc')
	        ->limit($Row)
	        ->get();
    }
    public function scopeCargosLicenciaBaja($query,$periodo,$Row){
    	return DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->orderBy('data', 'asc')
            ->limit($Row)
            ->get();
    }
    public function scopeCargosLicenciaMayor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwlicencias.porcentaje) > '.$Monto;
        $cargos=DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $cargos;
    }
    public function scopeCargosLicenciaMenor($query,$periodo,$Row,$Monto){
    	$having= 'AVG(dwlicencias.porcentaje) < '.$Monto;
        $cargos=DB::table('dwempleados')
            ->select('dwcargos.titulo as label', DB::raw('AVG(dwlicencias.porcentaje) as data'))
            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
            ->where('dwlicencias.fecha_id',$periodo)
            ->groupBy('dwcargos.titulo')
            ->havingRaw($having)
            ->orderBy('data', 'desc')
            ->limit($Row)
            ->get();
        return $cargos;
    }

    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
    		//REPORTES.......... DE......BUSCAR ....AUSENCIAS
	public function scopeSucursalesAusenciaAlta($query,$periodo,$Row){
    	$sucursales=DW_Sucursal::select("sucursal_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            array_push($label, $asistencia[0]->nombre);
            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Suc. ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeSucursalesAusenciaBaja($query,$periodo,$Row){
    	$sucursales=DW_Sucursal::select("sucursal_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            array_push($label, $asistencia[0]->nombre);
            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] < $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Suc. ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeSucursalesAusenciaMayor($query,$periodo,$Row,$Monto){
    	$sucursales=DW_Sucursal::select("sucursal_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
	        if(((100-$asistencia[0]->total-$licencia[0]->total))>$Monto){
	            array_push($label, $asistencia[0]->nombre);
	            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
	        }
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Suc. ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeSucursalesAusenciaMenor($query,$periodo,$Row,$Monto){
    	$sucursales=DW_Sucursal::select("sucursal_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwsucursales.nombre',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwsucursales', 'dwsucursales.sucursal_id', '=', 'dwempleados.sucursal_id')
	            ->where('dwempleados.sucursal_id',$key->sucursal_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwsucursales.nombre')
	            ->get();
	        if(((100-$asistencia[0]->total-$licencia[0]->total))<$Monto){
	            array_push($label, $asistencia[0]->nombre);
	            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
	        }
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Suc. ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeCargosAusenciaAlta($query,$periodo,$Row){
    	$cargos=DW_Cargo::select("cargo_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($cargos as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            array_push($label, $asistencia[0]->titulo);
            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Cargo ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeCargosAusenciaBaja($query,$periodo,$Row){
    	$cargos=DW_Cargo::select("cargo_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            array_push($label, $asistencia[0]->titulo);
            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] < $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Cargo ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeCargosAusenciaMayor($query,$periodo,$Row,$Monto){
    	$cargos=DW_Cargo::select("cargo_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($cargos as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
	        if(((100-$asistencia[0]->total-$licencia[0]->total))>$Monto){
	            array_push($label, $asistencia[0]->titulo);
	            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
	        }
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia: Cargo ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
    public function scopeCargosAusenciaMenor($query,$periodo,$Row,$Monto){
    	$cargos=DW_Cargo::select("cargo_id")->get();
    	$obj= new stdClass();
    	$resul= new stdClass();
    	$label=array();
    	$data=array();
    	$labelR=array();
    	$dataR=array();
    	foreach ($sucursales as $key) {
    		$asistencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwasistencias.porcentaje) as total'))
	            ->join('dwasistencias', 'dwasistencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwasistencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
            $licencia=DB::table('dwempleados')
	            ->select('dwcargos.titulo',DB::raw('AVG(dwlicencias.porcentaje) as total'))
	            ->join('dwlicencias', 'dwlicencias.empleado_id', '=', 'dwempleados.empleado_id')
	            ->join('dwcargos', 'dwcargos.cargo_id', '=', 'dwempleados.cargo_id')
	            ->where('dwempleados.cargo_id',$key->cargo_id)
	            ->where('dwlicencias.fecha_id',$periodo)
            	->groupBy('dwcargos.titulo')
	            ->get();
	        if(((100-$asistencia[0]->total-$licencia[0]->total))<$Monto){
	            array_push($label, $asistencia[0]->titulo);
	            array_push($data, (100-$asistencia[0]->total-$licencia[0]->total));
	        }
    	}
    	for ($i = 1; $i < (count($label)); $i++)
        {
                 $v = $data[$i];
                 $v2 = $label[$i];
                 $j = $i - 1;
                 while ($j >= 0 && $data[$j] > $v)
                 {
                          $data[$j + 1] = $data[$j];
                          $label[$j + 1] = $label[$j];
                          $j--;
                 }
 
                 $data[$j + 1] = $v;
                 $label[$j + 1] = $v2;
        }
        for ($i=0; $i < $Row; $i++) { 
        	$auxlabel="Ausencia Cargo ".$label[$i];
        	array_push($labelR, $auxlabel);
            array_push($dataR, $data[$i]);
        }
        $obj->label=$labelR;
        $obj->data=$dataR;
        return $obj;
    }
}

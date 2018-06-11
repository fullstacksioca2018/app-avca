<?php

namespace App\models\reporte;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DW_Pasajero extends Model
{
    protected $table = "DwPasajeros";
    protected $primaryKey = "pasajero_id";
    protected $fillable = [
		'fecha_nacimiento'
		,'genero'
		,'discapacidad'
    ];
    
	public function scopeOrigenEdadMuestra($query,$origen,$filtroP){
		$result=array();
		switch ($filtroP){
            case 'Bebe':
				for($year=2016;$year<=Carbon::now()->year;$year++){
					$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
                	$fechaLimite=$hasta->copy();
                	$fechaLimite->subYears(2);
                	$datos = DB::table('DwPasajeros')
            			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        			->where('DwRutas.origen_id',$origen)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$hasta)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Niños':
				for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(12);
	                $fechaLimiteH->subYears(2);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.origen_id',$origen)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
				}
				return $result;
            break;
            case 'Adolecente':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(18);
	                $fechaLimiteH->subYears(12);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.origen_id',$origen)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Adulto':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteH->subYears(18);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.origen_id',$origen)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
        }

	}
	public function scopeGeneroOrigenMuestra($query,$origen,$genero){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        ->where('DwRutas.origen_id',$origen)
	        ->where('DwPasajeros.genero',$genero)
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeOrigenMuestra($query,$origen){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        ->where('DwRutas.origen_id',$origen)
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}




	public function scopeDestinoEdadMuestra($query,$destino,$filtroP){
		$result=array();
		switch ($filtroP){
            case 'Bebe':
				for($year=2016;$year<=Carbon::now()->year;$year++){
					$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
                	$fechaLimite=$hasta->copy();
                	$fechaLimite->subYears(2);
                	$datos = DB::table('DwPasajeros')
            			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        			->where('DwRutas.destino_id',$destino)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$hasta)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Niños':
				for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(12);
	                $fechaLimiteH->subYears(2);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.destino_id',$destino)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
				}
				return $result;
            break;
            case 'Adolecente':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(18);
	                $fechaLimiteH->subYears(12);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.destino_id',$destino)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Adulto':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteH->subYears(18);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	                    ->where('DwRutas.destino_id',$destino)
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
        }

	}
	public function scopeGeneroDestinoMuestra($query,$destino,$genero){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        ->where('DwRutas.destino_id',$destino)
	        ->where('DwPasajeros.genero',$genero)
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeDestinoMuestra($query,$destino){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->join('DwRutas', 'DwRutas.ruta_id', '=', 'DwVuelos.ruta_id')
	        ->where('DwRutas.destino_id',$destino)
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}





	public function scopeRutaEdadMuestra($query,$ruta_id,$filtroP){
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
		$result=array();
        if(count($ruta2)==1){
        	switch ($filtroP){
	            case 'Bebe':
					for($year=2016;$year<=Carbon::now()->year;$year++){
						$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
	                	$fechaLimite=$hasta->copy();
	                	$fechaLimite->subYears(2);
	                	$datos = DB::table('DwPasajeros')
	            			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		        			->where('DwVuelos.ruta_id',$ruta_id)
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$hasta)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
					return $result;
	            break;
	            case 'Niños':
					for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteD=$hasta->copy();
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteD->subYears(12);
		                $fechaLimiteH->subYears(2);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta_id)
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
							foreach ($datos as $key => $data) {
								array_push($result, $data->total);
							}
					}
					return $result;
	            break;
	            case 'Adolecente':
	            	for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteD=$hasta->copy();
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteD->subYears(18);
		                $fechaLimiteH->subYears(12);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta_id)
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
					return $result;
	            break;
	            case 'Adulto':
	            	for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteH->subYears(18);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta_id)
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
	            break;
	        }
        }
        else{
        	switch ($filtroP){
	            case 'Bebe':
					for($year=2016;$year<=Carbon::now()->year;$year++){
						$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
	                	$fechaLimite=$hasta->copy();
	                	$fechaLimite->subYears(2);
	                	$datos = DB::table('DwPasajeros')
	            			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		        			->where('DwVuelos.ruta_id',$ruta2[0])
                			->orWhere('DwVuelos.ruta_id',$ruta2[1])
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$hasta)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
					return $result;
	            break;
	            case 'Niños':
					for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteD=$hasta->copy();
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteD->subYears(12);
		                $fechaLimiteH->subYears(2);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta2[0])
                			->orWhere('DwVuelos.ruta_id',$ruta2[1])
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
							foreach ($datos as $key => $data) {
								array_push($result, $data->total);
							}
					}
					return $result;
	            break;
	            case 'Adolecente':
	            	for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteD=$hasta->copy();
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteD->subYears(18);
		                $fechaLimiteH->subYears(12);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta2[0])
                			->orWhere('DwVuelos.ruta_id',$ruta2[1])
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
					return $result;
	            break;
	            case 'Adulto':
	            	for($year=2016;$year<=Carbon::now()->year;$year++){
		            	$desde=Carbon::parse("01-01-".$year);
						$hasta=Carbon::parse("31-12-".$year);
		                $fechaLimiteH=$hasta->copy();
		                $fechaLimiteH->subYears(18);
		                $datos = DB::table('DwPasajeros')
		            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
		                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
		                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		                    ->where('DwVuelos.ruta_id',$ruta2[0])
                			->orWhere('DwVuelos.ruta_id',$ruta2[1])
		                    ->whereDate('DwVuelos.salida','>=',$desde)
		                    ->whereDate('DwVuelos.salida','<=',$hasta)
		                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
		                    ->groupBy('month')
							->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
					}
	            break;
	        }
        }
		return $result;

	}
	public function scopeGeneroRutaMuestra($query,$ruta_id,$genero){
		$result=array();
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
		$result=array();
        if(count($ruta2)==1){
        	$datos = DB::table('DwPasajeros')
				->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
	            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		        ->where('DwVuelos.ruta_id',$ruta_id)
		        ->where('DwPasajeros.genero',$genero)
	            ->groupBy('month','year')
				->get();
        }
        else{
        	$datos = DB::table('DwPasajeros')
				->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
	            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
                ->where('DwVuelos.ruta_id',$ruta2[0])
    			->orWhere('DwVuelos.ruta_id',$ruta2[1])
		        ->where('DwPasajeros.genero',$genero)
	            ->groupBy('month','year')
				->get();
        }
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeRutaMuestra($query,$ruta_id){
		$result=array();
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
			$datos = DB::table('DwPasajeros')
				->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
	            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		        ->where('DwVuelos.ruta_id',$ruta_id)
	            ->groupBy('month','year')
				->get();
        }
        else{
        	$datos = DB::table('DwPasajeros')
				->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
	            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
		        ->where('DwVuelos.ruta_id',$ruta2[0])
    			->orWhere('DwVuelos.ruta_id',$ruta2[1])
	            ->groupBy('month','year')
				->get();
        }
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}


	public function scopeEdadMuestra($query,$filtroP){
		$result=array();
		switch ($filtroP){
            case 'Bebe':
				for($year=2016;$year<=Carbon::now()->year;$year++){
					$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
                	$fechaLimite=$hasta->copy();
                	$fechaLimite->subYears(2);
                	$datos = DB::table('DwPasajeros')
            			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimite)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$hasta)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Niños':
				for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(12);
	                $fechaLimiteH->subYears(2);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
						foreach ($datos as $key => $data) {
							array_push($result, $data->total);
						}
				}
				return $result;
            break;
            case 'Adolecente':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteD=$hasta->copy();
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteD->subYears(18);
	                $fechaLimiteH->subYears(12);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','>=',$fechaLimiteD)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
				return $result;
            break;
            case 'Adulto':
            	for($year=2016;$year<=Carbon::now()->year;$year++){
	            	$desde=Carbon::parse("01-01-".$year);
					$hasta=Carbon::parse("31-12-".$year);
	                $fechaLimiteH=$hasta->copy();
	                $fechaLimiteH->subYears(18);
	                $datos = DB::table('DwPasajeros')
	            		->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month'))
	                    ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
	                    ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	                    ->whereDate('DwVuelos.salida','>=',$desde)
	                    ->whereDate('DwVuelos.salida','<=',$hasta)
	                    ->whereDate('DwPasajeros.fecha_nacimiento','<=',$fechaLimiteH)
	                    ->groupBy('month')
						->get();
					foreach ($datos as $key => $data) {
						array_push($result, $data->total);
					}
				}
            break;
        }
		return $result;
    }
    public function scopeGeneroMuestra($query,$genero){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
	        ->where('DwPasajeros.genero',$genero)
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}
	public function scopeMuestra($query){
		$result=array();
		$datos = DB::table('DwPasajeros')
			->select(DB::raw('count(*) as `total`'),DB::raw('MONTH(DwVuelos.salida) month,YEAR(DwVuelos.salida) year'))
            ->join('DwBoletos', 'DwBoletos.pasajero_id', '=', 'DwPasajeros.pasajero_id')
            ->join('DwVuelos', 'DwVuelos.vuelo_id', '=', 'DwBoletos.vuelo_id')
            ->groupBy('month','year')
			->get();
		foreach ($datos as $key => $data) {
			array_push($result, $data->total);
		}
		return $result;
	}


}
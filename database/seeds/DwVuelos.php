<?php

use Illuminate\Database\Seeder;

class DwVuelos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/*
    		1=abierto
    		2=cancelado
    		3=demorado
    		4=ejecutado

    	 */
    	for($i=0;$i<1000; $i++){
    		$day=rand(1, 26);
    		$mont=rand(1, 12);
    		$year=rand(2016, 2018);
    		$fecha_creacion=$year."-".$mont."-".$day;
    		if(($mont+3)<=12){
    			$salida=$year."-".($mont+3)."-".$day;
    		}
    		else{
    			$salida=$year."-".$mont."-".($day+4);
    		}
    		if($year!=2018){
    			$numeroEstado=rand(2, 4);
    		}else{
    			if(date("j")>$day){
    				$numeroEstado=rand(2, 4);
    			}
    			else{
	    			if(date("n")<$mont){
	    				$numeroEstado=1;
	    			}
	    		}
    		}
    		switch ($numeroEstado) {
    			case 1:
    				$estado="abierto";
    				$fecha_cambio_estado=null;
    				break;
    			case 2:
    				$estado="cancelado";
	    			if(($mont+3)<=12){
		    			$fecha_cambio_estado=$year."-".($mont+2)."-".$day;
		    		}
		    		else{
		    			$fecha_cambio_estado=$year."-".$mont."-".($day+3);
		    		}
    				break;
    			case 3:
    				$estado="demorado";
		    		break;
    			case 4:
    				$estado="ejecutado";
    				$fecha_cambio_estado=$salida;
    				break;
    		}
    		if($numeroEstado!=3){
    			$ruta_id=random_int(1, 20);
				$aerolinea="AVCA";
				DB::table('DwVuelos')->insert([
					'ruta_id' => $ruta_id,
					'estado' => $estado,
			        'aerolinea' => $aerolinea,
			        'fecha_creacion' => $fecha_creacion,
			        'salida' => $salida,
			        'fecha_cambio_estado' => $fecha_cambio_estado,
		        ]);
    		}
    		else{
				$demora="00:".rand(10, 59).":00";
    			$fecha_cambio_estado=$salida;
				$ruta_id=random_int(1, 20);
				$aerolinea="AVCA";
				DB::table('DwVuelos')->insert([
					'ruta_id' => $ruta_id,
					'estado' => $estado,
			        'aerolinea' => $aerolinea,
			        'fecha_creacion' => $fecha_creacion,
			        'salida' => $salida,
			        'fecha_cambio_estado' => $fecha_cambio_estado,
		        ]);
		        DB::table('DwDemorados')->insert([
					'demora' => $demora,
					'vuelo_id' => ($i+1)
				]);
    		}
    	}
    }
}

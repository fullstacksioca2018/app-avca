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
                if($year!=2018){
                    $numeroEstado=rand(2, 4);
                }else{
                    if(date("n")<($mont+3)){
                        if(date("j")>$day){
                            $numeroEstado=rand(2, 4);
                        }
                        else{
                            $numeroEstado=1;
                        }
                    }
                    else{
                        $numeroEstado=rand(2, 4);
                    }
                }
    		}
    		else{
    			$salida=$year."-".$mont."-".($day+4);
                if($year!=2018){
                    $numeroEstado=rand(2, 4);
                }else{
                    if(date("n")<=$mont){
                        if(date("j")>($day+4)){
                            $numeroEstado=rand(2, 4);
                        }
                        else{
                            $numeroEstado=1;
                        }
                    }
                    else{
                        $numeroEstado=rand(2, 4);
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
					'estado' => 'ejecutado',
			        'aerolinea' => $aerolinea,
			        'fecha_creacion' => $fecha_creacion,
			        'salida' => $salida,
			        'fecha_cambio_estado' => $fecha_cambio_estado,
		        ]);
		        DB::table('DwDemorados')->insert([
                    'salida' => $salida,
					'vuelo_id' => ($i+1)
				]);
    		}
    	}


        for ($i=0; $i < 12; $i++) { 
            $ruta_id=random_int(1, 20);
            $aerolinea="AVCA";
            $day=16;
            $mont=5;
            $year=2018;
            $fecha_creacion=$year."-".$mont."-".$day;
            $salida=$year."-".$mont."-".$day." 11:00:00";
            DB::table('DwVuelos')->insert([
                'ruta_id' => $ruta_id,
                'estado' => "ejecutado",
                'aerolinea' => $aerolinea,
                'fecha_creacion' => $fecha_creacion,
                'salida' => $salida,
                'fecha_cambio_estado' => $salida,
            ]);
        }

         for ($i=0; $i < 123; $i++) {
            $ruta_id=random_int(1, 20);
            $day=rand(18, 31);
            $aerolinea="AVCA";
            $mont=5;
            $year=2018;
            $fecha_creacion=$year."-".($mont-2)."-".$day;
            $salida=$year."-".$mont."-".$day." 11:00:00";
            DB::table('DwVuelos')->insert([
                'ruta_id' => $ruta_id,
                'estado' => "abierto",
                'aerolinea' => $aerolinea,
                'fecha_creacion' => $fecha_creacion,
                'salida' => $salida,
                'fecha_cambio_estado' => $salida,
            ]);
        }

        for ($i=0; $i < 3; $i++) { 
            $ruta_id=random_int(1, 20);
            $day=rand(15, 17);
            $aerolinea="AVCA";
            $mont=5;
            $year=2018;
            $fecha_creacion=$year."-".($mont-3)."-".$day;
            $salida=$year."-".$mont."-".$day." 11:00:00";
            DB::table('DwVuelos')->insert([
                'ruta_id' => $ruta_id,
                'estado' => "retrasado",
                'aerolinea' => $aerolinea,
                'fecha_creacion' => $fecha_creacion,
                'salida' => $salida,
                'fecha_cambio_estado' => $salida,
            ]);
            DB::table('DwDemorados')->insert([
                'salida' => $salida,
                'vuelo_id' => (1135+$i+1)
            ]);
        }

    }
}

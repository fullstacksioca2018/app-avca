<?php

use Illuminate\Database\Seeder;

class DwAsistenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$cont=0;
    	for ($i=2016; $i < 2018; $i++) { 
            for ($j=1; $j < 13; $j++) { 
                DB::table('DwFechas')->insert([
                    'mes'      => $j,
                    'year'     => $i,
                ]);
                $cont++;
                for ($k=1; $k < 281; $k++) { 
                    $porcentaje=rand(60, 100);
                    $valor=100-$porcentaje;
                    $licencia=rand(0, $valor);
	    			DB::table('DwAsistencias')->insert([
			            'porcentaje'      => $porcentaje,
			            'fecha_id'     => $cont,
                        'empleado_id' => $k
			        ]);
                    DB::table('DwLicencias')->insert([
                        'porcentaje'      => $licencia,
                        'fecha_id'     => $cont,
                        'empleado_id' => $k
                    ]);
				}
    		}
    	}
    	for ($j=1; $j < 6; $j++) { 
    			DB::table('DwFechas')->insert([
		            'mes'      => $j,
		            'year'     => '2018',
		        ]);
                $cont++;
                for ($k=1; $k < 281; $k++) { 
                    $porcentaje=rand(70, 100);
                    $valor=100-$porcentaje;
                    $licencia=rand(0, $valor);
	    			DB::table('DwAsistencias')->insert([
			            'porcentaje'      => $porcentaje,
			            'fecha_id'     => $cont,
                        'empleado_id' => $k
			        ]);
                    DB::table('DwLicencias')->insert([
                        'porcentaje'      => $licencia,
                        'fecha_id'     => $cont,
                        'empleado_id' => $k
                    ]);
				}
    		}
        
    }
}

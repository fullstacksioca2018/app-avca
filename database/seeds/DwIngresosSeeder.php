<?php

use Illuminate\Database\Seeder;

class DwIngresosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<2000; $i++){
    		$day=rand(1, 26);
    		$mont=rand(1, 12);
    		$year=rand(2016, 2018);
    		$monto=rand(16, 45);
    		$monto=$monto*150;
    		$fecha_ingreso=$year."-".$mont."-".$day;
	        DB::table('DwIngresos')->insert([
	            [
	                'monto'               => $monto,
	                'fecha_ingreso'      => $fecha_ingreso
	            ],
	        ]);
            $ind=rand(1, 5);
            for ($boleto=0; $boleto <$ind ; $boleto++) { 
                $pasajero=rand(1, 1000);
                $vuelo_id=rand(1, 1138);
                DB::table('DwBoletos')->insert([
                    [
                        'pasajero_id'  => $pasajero,
                        'vuelo_id'     => $vuelo_id,
                        'ingreso_id'   => ($i+1),
                        'fecha_compra' => $fecha_ingreso
                    ],
                ]);
            }
    	}

        for($i=0;$i<10; $i++){
            $day=rand(15, 31);
            $mont=5;
            $year=2018;
            $monto=rand(16, 45);
            $monto=$monto*150;
            $fecha_ingreso=$year."-".$mont."-".$day;
            DB::table('DwIngresos')->insert([
                [
                    'monto'               => $monto,
                    'fecha_ingreso'      => $fecha_ingreso
                ],
            ]);
            $ind=rand(1, 5);
            for ($boleto=0; $boleto <$ind ; $boleto++) { 
                $pasajero=rand(1, 1000);
                $vuelo_id=rand(1, 1138);
                DB::table('DwBoletos')->insert([
                    [
                        'pasajero_id'  => $pasajero,
                        'vuelo_id'     => $vuelo_id,
                        'ingreso_id'   => ($i+2000),
                        'fecha_compra' => $fecha_ingreso
                    ],
                ]);
            }
        }

        for($i=0;$i<20; $i++){
            $day=rand(1, 11);
            $mont=6;
            $year=2018;
            $monto=rand(16, 45);
            $monto=$monto*250;
            $fecha_ingreso=$year."-".$mont."-".$day;
            DB::table('DwIngresos')->insert([
                [
                    'monto'               => $monto,
                    'fecha_ingreso'      => $fecha_ingreso
                ],
            ]);
            $ind=rand(1, 5);
            for ($boleto=0; $boleto <$ind ; $boleto++) { 
                $pasajero=rand(1, 1000);
                $vuelo_id=rand(1, 1138);
                DB::table('DwBoletos')->insert([
                    [
                        'pasajero_id'  => $pasajero,
                        'vuelo_id'     => $vuelo_id,
                        'ingreso_id'   => ($i+2010),
                        'fecha_compra' => $fecha_ingreso
                    ],
                ]);
            }
        }

        


    }
}

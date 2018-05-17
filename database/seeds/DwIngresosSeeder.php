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
    	}

        for($i=0;$i<30; $i++){
            $day=rand(14, 18);
            $monto=5;
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
        }


    }
}

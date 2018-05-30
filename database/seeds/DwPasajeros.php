<?php

use Illuminate\Database\Seeder;

class DwPasajeros extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 200; $i++) { 
        	$day=rand(1, 26);
    		$mont=rand(1, 12);
    		$year=rand(1955, 2018);
    		$fecha_nacimiento=$year."-".$mont."-".$day;
    		$aux=rand(1, 3);
    		if($aux>2)
    			$genero="F";
    		else
    			$genero="M";
    		$aux=rand(1, 3);
    		if($aux>2)
    			$discapacidad="Si";
    		else
    			$discapacidad="No";
        	DB::table('DwPasajeros')->insert([
	            [
	                'fecha_nacimiento'     => $fecha_nacimiento,
	                'genero'   => $genero,
	                'discapacidad' => $discapacidad
	            ],
	        ]);
        }
    }
}

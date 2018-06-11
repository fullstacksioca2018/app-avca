<?php

use Illuminate\Database\Seeder;

class ConceptoEmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //primeros empleados
    $arreglo = [ 1,2,3,4,10,12,16,21,22,23,24,25,26,27,29];


    for ($i=1 ; $i < 17; $i++){
        for ($e=0 ; $e < count($arreglo); $e++){

         DB::table('concepto_empleado')->insert([
           
            'empleado_id' => $i,
            'concepto_id' => $arreglo[$e],
          ]);
        }
     }

        
        //empleados administrativos
	$arreglo = [ 1,2,3,4,10,12,16,21,22,23,24,25,26,27,29];


	for ($i=17 ; $i < 27; $i++){
		for ($e=0 ; $e < count($arreglo); $e++){

         DB::table('concepto_empleado')->insert([
           
            'empleado_id' => $i,
            'concepto_id' => $arreglo[$e],
      	  ]);
     	}
     }

           //empleados diurnos 
	$arreglo1 = [ 1,2,3,4,5,10,11,15,16,17,18,21,22,23,24,25,26,27,29];


	for ($i=27 ; $i < 37; $i++){
		for ($e=0 ; $e < count($arreglo1); $e++){

         DB::table('concepto_empleado')->insert([
           
            'empleado_id' => $i,
            'concepto_id' => $arreglo1[$e],
      	  ]);
     	}
     }

            //empleados Nocturnos
	$arreglo2 = [ 1,2,3,4,5,10,11,15,16,19,20,21,22,23,24,25,26,28,30];


	for ($i=37 ; $i < 47; $i++){
		for ($e=0 ; $e < count($arreglo2); $e++){

         DB::table('concepto_empleado')->insert([
           
            'empleado_id' => $i,
            'concepto_id' => $arreglo2[$e],
      	  ]);
     	}
     }

    

    }
}

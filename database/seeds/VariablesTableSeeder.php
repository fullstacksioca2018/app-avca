<?php

use Illuminate\Database\Seeder;

class VariablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

  DB::table('variables')->insert([
            
		
       			'nombre' => 'Unidad Tributaria',
         	   	 
            'monto_fijo' => '850.00',
            'base_calculo' => 61            
            
        ]);

      


            	
    }
}

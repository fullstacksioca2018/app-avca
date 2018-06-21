<?php

use Illuminate\Database\Seeder;

class CargafamiliarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	 
             DB::table('carga_familiar')->insert([
            [
             
           	'nombre' => 'ines',
            'apellido' => 'machado',
            'cedula_beneficiario' => '28213421',
            'fecha_nacimiento' => '2017-10-04',
            'estatus' => true,
            'genero' => 'f',
            'parentesco' => 'hijos',
            'empleado_id' => 6

            ],
            [
             
           	'nombre' => 'ivan',
            'apellido' => 'machado',
            'cedula_beneficiario' => '29213422',
            'fecha_nacimiento' => '2018-02-02',
            'estatus' => true,
            'genero' => 'm',
            'parentesco' => 'hijos',
            'empleado_id' => 6

            ],
        ]);


    }
}

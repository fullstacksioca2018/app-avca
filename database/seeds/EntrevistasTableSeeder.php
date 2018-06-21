<?php

use Illuminate\Database\Seeder;

class EntrevistasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entrevistas')->insert([
            [ 
              'presentacion' => 'excelente', 
              'inteligencia' => 'excelente', 
                 'formacion' => 'excelente', 
               'experiencia' => 'excelente', 
       'facilidad_expresion' => 'excelente', 
                 'habilidad' => 'excelente', 
                     'otros' => 'excelente',
             'observaciones' => 'Persona apta para el cargo',
              'aspirante_id' => 5
            ]
            
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;

class SegmentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
         factory(App\Models\operativo\Segmento::class,20)->create();

         DB::table('segmentos')->insert([
            'aeronave_id' => '1',
            'ruta_id' => '21',
            'vuelo_id' => '21',
        ]);

         DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '22',
            'vuelo_id' => '22',
        ]);

         DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '23',
            'vuelo_id' => '23',
        ]);

    }
}

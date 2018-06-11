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
    	
       /* factory(App\Models\operativo\Segmento::class,20)->create();
        $ruta_id = DB::table('rutas')->orderBy('id')->get();
        for ($i=0;$i<20;$i++){
        DB::table('segmentos')->insert([
            'aeronave_id' => rand(1,5),
            'ruta_id' => $ruta_id[$i]->id,
            'vuelo_id' => ($i+1),
        ]);}*/

       

          DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '21',
            'vuelo_id' => '1',
        ]);

         DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '22',
            'vuelo_id' => '2',
        ]);

        DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '23',
            'vuelo_id' => '3',
        ]);

    }
}

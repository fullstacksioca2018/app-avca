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
    	
        // factory(App\Models\operativo\Segmento::class,20)->create();
        $ruta_id = DB::table('rutas')->select('id')->find(20);
        for ($i=0;$i>20;$i++){
        DB::table('segmentos')->insert([
            'aeronave_id' => mt_rand(1,20),
            'ruta_id' => $ruta_id[$i],
            'vuelo_id' => mt_rand(1,20),
        ]);}

         /* DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '22',
            'vuelo_id' => '22',
        ]);

         DB::table('segmentos')->insert([
            'aeronave_id' => '2',
            'ruta_id' => '23',
            'vuelo_id' => '23',
        ]); */

    }
}

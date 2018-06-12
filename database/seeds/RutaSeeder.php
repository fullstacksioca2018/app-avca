<?php

use Illuminate\Database\Seeder;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\operativo\Ruta::class,20)->create([

        	 'tarifa_vuelo' => '4500',
             'duracion'    =>  '00:40:00'

        ]);

         DB::table('rutas')->insert([
            'distancia' => '4999',
            'sigla' => 'CCS-MAR',
            'duracion' => '00:40:00',
            'tarifa_vuelo' => '4500',
            'origen_id' => '1',
            'destino_id' => '2',
            'estado'    =>  'activo'
        ]);

         DB::table('rutas')->insert([
            'distancia' => '4999',
            'sigla' => 'MAR-CCS',
            'duracion' => '00:40:00',
            'tarifa_vuelo' => '4500',
            'origen_id' => '2',
            'destino_id' => '1',
            'estado'    =>  'activo'
        ]);

         DB::table('rutas')->insert([
            'distancia' => '4999',
            'sigla' => 'CCS-VLN',
            'duracion' => '00:40:00',
            'tarifa_vuelo' => '4500',
            'origen_id' => '1',
            'destino_id' => '3',
            'estado'    =>  'activo'
        ]);
    }
}

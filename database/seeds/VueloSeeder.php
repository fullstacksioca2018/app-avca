<?php

use Illuminate\Database\Seeder;

class VueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\operativo\Vuelo::class, 20)->create();

        DB::table('vuelos')->insert([
			'estado' => 'abierto',
			'fecha_salida' => '2018-05-12 1:10:34',
	        'n_vuelo' => 'VH-2131',
        ]);

        DB::table('vuelos')->insert([
			'estado' => 'abierto',
			'fecha_salida' => '2018-05-15 20:38:34',
	        'n_vuelo' => 'VH-2231',
        ]);

        DB::table('vuelos')->insert([
            'estado' => 'abierto',
            'fecha_salida' => '2018-05-23 14:58:34',
            'n_vuelo' => 'VH-2431',
        ]);
        
    }
}            
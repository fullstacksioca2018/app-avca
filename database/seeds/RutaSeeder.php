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
      /*   factory(App\Models\operativo\Ruta::class,20)->create([

            
            
            'distancia' => ,
            'sigla' => 'CCS-MAR',
            'duracion' => '00:40:00',
            'tarifa_vuelo' => '4500',
            'origen_id' => '1',
            'destino_id' => '2',
            'estado'    =>  'activo'

        ]);  */

        for($i=0; $i<20; $i++){
        $origen = DB::table('sucursales')->where('sucursales_id','=',rand(1,29));
        $destino = DB::table('sucursales')->where('sucursales_id','=',rand(1,29));
        if(($origen->id)==($destino->id)){ $destino = DB::table('sucursales')->where('sucursales_id','=',rand(1,29));} 
        DB::table('rutas')->insert([
            'distancia' => mt_rand(1,500),
            'sigla' => $origen->sigla.'-'.$destino->sigla,
            'duracion' => '00:'.rand(10,50).':00',
            'tarifa_vuelo' => mt_rand(1000,5000),
            'origen_id' => $origen->id,
            'destino_id' => $destino->id,
            'estado'    =>  'activo'
        ]);
         }
        /*
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
        ]); */
    }
}

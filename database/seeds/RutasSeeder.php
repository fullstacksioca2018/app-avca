<?php

use Illuminate\Database\Seeder;
use \App\Models\operativo\Sucursal;

class RutasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //CREAR RUTA
        //
      
       
        $siglas1=Sucursal::find('1')->sigla;//origen
       
        for($i=2;$i<=16;$i++){
         $siglas2=Sucursal::find(''.$i)->sigla; //destino
         $siglas=$siglas1."-".$siglas2;
         DB::table('rutas')->insert([
             'distancia' => '160',
             'tarifa_vuelo' => '180000',
             'duracion' => "00:40:00",
             'sigla' => $siglas,
             'destino_id' => $i,
             'origen_id' => '1',
             'estado' => 'activo'
         ]);
         }

        


       
    }
}





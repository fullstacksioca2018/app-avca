<?php

use Faker\Generator as Faker;


$factory->define(App\Models\operativo\Ruta::class, function (Faker $faker) {
    // $origen=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29];
    // $destino=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29];
    // $aeronave = [1,2,3,4,5];
    $random_origen=rand(1, 29);
    $random_destino =rand(1, 29);
    // $random_origen = array_random($origen);
    // $random_destino = array_random($destino);
    // $random_aeronave = array_random($aeronave);
    $Sorigen=App\Models\operativo\Sucursal::find($random_origen);
    $Sdestino=App\Models\operativo\Sucursal::find($random_destino);
    $siglaAux=$Sorigen->sigla.'-'.$Sdestino->sigla;
    if($random_origen != $random_destino){
        return [
            'distancia' => $faker->longitude($min = 200, $max = 800),
            'sigla'  => $siglaAux,
            'origen_id' => $Sorigen->id,
            'destino_id' => $Sdestino->id   
        ];
    }

});

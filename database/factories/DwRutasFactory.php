<?php

use Faker\Generator as Faker;

$factory->define(App\Models\reporte\DW_Ruta::class, function (Faker $faker) {
    $random_origen=rand(1, 29);
    $random_destino =rand(1, 29);
    $tarifaA =rand(100, 290);
    $tarifaA=$tarifaA*100;
    if($random_origen != $random_destino){
        return [
            'tarifa_vuelo' => $tarifaA,
            'origen_id' => $random_origen,
            'destino_id' => $random_destino,  
        ];
    }
    else{
        $random_destino++;
        return [
            'tarifa_vuelo' => $tarifaA,
            'origen_id' => $random_origen,
            'destino_id' => $random_destino,  
        ];
    }
});

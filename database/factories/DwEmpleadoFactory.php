<?php

use Faker\Generator as Faker;

$factory->define(App\Models\reporte\DW_Empleado::class, function (Faker $faker) {
    $random_cargo=rand(1, 30);
    $random_sucural =rand(1, 29);
    return [
        'estado' => 'activo',
        'fecha_contratacion' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
        'cargo_id' =>  $random_cargo,
        'sucursal_id' => $random_sucural,
       
    ];
    
    
        
});
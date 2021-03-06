<?php

use App\Models\rrhh\Vacante;
use Faker\Generator as Faker;

$factory->define(Vacante::class, function (Faker $faker) {
    return [
        'fecha_publicacion' => $faker->dateTimeBetween('2018-04-01', 'now'),
        'sucursal_id' => rand(1,16),
        'area_id' => rand(1,6),
        'cargo_id' => rand(1,30)
    ];
});

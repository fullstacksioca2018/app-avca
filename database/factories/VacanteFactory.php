<?php

use App\Models\rrhh\Vacante;
use Faker\Generator as Faker;

$factory->define(Vacante::class, function (Faker $faker) {
    return [
        'fecha_publicacion' => $faker->date('Y-m-d', now()),
        'sucursal_id' => rand(1,16),
        'area_id' => rand(1,6),
        'cargo_id' => rand(1,30)
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\operativo\Aeronave::class, function (Faker $faker) {
    return [
        'capacidad_asientos'    => '64',
        'modelo'                => 'ATR-72',
        'matricula'             => str_random(5),
        'estado'                => 'activo',
        'ultimo_mantenimiento'  => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
        'capacidad_equipaje'    => '68',
        'asiento_primera_clase' => '20',
        'asiento_economicos'    => '34',
        'asiento_observacion'   => '10',
    ];
});

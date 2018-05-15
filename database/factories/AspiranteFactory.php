<?php

use App\Models\rrhh\Aspirante;
use Faker\Generator as Faker;

$factory->define(Aspirante::class, function (Faker $faker) {
    return array(
        'cedula' => $faker->randomNumber(8),
        'nacionalidad' => $faker->randomElement(array('v', 'e')),
        'fecha_nacimiento' => $faker->date('Y-m-d', now()),
        'sexo' => $faker->randomElement(array('f', 'm')),
        'apellido' => $faker->lastName,
        'nombre' => $faker->name,
        'email' => $faker->safeEmail,
        'telefono_movil' => '41455555556',
        'telefono_fijo' => '29345155556',
        'curriculum' => '',
        'vacante_id' => rand(1, 100)
    );
});

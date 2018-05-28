<?php


use App\Models\operativo\Empleado2;
use Faker\Generator as Faker;

$factory->define(Empleado2::class, function (Faker $faker) {

    return [
            'cedula' => $faker->randomNumber($nbDigits = 8, $strict = false),
            'nombre' => $faker->firstName,
            'apellido' => $faker->lastName,           
            'tipo_empleado' => 'tripulacion'        
        ];
    });


?>
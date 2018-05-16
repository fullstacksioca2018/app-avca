<?php

use Faker\Generator as Faker;
use App\Models\rrhh\Empleado2;

$factory->define(Empleado2::class, function (Faker $faker) {
    return [
        'cedula' => $faker->numberBetween($min = 1000000, $max = 30000000),
        'nombre' => $faker->firstName,
        'apellidos' => $faker->lastName,
        'tipo_empleado' => 'tripulancion',
       
    ];
    
    
        
});

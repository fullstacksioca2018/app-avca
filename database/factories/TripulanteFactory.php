<?php

use Faker\Generator as Faker;


    $factory->define(\App\Models\operativo\Tripulante::class, function (Faker $faker) {
        return [
            'licencia' => $faker->postcode
        ];
    });




?>
<?php

use Faker\Generator as Faker;

$factory->define(App\Segmento::class, function (Faker $faker) {
	 $origen=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
    return [
        'aeronave_id' => random_int(1, 5),
        'vuelo_id' 	  => random_int(1, 20),
        'ruta_id'     => random_int(1, 20),
    ];
});

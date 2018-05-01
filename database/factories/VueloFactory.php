<?php

use Faker\Generator as Faker;

$factory->define(App\Vuelo::class, function (Faker $faker) {
	
    return [

    	'n_vuelo' => 'VH-'.$faker->numberBetween($min = 100, $max = 999),
        'fecha_salida' => $faker->dateTimeBetween($startDate = 'now', $endDate = '20 days', $timezone = null),
        
    ];

});

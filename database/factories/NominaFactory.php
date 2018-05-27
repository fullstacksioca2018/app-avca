<?php

use App\Models\rrhh\Nomina;
use Faker\Generator as Faker;

$factory->define(Nomina::class, function (Faker $faker) {

    $arrmonth = [1,2,3,4,10,11,12];
    $month = array_random($arrmonth);
    $day = rand(1, 28);

    if ($month >= 10 && $month <= 12) {
        $year = 2017;
    } else {
        $year = 2018;
    }

    $date = \Carbon\Carbon::create($year, $month, $day, 0, 0,0 );

    return [
        'tipo' => $faker->randomElement(['regular','vacaciones','utilidades','prestaciones','liquidacion','arc']),
        'periodo' => $date->format('Y-m-d')
    ];

});

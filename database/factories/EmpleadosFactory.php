<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Models\rrhh\Empleado::class, function (Faker $faker) {
    
    $empleado = [

		'cedula' => $faker->unique()->randomNumber(8, true),
		'nombre' => $faker->firstName,
		'apellido' => $faker->lastName,
		'nacionalidad' => $faker->randomElement(['v','e']), 
		'fecha_nacimiento' => $faker->dateTimeBetween($startDate = '-20 years', $endDate = 'now', $timezone = null),
		'estado_civil' => $faker->randomElement(['solter@', 'casad@', 'divorciad@', 'viud@', 'concubin@']), 
		'foto' => '', 
		'sexo' => $faker->randomElement(['f', 'm']), 
		'estado' => 'Vargas', 
		'ciudad' => 'La Guaira', 
		'direccion' => 'Maiquetia',  
		'telefono_fijo' => rand(1,11), 
		'telefono_movil' => rand(1,11), 
		'email' => $faker->email, 
		'tipo_discapacidad' => 'visual', 
		'sucursal_id' =>  1, 
		'departamento_id' => 24, 
		'cargo_id' =>$faker->randomElement(['8','9','10']), 
		'area_id' => 6, 
		'nivel_academico' => 'profesional', 
		'profesion' => 'Administración de Empresas', 
		'condicion_laboral' =>$faker->randomElement(['fijo', 'contratado', 'suplente']), 
		'tipo_horario' =>'rotativo', 
		'fecha_ingreso' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
		'banco' => 'banesco', 
		'cuenta_bancaria' =>  '123456789123' . $faker->unique()->randomNumber(8, true),
		'licencia' =>  '1234' . $faker->unique()->randomNumber(8, true),
		'estatus' => 'activo',

		
    ];

	return $empleado;   
        
});
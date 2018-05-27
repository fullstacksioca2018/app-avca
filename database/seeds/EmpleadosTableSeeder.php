<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            [
                'cedula' => 5879747,
                'nombre' => 'Emilia',
                'apellido' =>'Quezada',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1965-09-07',
                'estado_civil' => 'casad@',
                'foto' => 'img/rrhh/marta.jpg',
                'sexo' => 'f',
                'estado'=> 'sucre',
                'ciudad' => 'Rio caribe',
                'direccion' => 'av Romulo Gallegos',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04166421817',
                'email' =>'emiliaquezada@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal' => 1,
                'departamento' => 1,
                'cargo' => 1,
                'tipo_empleado' => 'administrativo',
                'nivel_academico' => 'profesional',
                'profesion' => 'Derecho',
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '1990-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> 01340000000000000000
            ],

        ]);
    }
}

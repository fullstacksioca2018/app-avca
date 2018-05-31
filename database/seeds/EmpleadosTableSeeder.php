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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('empleados')->truncate();

        DB::table('empleados')->insert([
            
            // Gerente RRHH
            [
                'cedula' => 19708471,
                'nombre' => 'Gerente',
                'apellido' =>' RRHH',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'Av Cancamure',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'GerenteRRHH@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 31,
                'area_id' => 1,
                'nivel_academico' => 'profesional',
                'profesion' => 2,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000001'
            ],
                // area administrativa
            [
                'cedula' => 19708472,
                'nombre' => 'Renzo Jose',
                'apellido' =>' Rojas Quezada',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'Rio caribe',
                'direccion' => 'Av Romulo Gallegos',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-Administrativo@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 32,
                'area_id' => 1,
                'nivel_academico' => 'profesional',
                'profesion' => 2,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000002'
            ],

                        // area operativa
            [
                'cedula' => 19708473,
                'nombre' => 'Cesar',
                'apellido' =>' Fabbianni',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'Av Bolivar',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-Operativo@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 33,
                'area_id' => 3,
                'nivel_academico' => 'profesional',
                'profesion' => 30,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000003'
            ],

                    // area telematica
            [
                'cedula' => 19708474,
                'nombre' => 'Victor',
                'apellido' =>'Guzman',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'La Casimba',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-telematico@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 34,
                'area_id' => 5,
                'nivel_academico' => 'profesional',
                'profesion' => 17,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000004'
            ],

                // area apoyo logistico
            [
                'cedula' => 19708475,
                'nombre' => 'Carolina',
                'apellido' =>' Carvajal',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'f',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'Av cumanacoa km 8',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-Apoyo-Logistico@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 35,
                'area_id' => 2,
                'nivel_academico' => 'profesional',
                'profesion' => 47,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000005'
            ],

                            // area oficina
            [
                'cedula' => 19708476,
                'nombre' => 'Isabel',
                'apellido' =>'lopez',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'f',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'Urb. San Miguel',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-oficina@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 36,
                'area_id' => 4,
                'nivel_academico' => 'profesional',
                'profesion' =>3, 
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000006'
            ],

                             // area tripulacion
            [
                'cedula' => 19708477,
                'nombre' => 'Luis',
                'apellido' =>'Gutierres',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'Super Bloques',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-Tripulacion@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 37,
                'area_id' => 6,
                'nivel_academico' => 'profesional',
                'profesion' => 41,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000007'
            ],

                // Gerente Sucursal_ides
           [
                'cedula' => 19708478,
                'nombre' => 'Gerente',
                'apellido' =>'Sucursal_id',
               'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'El Peñon',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Gerente-Sucursal_id@hotm1il.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 38,
                'area_id' => 1,
                'nivel_academico' => 'profesional',
                'profesion' => 52,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000008'
            ],

            // Analista Nomina
            [
                'cedula' => 19708479,
                'nombre' => 'Analista',
                'apellido' =>'Nomina',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'sucre',
                'ciudad' => 'cumana',
                'direccion' => 'El Centro',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'Analista-Nomina@hotmail.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 39,
                'area_id' => 1,
                'nivel_academico' => 'profesional',
                'profesion' => 31,
                'condicion_laboral' => 'fijo',
                'tipo_horario' => 'fijo',
                'fecha_ingreso' => '2000-01-01',
                'banco' =>'banesco',
                'cuenta_bancaria'=> '01340000000000000009'
            ],

        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

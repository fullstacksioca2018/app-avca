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
            
            
            //losprimeros 6 de leomar
            //empleado 1
            [
                'cedula' => 3745991,
                'nombre' => 'Sergio',
                'apellido' =>' Peinado',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1951-03-21',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Av Cancamure',
                'telefono_fijo' => '0294516574',
                'telefono_movil' => '04167851297',
                'email' =>'admin@avca.com',
                'tipo_discapacidad' => 'visual',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 1,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2010-01-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000021'
            ],
            

                 //empleado 2
            
            [
                'cedula' => 15892130,
                'nombre' => 'Pepito',
                'apellido' =>' Pérez',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-05-11',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Av Santa Rosa',
                'telefono_fijo' => '02934518637',
                'telefono_movil' => '04143931919',
                'email' =>'pperez@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 31,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2010-12-02',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000022'
            ],
            

                 //empleado 3

            [
                'cedula' => 18359781,
                'nombre' => 'Jaimito',
                'apellido' => 'López',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-07-21',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Av Miranda',
                'telefono_fijo' => '02934312549',
                'telefono_movil' => '04243057493',
                'email' =>'gerentegeneral@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 4,
                'cargo_id' => 25,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2013-02-09',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000023'
            ],
            

               //empleado 4


            [
                'cedula' => 16700550,
                'nombre' => 'Pablito',
                'apellido' =>'García',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1983-11-11',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Av Gran Mariscal',
                'telefono_fijo' => '0294338630',
                'telefono_movil' => '04161234578',
                'email' =>'sucursales@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 16,
                'cargo_id' => 26,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2011-06-18',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000024'
            ],
            

                //empleado 5


            [
                'cedula' => 13931600,
                'nombre' => 'Juán',
                'apellido' =>'García',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1976-10-01',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Calle Bolivar',
                'telefono_fijo' => '02934339741',
                'telefono_movil' => '04241598530',
                'email' =>'subgerente@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 11,
                'cargo_id' => 29,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2012-08-16',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000025'
            ],


                   //empleado 6



            [
                'cedula' => 8360743,
                'nombre' => 'Jarel',
                'apellido' =>'Machado',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1964-11-16',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Calle Las Casas',
                'telefono_fijo' => '02934659578',
                'telefono_movil' => '04245634789',
                'email' =>'taquilla@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 7,
                'cargo_id' => 26,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2012-02-28',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000026'
            ],


//de aqui en adelante rrhh
            // Gerente RRHH, empleado 7


            [
                'cedula' => 5364999,
                'nombre' => 'Dolores',
                'apellido' =>'De Cabeza',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1961-05-12',
                'estado_civil' => 'Casad@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'La Trinidad',
                'telefono_fijo' => '02934515588',
                'telefono_movil' => '04269700081',
                'email' =>'dolores.cabeza@avca.com',
                'tipo_discapacidad' => null,
                'sucursal_id' => 1,
                'departamento_id' => 7,
                'cargo_id' => 38,
                'area_id' => 1,
                'nivel_academico' => 'TSU',
                'profesion' => 14,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2014-02-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000027'
            ],


                     
                 // empleado 8

         
            [
                'cedula' => 19684751,
                'nombre' => 'Luis',
                'apellido' =>'Madrid',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1989-04-29',
                'estado_civil' => 'Solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Tres Pico',
                'telefono_fijo' => '0294675610',
                'telefono_movil' => '04142587139',
                'email' =>'gerenterrhh@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 31,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2015-08-17',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000001'
            ],
                // area administrativa, empleado 9
            [
                'cedula' => 19708472,
                'nombre' => 'Renzo Jose',
                'apellido' =>'Rojas Quezada',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-10-01',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Rio caribe',
                'direccion' => 'Av Romulo Gallegos',
                'telefono_fijo' => '02945111580',
                'telefono_movil' => '04167834720',
                'email' =>'analista-administrativo@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 32,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 2,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000002'
            ],

                        // area operativa, empleado 10
            [
                'cedula' => 15741667,
                'nombre' => 'Cesar',
                'apellido' =>'Fabbianni',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1980-07-14',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Av Bolivar',
                'telefono_fijo' => '02934673294',
                'telefono_movil' => '04248538718',
                'email' =>'analista-operativo@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 33,
                'area_id' => 3,
                'nivel_academico' => 'Profesional',
                'profesion' => 30,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000003'
            ],

                    // area telematica, empleado 11
            [
                'cedula' => 12274999,
                'nombre' => 'Victor',
                'apellido' =>'Gúzman',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1976-11-23',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'La Casimba',
                'telefono_fijo' => '02934321991',
                'telefono_movil' => '04265815620',
                'email' =>'analista-telematico@gmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 34,
                'area_id' => 5,
                'nivel_academico' => 'Profesional',
                'profesion' => 17,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000004'
            ],

                // area apoyo logistico, empleado 12
            [
                'cedula' => 13598083,
                'nombre' => 'Carolina',
                'apellido' =>'Carvajal',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1977-05-21',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'f',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Via Cumanacoa km 8',
                'telefono_fijo' => '02937213995',
                'telefono_movil' => '04163282868',
                'email' =>'analista-apoyo-logistico@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 35,
                'area_id' => 2,
                'nivel_academico' => 'Profesional',
                'profesion' => 47,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000005'
            ],

                            // area oficina, empleado 13
            [
                'cedula' => 16818498,
                'nombre' => 'Isabel',
                'apellido' =>'lopez',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1988-09-15',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'f',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Urb. San Miguel',
                'telefono_fijo' => '02934326911',
                'telefono_movil' => '04249983322',
                'email' =>'analista-oficina@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 36,
                'area_id' => 4,
                'nivel_academico' => 'Profesional',
                'profesion' =>3, 
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000006'
            ],

                             // area tripulacion, empleado 14
            [
                'cedula' => 11214632,
                'nombre' => 'Luis',
                'apellido' =>'Gutierrez',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1974-08-19',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'Super Bloques',
                'telefono_fijo' => '0293451730',
                'telefono_movil' => '04169931488',
                'email' =>'analista-tripulacion@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 37,
                'area_id' => 6,
                'nivel_academico' => 'Profesional',
                'profesion' => 41,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000007'
            ],

                // Gerente Sucursal_ides, empleado 15
           [
                'cedula' => 16359441,
                'nombre' => 'Hugo',
                'apellido' =>'Patiño',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1984-07-28',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'El Peñon',
                'telefono_fijo' => '02934678899',
                'telefono_movil' => '04163562589',
                'email' =>'gerente-sucursal@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 38,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 52,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-01-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000008'
            ],

            // Analista Nomina, empleado 16
            [
                'cedula' => 18741369,
                'nombre' => 'Carlos',
                'apellido' =>'Pinto',
                'nacionalidad' => 'v',
                'fecha_nacimiento' => '1990-06-13',
                'estado_civil' => 'solter@',
                'foto' => '',
                'sexo' => 'm',
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'El Centro',
                'telefono_fijo' => '02934329991',
                'telefono_movil' => '04143934580',
                'email' =>'analista-nomina@hotmail.com',
                'tipo_discapacidad' => '',
                'sucursal_id' => 1,
                'departamento_id' => 1,
                'cargo_id' => 39,
                'area_id' => 1,
                'nivel_academico' => 'Profesional',
                'profesion' => 31,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'fecha_ingreso' => '2017-07-01',
                'banco' =>'Banesco',
                'cuenta_bancaria'=> '01340000000000000009'
            ],

        ]);


            //empleados sucursal cumana oficina
            factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'El Centro',
                'sucursal_id' => 19,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'cargo_id'=> 21,
                'area_id' => 1
                    
                    ]);
                 

        //empleados sucursal cumana diurno
            factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'El Centro',
                'sucursal_id' => 19,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'cargo_id'=> 22,
                'grupo_id'=> 2,
                'area_id' => 2,
                'nivel_academico' => 'tsu',
                'profesion' => 'Administración de Aerolíneas'
                    ]);
        

        //empleados sucursal cumana nocturno
            factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'estado'=> 'Sucre',
                'ciudad' => 'Cumaná',
                'direccion' => 'El Centro',
                'sucursal_id' => 19,
                'condicion_laboral' => 'Fijo',
                'tipo_horario' => 'Fijo',
                'cargo_id'=> 15,
                'grupo_id'=> 3,
                'area_id' => 3,
                'nivel_academico' => 'tsu',
                'profesion' => 'Mantenimiento'
                    
                     ]);
        



        
                        //Pilotos
         factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'nivel_academico' => 'profesional',
                'profesion' => 'piloto',
                'cargo_id'=> 8
                    ])->each(function($a){
            factory(\App\Models\operativo\Tripulante::class)->create([
                'personal_id'=>$a->empleado_id
                    ]);
        });

                    //Copilotos
         factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'nivel_academico' => 'profesional',
                'profesion' => 'copiloto',
                'cargo_id'=> 9
                    ])->each(function($a){
            factory(\App\Models\operativo\Tripulante::class)->create([
                'personal_id'=>$a->empleado_id
                    ]);
        });

                    //Sobrecargos
         factory(\App\Models\rrhh\Empleado::class, 30)->create([
                'nivel_academico' => 'profesional',
                'profesion' => 'Comunicación Social',
                'cargo_id'=> 10
                    ])->each(function($a){
            factory(\App\Models\operativo\Tripulante::class)->create([
                'personal_id'=>$a->empleado_id
                    ]);
        });

                    //Jefes de Cabina
         factory(\App\Models\rrhh\Empleado::class, 10)->create([
                'nivel_academico' => 'profesional',
                'profesion' => 'Administración Aeronáutica',
                'cargo_id'=> 14
                    ])->each(function($a){
            factory(\App\Models\operativo\Tripulante::class)->create([
                'personal_id'=>$a->empleado_id
                    ]);
        });
            

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

use Illuminate\Database\Seeder;

class AsistenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asistencias')->insert([
            
            [
                                    'fecha' => '2018-05-01',
                                'h_entrada' => '8:00:00',
                                 'h_salida' => '20:00:00',
                              'dia_feriado' => 0,
                         'h_extras_diurnas' => 4,
                      'h_faltantes_diurnas' => 0,
                       'h_extras_nocturnas' => 0,
                    'h_faltantes_nocturnas' => 0,
                 'h_extras_diurnas_feriado' => 0, 
              'h_faltantes_diurnas_feriado' => 0,
               'h_extras_nocturnas_feriado' => 0, 
            'h_faltantes_nocturnas_feriado' => 0,
            'empleado_id' => 7,
            ],

            [
                                    'fecha' => '2018-05-02',
                                'h_entrada' => '8:00:00',
                                 'h_salida' => '20:00:00',
                              'dia_feriado' => 0,
                         'h_extras_diurnas' => 4,
                      'h_faltantes_diurnas' => 0,
                       'h_extras_nocturnas' => 0,
                    'h_faltantes_nocturnas' => 0,
                 'h_extras_diurnas_feriado' => 0, 
              'h_faltantes_diurnas_feriado' => 0,
               'h_extras_nocturnas_feriado' => 0, 
            'h_faltantes_nocturnas_feriado' => 0,
            'empleado_id' => 7,
                ],

                [
                    'fecha' => '2018-05-03',
                'h_entrada' => '8:00:00',
                 'h_salida' => '20:00:00',
              'dia_feriado' => 0,
         'h_extras_diurnas' => 4,
      'h_faltantes_diurnas' => 0,
       'h_extras_nocturnas' => 0,
    'h_faltantes_nocturnas' => 0,
 'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

[
    'fecha' => '2018-05-04',
'h_entrada' => '8:00:00',
 'h_salida' => '20:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 4,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],
//dias feriados
[
    'fecha' => '2018-05-05',
'h_entrada' => '8:00:00',
 'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

[
    'fecha' => '2018-05-06',
'h_entrada' => '8:00:00',
 'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

[
    'fecha' => '2018-05-07',
'h_entrada' => '8:00:00',
 'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

// faltantes diurnas
[
    'fecha' => '2018-05-08',
'h_entrada' => '8:00:00',
 'h_salida' => '12:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 4,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

[
    'fecha' => '2018-05-09',
'h_entrada' => '8:00:00',
 'h_salida' => '12:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 4,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

//faltantes diurnas feriado

[
    'fecha' => '2018-05-10',
'h_entrada' => '8:00:00',
 'h_salida' => '12:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 7,
],

                //otro empleado


                [
                    'fecha' => '2018-05-01',
                'h_entrada' => '8:00:00',
                'h_salida' => '20:00:00',
                'dia_feriado' => 0,
                'h_extras_diurnas' => 4,
                'h_faltantes_diurnas' => 0,
                'h_extras_nocturnas' => 0,
                'h_faltantes_nocturnas' => 0,
                'h_extras_diurnas_feriado' => 0, 
                'h_faltantes_diurnas_feriado' => 0,
                'h_extras_nocturnas_feriado' => 0, 
                'h_faltantes_nocturnas_feriado' => 0,
                'empleado_id' => 8,
                ],

[
    'fecha' => '2018-05-02',
'h_entrada' => '8:00:00',
 'h_salida' => '20:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 4,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

[
'fecha' => '2018-05-03',
'h_entrada' => '8:00:00',
'h_salida' => '20:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 4,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

[
'fecha' => '2018-05-04',
'h_entrada' => '8:00:00',
'h_salida' => '20:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 4,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],
//dias feriados
[
'fecha' => '2018-05-05',
'h_entrada' => '8:00:00',
'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

[
'fecha' => '2018-05-06',
'h_entrada' => '8:00:00',
'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

[
'fecha' => '2018-05-07',
'h_entrada' => '8:00:00',
'h_salida' => '20:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

// faltantes diurnas
[
'fecha' => '2018-05-08',
'h_entrada' => '8:00:00',
'h_salida' => '12:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 4,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

[
'fecha' => '2018-05-09',
'h_entrada' => '8:00:00',
'h_salida' => '12:00:00',
'dia_feriado' => 0,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 4,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 0, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],

//faltantes diurnas feriado

[
'fecha' => '2018-05-10',
'h_entrada' => '8:00:00',
'h_salida' => '12:00:00',
'dia_feriado' => 1,
'h_extras_diurnas' => 0,
'h_faltantes_diurnas' => 0,
'h_extras_nocturnas' => 0,
'h_faltantes_nocturnas' => 0,
'h_extras_diurnas_feriado' => 4, 
'h_faltantes_diurnas_feriado' => 0,
'h_extras_nocturnas_feriado' => 0, 
'h_faltantes_nocturnas_feriado' => 0,
'empleado_id' => 8,
],
        ]);


    }
}
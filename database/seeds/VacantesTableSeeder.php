<?php

use Illuminate\Database\Seeder;

class VacantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vacantes')->insert([

            //sucursal 1
            //area administrativa
            [
                'fecha_publicacion' => '2018-01-01',
                'estatus' 			=> 1,
                'area_id' 			=> 1,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 25
            ],

            [
                'fecha_publicacion' => '2018-01-01',
                'estatus' 			=> 1,
                'area_id' 			=> 1,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 26
            ],

            //apoyo logistico
            [
                'fecha_publicacion' => '2018-01-02',
                'estatus' 			=> 1,
                'area_id' 			=> 2,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 21
            ],

            [
                'fecha_publicacion' => '2018-01-02',
                'estatus' 			=> 1,
                'area_id' 			=> 2,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 22
            ],


            //operativo
            [
                'fecha_publicacion' => '2018-01-03',
                'estatus' 			=> 1,
                'area_id' 			=> 3,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 1
            ],

            [
                'fecha_publicacion' => '2018-01-03',
                'estatus' 			=> 1,
                'area_id' 			=> 3,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 3
            ],


            //personal de oficina
            [
                'fecha_publicacion' => '2018-01-04',
                'estatus' 			=> 1,
                'area_id' 			=> 4,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 2
            ],

            [
                'fecha_publicacion' => '2018-02-04',
                'estatus' 			=> 1,
                'area_id' 			=> 4,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 2
            ],

            //telematica
            [
                'fecha_publicacion' => '2018-01-05',
                'estatus' 			=> 1,
                'area_id' 			=> 5,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 18
            ],

            [
                'fecha_publicacion' => '2018-01-05',
                'estatus' 			=> 1,
                'area_id' 			=> 5,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 19
            ],

            //tripulacion
            [
                'fecha_publicacion' => '2018-01-06',
                'estatus' 			=> 1,
                'area_id' 			=> 6,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 8
            ],

            [
                'fecha_publicacion' => '2018-01-06',
                'estatus' 			=> 1,
                'area_id' 			=> 6,
                'sucursal_id' 		=> 1,
                'cargo_id' 			=> 9
            ],


            //sucursal 2
            //area administrativa
            [
                'fecha_publicacion' => '2018-01-01',
                'estatus'           => 1,
                'area_id'           => 1,
                'sucursal_id'       => 2,
                'cargo_id'          => 25
            ],

            [
                'fecha_publicacion' => '2018-01-01',
                'estatus'           => 1,
                'area_id'           => 1,
                'sucursal_id'       => 2,
                'cargo_id'          => 26
            ],

            //apoyo logistico
            [
                'fecha_publicacion' => '2018-01-02',
                'estatus'           => 1,
                'area_id'           => 2,
                'sucursal_id'       => 2,
                'cargo_id'          => 21
            ],

            [
                'fecha_publicacion' => '2018-01-02',
                'estatus'           => 1,
                'area_id'           => 2,
                'sucursal_id'       => 2,
                'cargo_id'          => 22
            ],


            //operativo
            [
                'fecha_publicacion' => '2018-01-03',
                'estatus'           => 1,
                'area_id'           => 3,
                'sucursal_id'       => 2,
                'cargo_id'          => 1
            ],

            [
                'fecha_publicacion' => '2018-01-03',
                'estatus'           => 1,
                'area_id'           => 3,
                'sucursal_id'       => 2,
                'cargo_id'          => 3
            ],


            //personal de oficina
            [
                'fecha_publicacion' => '2018-01-04',
                'estatus'           => 1,
                'area_id'           => 4,
                'sucursal_id'       => 2,
                'cargo_id'          => 2
            ],

            [
                'fecha_publicacion' => '2018-02-04',
                'estatus'           => 1,
                'area_id'           => 4,
                'sucursal_id'       => 2,
                'cargo_id'          => 2
            ],

            //telematica
            [
                'fecha_publicacion' => '2018-01-05',
                'estatus'           => 1,
                'area_id'           => 5,
                'sucursal_id'       => 2,
                'cargo_id'          => 18
            ],

            [
                'fecha_publicacion' => '2018-01-05',
                'estatus'           => 1,
                'area_id'           => 5,
                'sucursal_id'       => 2,
                'cargo_id'          => 19
            ],

            //tripulacion
            [
                'fecha_publicacion' => '2018-01-06',
                'estatus'           => 1,
                'area_id'           => 6,
                'sucursal_id'       => 2,
                'cargo_id'          => 8
            ],

            [
                'fecha_publicacion' => '2018-01-06',
                'estatus'           => 1,
                'area_id'           => 6,
                'sucursal_id'       => 2,
                'cargo_id'          => 9
            ],

        ]);
    }
}

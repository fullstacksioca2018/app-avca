<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->truncate();

        DB::table('areas')->insert([
            [
                'nombre' => 'Administrativa',
                'slug' => 'administrativa',
                'foto' => '/rrhh/areas/administrativa.jpeg'
            ],
            [
                'nombre' => 'Apoyo logístico',
                'slug' => 'apoyo-logistico',
                'foto' => '/rrhh/areas/apoyo-logistico.jpg'
            ],
            [
                'nombre' => 'Operativo',
                'slug' => 'operativo',
                'foto' => '/rrhh/areas/operativo.jpeg'
            ],
            [
                'nombre' => 'Personal de oficina',
                'slug' => 'personal-oficina',
                'foto' => '/rrhh/areas/personal-oficina.jpeg'
            ],
            [
                'nombre' => 'Telemática',
                'slug' => 'telematica',
                'foto' => '/rrhh/areas/telematica.jpeg'
            ],
            [
                'nombre' => 'Tripulación',
                'slug' => 'tripulación',
                'foto' => '/rrhh/areas/tripulacion.jpeg'
            ]
        ]);

        //enable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

use Illuminate\Database\Seeder;

class NominasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nominas')->insert([
            [
                'nombre' 		=> 'regular',
            ],
            [
                'nombre'      => 'vacaciones',
            ],
            [
                'nombre'    => 'utilidades',
            ],
            [
                'nombre'    => 'prestaciones',
            ],
            [
                'nombre'    => 'liquidacion',
            ],
            [
                'nombre'    => 'ARC',
            ],
        ]);
    }
}

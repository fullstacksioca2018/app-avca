<?php

use Illuminate\Database\Seeder;

class DwTemporadas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Decembrina',
            'inicio'      => '2017-12-23 12:00:00',
            'final'     => '2017-12-25 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Decembrina',
            'inicio'      => '2016-12-23 12:00:00',
            'final'     => '2016-12-25 12:00:00',
        ]);


        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Carnaval',
            'inicio'      => '2018-02-17 12:00:00',
            'final'     => '2018-02-20 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Carnaval',
            'inicio'      => '2016-02-16 12:00:00',
            'final'     => '2016-02-19 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Carnaval',
            'inicio'      => '2017-02-13 12:00:00',
            'final'     => '2017-02-16 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Semana Santa',
            'inicio'      => '2017-03-13 12:00:00',
            'final'     => '2017-03-22 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Semana Santa',
            'inicio'      => '2017-03-14 12:00:00',
            'final'     => '2017-03-23 12:00:00',
        ]);

        DB::table('DwTemporadas')->insert([
            'nombre'      => 'Semana Santa',
            'inicio'      => '2016-03-12 12:00:00',
            'final'     => '2016-03-21 12:00:00',
        ]);

    }
}

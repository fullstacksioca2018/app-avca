<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            [
                'title' => 'Evento Azul',
                'color' => '#0071c5',
                'start' => '2017-08-01 00:00:00',
                'end' => '2017-08-02 00:00:00',
            ],
            [
                'title' => 'Eventos 2',
                'color' => '#40E0D0',
                'start' => '2017-08-02 00:00:00',
                'end' => '2017-08-03 00:00:00',
            ],
            [
                'title' => 'Doble click para editar evento',
                'color' => '#008000',
                'start' => '2017-08-03 00:00:00',
                'end' => '2017-08-07 00:00:00',
            ],
        ]);
    }
}

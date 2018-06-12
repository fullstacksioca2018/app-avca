<?php

use Illuminate\Database\Seeder;

class GruposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupos')->insert([
            [
                'tipo_grupo' => 'A',
                'nombre' => 'Oficina',
                'horas_jornada' => 8,
                'hora_inicio' => '8:00',
                'hora_fin' => '4:00',
            ],
            [
                'tipo_grupo' => 'B',
                'nombre' => 'Diurno',
                'horas_jornada' => 8,
                'hora_inicio' => '8:00',
                'hora_fin' => '4:00',
            ],
            [
                'tipo_grupo' => 'C',
                'nombre' => 'Nocturno',
                'horas_jornada' => 7,
                'hora_inicio' => '8:00',
                'hora_fin' => '4:00',
            ],
        ]);
    }
}

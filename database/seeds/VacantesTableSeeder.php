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
        factory(\App\Models\rrhh\Vacante::class, 100)->create();
    }
}

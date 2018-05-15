<?php

use Illuminate\Database\Seeder;

class AspirantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\rrhh\Aspirante::class, 500)->create();
    }
}

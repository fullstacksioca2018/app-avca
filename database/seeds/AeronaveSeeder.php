<?php

use Illuminate\Database\Seeder;

class AeronaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\operativo\Aeronave::class, 5)->create();
    }
}

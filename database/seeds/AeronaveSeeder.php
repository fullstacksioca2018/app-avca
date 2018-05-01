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
        factory(App\Aeronave::class, 5)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            
            VueloSeeder::class,
            AeronaveSeeder::class,
            SucursalSeeder::class,
            RutaSeeder::class,    
            SegmentoSeeder::class,

        ]);
    }
}

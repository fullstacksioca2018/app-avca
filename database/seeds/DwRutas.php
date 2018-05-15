<?php

use Illuminate\Database\Seeder;

class DwRutas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\reporte\DW_Ruta::class,20)->create();
    }
}

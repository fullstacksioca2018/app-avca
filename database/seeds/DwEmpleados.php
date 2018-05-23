<?php

use Illuminate\Database\Seeder;

class DwEmpleados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\reporte\DW_Empleado::class, 250)->create();
    }
}

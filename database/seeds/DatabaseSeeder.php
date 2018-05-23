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
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(SucursalesTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(TabuladorSalarialTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(VacantesTableSeeder::class);
        $this->call(AspirantesTableSeeder::class);
        //$this->call(ProfesionesTableSeeder::class);
        $this->call(ConceptosTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        //disable foreign key check for this connection before running seeders
        
        
        /*SEDEER ONLINE*/
        $this->call(VueloSeeder::class);
        $this->call(AeronaveSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(SegmentoSeeder::class);

        //SEEDER MODULO REPORTE
        $this->call(DwSucursales::class);
        $this->call(DwRutas::class);
        $this->call(DwVuelos::class);
        $this->call(DwCargosSeeder::class);
        $this->call(DwEmpleados::class);
        $this->call(DwIngresosSeeder::class);
        $this->call(DwAsistenciasSeeder::class);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

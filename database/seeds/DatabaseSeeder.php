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

        $this->call(TabuladorSalarialTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(SucursalesTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(VacantesTableSeeder::class);
        $this->call(AspirantesTableSeeder::class);
        $this->call(EntrevistasTableSeeder::class);
        $this->call(GruposTableSeeder::class);
        $this->call(ProfesionesTableSeeder::class);
        $this->call(ConceptosTableSeeder::class);
        $this->call(NominasTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(CargafamiliarTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ConceptoEmpleadoTableSeeder::class);
        $this->call(AsistenciasTableSeeder::class);
        $this->call(VariablesTableSeeder::class);
        //$this->call(Empleado2Seeder::class);
        $this->call(AeronaveSeeder::class);
        //$this->call(RutasSeeder::class);
        //$this->call(VueloSeeder::class);
        //$this->call(Tripulante_vueloSeeder::class);

        // Permisos del sistema
        $this->call(PermissionsTableSeeder::class);

        //disable foreign key check for this connection before running seeders
        
        
        /*SEDEER ONLINE*/
        $this->call(VueloSeeder::class);
        $this->call(AeronaveSeeder::class);
        $this->call(RutaSeeder::class);
        $this->call(SegmentoSeeder::class);
        $this->call(OnlineSeeder::class);
        $this->call(asientosSeeder::class);

        //SEEDER MODULO REPORTE
         $this->call(DwSucursales::class);
        $this->call(DwPasajeros::class);
        $this->call(DwRutas::class);
        $this->call(DwVuelos::class);
        $this->call(DwCargosSeeder::class);
        $this->call(DwEmpleados::class);
        $this->call(DwIngresosSeeder::class);
        $this->call(DwAsistenciasSeeder::class);
        $this->call(DwTemporadas::class); 
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

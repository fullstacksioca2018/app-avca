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
        $this->call(ProfesionesTableSeeder::class);
        $this->call(ConceptosTableSeeder::class);
        $this->call(NominasTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // Permisos del sistema
        $this->call(PermissionsTableSeeder::class);

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

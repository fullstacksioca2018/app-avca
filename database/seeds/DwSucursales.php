<?php

use Illuminate\Database\Seeder;

class DwSucursales extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        DB::table('DwSucursales')->insert([
            'nombre'     => 'Caracas – Maiquetía',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Maracaibo',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Valencia',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'San Antonio del Táchira',
        ]);

        DB::table('DwSucursales')->insert([     

            'nombre'     => 'Santo Domingo',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'La Fría – Táchira',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'San Cristóbal',
        ]);

        DB::table('DwSucursales')->insert([       

            'nombre'     => 'Barcelona',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'Barquisimeto',
        ]);

        DB::table('DwSucursales')->insert([       

            'nombre'     => 'Mérida',
        ]);

        DB::table('DwSucursales')->insert([       

            'nombre'     => 'El Vigía- Mérida',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'Porlamar – Isla de Margarita',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'Puerto Ordaz',
        ]);

        DB::table('DwSucursales')->insert([   

            'nombre'     => 'Maturín',
        ]);

        DB::table('DwSucursales')->insert([     

            'nombre'     => 'San Tomé',
        ]);

        DB::table('DwSucursales')->insert([      

            'nombre'     => 'Coro',
        ]);

        DB::table('DwSucursales')->insert([
            'nombre'     => 'Punto Fijo – Falcón',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Ciudad Bolívar',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Cumaná',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'San Fernando de Apure',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Acarigua',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Barinas',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Puerto Ayacucho',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Tucupita',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Valera',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Canaima',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Los Roques',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'San Felipe',
        ]);

        DB::table('DwSucursales')->insert([

            'nombre'     => 'Puerto Cabello',
        ]);
    }
}

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
            'sigla'      => 'CCS',
            'nombre'     => 'Caracas – Maiquetía',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'MAR',
            'nombre'     => 'Maracaibo',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'VLN',
            'nombre'     => 'Valencia',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'SVZ',
            'nombre'     => 'San Antonio del Táchira',
        ]);

        DB::table('DwSucursales')->insert([     

            'sigla'      => 'STD',
            'nombre'     => 'Santo Domingo',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'LFR',
            'nombre'     => 'La Fría – Táchira',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'SCI',
            'nombre'     => 'San Cristóbal',
        ]);

        DB::table('DwSucursales')->insert([       

            'sigla'      => 'BLA',
            'nombre'     => 'Barcelona',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'BRM',
            'nombre'     => 'Barquisimeto',
        ]);

        DB::table('DwSucursales')->insert([       

            'sigla'      => 'MRD',
            'nombre'     => 'Mérida',
        ]);

        DB::table('DwSucursales')->insert([       

            'sigla'      => 'VIG',
            'nombre'     => 'El Vigía- Mérida',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'PMV',
            'nombre'     => 'Porlamar – Isla de Margarita',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'PZO',
            'nombre'     => 'Puerto Ordaz',
        ]);

        DB::table('DwSucursales')->insert([   

            'sigla'      => 'MUN',
            'nombre'     => 'Maturín',
        ]);

        DB::table('DwSucursales')->insert([     

            'sigla'      => 'SOM',
            'nombre'     => 'San Tomé',
        ]);

        DB::table('DwSucursales')->insert([      

            'sigla'      => 'CZE',
            'nombre'     => 'Coro',
        ]);

        DB::table('DwSucursales')->insert([
            'sigla'      => 'LSP',
            'nombre'     => 'Punto Fijo – Falcón',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'CBL',
            'nombre'     => 'Ciudad Bolívar',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'CUM',
            'nombre'     => 'Cumaná',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'SFD',
            'nombre'     => 'San Fernando de Apure',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'AGV',
            'nombre'     => 'Acarigua',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'BNS',
            'nombre'     => 'Barinas',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'PYH',
            'nombre'     => 'Puerto Ayacucho',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'TUV',
            'nombre'     => 'Tucupita',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'VLV',
            'nombre'     => 'Valera',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'CAJ',
            'nombre'     => 'Canaima',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'LRV',
            'nombre'     => 'Los Roques',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'SNF',
            'nombre'     => 'San Felipe',
        ]);

        DB::table('DwSucursales')->insert([

            'sigla'      => 'PBL',
            'nombre'     => 'Puerto Cabello',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('sucursales')->insert([ 
            'nombre'     => 'Caracas – Maiquetía',
            'direccion'  => 'Maiquetía 1162, Vargas',
            'sigla'      => 'CCS',
            'aeropuerto' => 'Aeropuerto Internacional de Maiquetía Simón Bolívar',
            'estado'     => 'Vargas',
            'ciudad'     => 'Caracas',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Maracaibo',
            'direccion'  => 'Avenida Don Manuel Belloso, Maracaibo 4004, Zulia',
            'sigla'      => 'MAR',
            'aeropuerto' => 'Aeropuerto Internacional de La Chinita',
            'estado'     => 'Zulia',
            'ciudad'     => 'Maracaibo',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Valencia',
            'direccion'  => 'Avenida Iribarren Borges, Valencia, Carabobo',
            'sigla'      => 'VLN',
            'aeropuerto' => 'Aeropuerto Internacional Arturo Michelena',
            'estado'     => 'Carabobo',
            'ciudad'     => 'Valencia',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'San Antonio del Táchira',
            'direccion'  => 'San Antonio del Táchira 5007, Táchira',
            'sigla'      => 'SVZ',
            'aeropuerto' => 'Aeropuerto Internacional Juan Vicente Gómez',
            'estado'     => 'Tachira',
            'ciudad'     => 'San Antonio del Táchira',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([     

            'nombre'     => 'Santo Domingo',
            'direccion'  => 'Santo Domingo 5032, Táchira',
            'sigla'      => 'STD',
            'aeropuerto' => 'Aeropuerto Internacional de Santo Domingo',
            'estado'     => 'Tachira',
            'ciudad'     => 'Santo Domingo',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'La Fría – Táchira',
            'direccion'  => 'La Fría 5020, Táchira',
            'sigla'      => 'LFR',
            'aeropuerto' => 'Aeropuerto de La Fría',
            'estado'     => 'Tachira',
            'ciudad'     => 'La Fría',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'San Cristóbal',
            'direccion'  => 'San Cristóbal 5001, Táchira',
            'sigla'      => 'SCI',
            'aeropuerto' => 'Aeropuerto de Paramillo',
            'estado'     => 'Tachira',
            'ciudad'     => 'San Cristóbal',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([       

            'nombre'     => 'Barcelona',
            'direccion'  => 'Barcelona 6001, Anzoátegui',
            'sigla'      => 'BLA',
            'aeropuerto' => 'Aeropuerto Internacional de Oriente José Antonio Anzoátegui',
            'estado'     => 'Anzoátegui',
            'ciudad'     => 'Barcelona',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'Barquisimeto',
            'direccion'  => 'Avenida Vicente Gil, Barquisimeto 3001, Lara',
            'sigla'      => 'BRM',
            'aeropuerto' => 'Aeropuerto Internacional Jacinto Lara',
            'estado'     => 'Lara',
            'ciudad'     => 'Barquisimeto',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([       

            'nombre'     => 'Mérida',
            'direccion'  => 'Avenida Urdaneta, Mérida 5101, Mérida',
            'sigla'      => 'MRD',
            'aeropuerto' => 'Aeropuerto Alberto Carnevali',
            'estado'     => 'Mérida',
            'ciudad'     => 'Mérida',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([       

            'nombre'     => 'El Vigía Mérida',
            'direccion'  => 'El Vigia 5145, Mérida',
            'sigla'      => 'VIG',
            'aeropuerto' => 'Aeropuerto Internacional Juan Pablo Pérez Alfonzo',
            'estado'     => 'Mérida',
            'ciudad'     => 'El Vigía',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'Porlamar – Isla de Margarita',
            'direccion'  => 'Porlamar 6320, Nueva Esparta',
            'sigla'      => 'PMV',
            'aeropuerto' => 'Aeropuerto Internacional del Caribe Santiago Mariño',
            'estado'     => 'Nueva Esparta',
            'ciudad'     => 'Porlamar, Isla de Margarita',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'Puerto Ordaz',
            'direccion'  => 'Avenida Guayana, Ciudad Guayana 8050, Bolívar',
            'sigla'      => 'PZO',
            'aeropuerto' => 'Aeropuerto Internacional Manuel Piar',
            'estado'     => 'Bolivar',
            'ciudad'     => 'Puerto Ordaz',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([   

            'nombre'     => 'Maturín',
            'direccion'  => 'Maturín 6201, Monagas',
            'sigla'      => 'MUN',
            'aeropuerto' => 'Aeropuerto José Tadeo Monagas',
            'estado'     => 'Monagas',
            'ciudad'     => 'Maturín',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([     

            'nombre'     => 'San Tomé',
            'direccion'  => 'San Tomé 6007, Anzoátegui',
            'sigla'      => 'SOM',
            'aeropuerto' => 'Aeropuerto Don Edmundo Barrios',
            'estado'     => 'Amazonas',
            'ciudad'     => 'San Tomé',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([      

            'nombre'     => 'Coro',
            'direccion'  => 'Avenida Josefa Camejo, Coro 4101',
            'sigla'      => 'CZE',
            'aeropuerto' => 'Aeropuerto José Leonardo Chirinos',
            'estado'     => 'Falcón',
            'ciudad'     => 'Coro',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([
            'nombre'     => 'Punto Fijo – Falcón',
            'direccion'  => 'Avenida Guillermo Lucas Castillo, Las Piedras, Punto Fijo 4102 ',
            'sigla'      => 'LSP',
            'aeropuerto' => 'Aeropuerto Internacional de Las Piedras Josefa Camejo',
            'estado'     => 'Falcón',
            'ciudad'     => 'Punto Fijo',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Ciudad Bolívar',
            'direccion'  => 'Avenida Jesús Soto, Ciudad Bolívar 8001, Bolívar',
            'sigla'      => 'CBL',
            'aeropuerto' => 'Aeropuerto Tomás de Heres',
            'estado'     => 'Bolívar',
            'ciudad'     => 'Ciudad Bolívar',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Cumaná',
            'direccion'  => 'Cumaná 6101, Sucre',
            'sigla'      => 'CUM',
            'aeropuerto' => 'Aeropuerto Antonio José de Sucre',
            'estado'     => 'Sucre',
            'ciudad'     => 'Cumaná',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'San Fernando de Apure',
            'direccion'  => 'Avenida 1° de mayo, San Fernando de Apure 7001, Apure',
            'sigla'      => 'SFD',
            'aeropuerto' => 'Aeropuerto Las Flacheras',
            'estado'     => 'Apure',
            'ciudad'     => 'San Fernando de Apure',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Acarigua',
            'direccion'  => 'Avenida Alianza con Calle 25, Acarigua 3301',
            'sigla'      => 'AGV',
            'aeropuerto' => 'Aeropuerto Nacional Oswaldo Guevara Mujica ',
            'estado'     => 'Portugesa',
            'ciudad'     => 'Acarigua',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Barinas',
            'direccion'  => 'Avenida Adonai Parra Jiménez, 5201 Barinas',
            'sigla'      => 'BNS',
            'aeropuerto' => 'Aeropuerto Nacional de Barinas',
            'estado'     => 'Barinas',
            'ciudad'     => 'Barinas',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Puerto Ayacucho',
            'direccion'  => 'Puerto Ayacucho 7101, Amazonas',
            'sigla'      => 'PYH',
            'aeropuerto' => 'Aeropuerto Cacique Aramare',
            'estado'     => 'Amazonas',
            'ciudad'     => 'Puerto Ayacucho',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Tucupita',
            'sigla'      => 'TUV',
            'direccion'  => 'Tucupita 6401, Delta Amacuro',
            'aeropuerto' => 'Aeropuerto Nacional San Rafael',
            'estado'     => 'Delta Amacuro',
            'ciudad'     => 'Tucupita',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Valera',
            'sigla'      => 'VLV',
            'direccion'  => 'Avenida Principa la Hoyada, Valera 3101, Trujillo',
            'aeropuerto' => 'Aeropuerto Nacional Antonio Nicolás Briceño',
            'estado'     => 'Trujillo',
            'ciudad'     => 'Valera',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Canaima',
            'direccion'  => 'Canaima 8011, Bolívar',
            'sigla'      => 'CAJ',
            'aeropuerto' => 'Aeropuerto Parque Nacional Canaima',
            'estado'     => 'Bolivár',
            'ciudad'     => 'Canaima',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Los Roques',
            'direccion'  => 'Gran Roque, Dependencias Federales',
            'sigla'      => 'LRV',
            'aeropuerto' => 'Aeropuerto Parque Nacional Los Roques',
            'estado'     => 'Dependencias Federales',
            'ciudad'     => 'Los Roques',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'San Felipe',
            'direccion'  => '3208, Yaracuy',
            'sigla'      => 'SNF',
            'aeropuerto' => 'Aeropuerto Néstor Areas',
            'estado'     => 'Yaracuy',
            'ciudad'     => 'San Felipe',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);

        DB::table('sucursales')->insert([

            'nombre'     => 'Puerto Cabello',
            'direccion'  => 'Avenida Bartolomé Salom , Puerto Cabello',
            'sigla'      => 'PBL',
            'aeropuerto' => 'Aeropuerto Nacional Bartolomé Salom',
            'estado'     => 'Carabobo',
            'ciudad'     => 'Puerto Cabello',
            'pais'       => 'Venezuela',
            'tipo_sucursal'=>'operativa',
            'estatus' =>    'activa'
        ]);
            //    'tipo_sucursal'=>  'operativa',
            //    'nombre'       => 'jose antonio anzoátegui',
            //    'estatus'       => 'activa',
            //    'ciudad'       => 'Barcelona',               
            // ],

            // [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Manuel Piar',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Puerto Ordaz',                    
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Arturo Michelena',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Valencia',                
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Josefa Camejo',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Punto Fijo',                
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Jacinto Lara',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Barquisimeto',                  
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Juan Pablo Perez Alfonzo',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'el vigia',                
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Jose Tadeo Monagas',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Maturin',                    
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Santiago Mariño',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Porlamar',                     
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Simon Bolivar',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Maiquetia',                    
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'La Chinita',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Maracaibo',                   
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Cacique Arame',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Puerto Ayacucho',                   
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Don Edmundo Barrios',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'San tome',                
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'las Flecheras',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'San Fernando De Apure',                    
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Luisa Caceres de Arismendi',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Barinas',                
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Tomas de Heres',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Ciudad Bolivar',                     
            //  ],

            //  [ 
            //     'tipo_sucursal'=>  'operativa',
            //     'nombre'       => 'Antonio Jose de Sucre',
            //     'estatus'       => 'activa',
            //     'ciudad'       => 'Cumana',                
            //  ]

        ]);  
        
    }
}

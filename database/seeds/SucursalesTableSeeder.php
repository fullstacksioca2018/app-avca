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
            
            [ 
               'tipo_sucursal'=>  'operativa',
               'nombre'       => 'jose antonio anzoátegui',
               'estatus'       => 'activa',
               'ciudad'       => 'Barcelona',               
            ],

            [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Manuel Piar',
                'estatus'       => 'activa',
                'ciudad'       => 'Puerto Ordaz',                    
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Arturo Michelena',
                'estatus'       => 'activa',
                'ciudad'       => 'Valencia',                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Josefa Camejo',
                'estatus'       => 'activa',
                'ciudad'       => 'Punto Fijo',                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Jacinto Lara',
                'estatus'       => 'activa',
                'ciudad'       => 'Barquisimeto',                  
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Juan Pablo Perez Alfonzo',
                'estatus'       => 'activa',
                'ciudad'       => 'el vigia',                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Jose Tadeo Monagas',
                'estatus'       => 'activa',
                'ciudad'       => 'Maturin',                    
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Santiago Mariño',
                'estatus'       => 'activa',
                'ciudad'       => 'Porlamar',                     
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Simon Bolivar',
                'estatus'       => 'activa',
                'ciudad'       => 'Maiquetia',                    
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'La Chinita',
                'estatus'       => 'activa',
                'ciudad'       => 'Maracaibo',                   
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Cacique Arame',
                'estatus'       => 'activa',
                'ciudad'       => 'Puerto Ayacucho',                   
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Don Edmundo Barrios',
                'estatus'       => 'activa',
                'ciudad'       => 'San tome',                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'las Flecheras',
                'estatus'       => 'activa',
                'ciudad'       => 'San Fernando De Apure',                    
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Luisa Caceres de Arismendi',
                'estatus'       => 'activa',
                'ciudad'       => 'Barinas',                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Tomas de Heres',
                'estatus'       => 'activa',
                'ciudad'       => 'Ciudad Bolivar',                     
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Antonio Jose de Sucre',
                'estatus'       => 'activa',
                'ciudad'       => 'Cumana',                
             ]

        ]);  
        
    }
}

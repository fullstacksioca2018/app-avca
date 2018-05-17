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
               'nombre'       => 'Jose Antonio Anzoátegui',
               'estatus'      => 'activa',
               'ciudad'       => 'Barcelona',  
               'sigla'       => 'BCN'               
            ],

            [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Manuel Piar',
                'estatus'       => 'activa',
                'ciudad'       => 'Puerto Ordaz',  
                'sigla'       => 'PZO'                   
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Arturo Michelena',
                'estatus'       => 'activa',
                'ciudad'       => 'Valencia',  
                'sigla'       => 'VLN'               
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Josefa Camejo',
                'estatus'       => 'activa',
                'ciudad'       => 'Punto Fijo',  
                'sigla'       => 'LSP'     
                              
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Jacinto Lara',
                'estatus'       => 'activa',
                'ciudad'       => 'Barquisimeto',      
                'sigla'       => 'BRM'               
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Juan Pablo Perez Alfonzo',
                'estatus'       => 'activa',
                'ciudad'       => 'El Vigia',    
                'sigla'       => 'VIG'                           
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Jose Tadeo Monagas',
                'estatus'       => 'activa',
                'ciudad'       => 'Maturin',     
                'siglas'       => 'MUN'                
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Santiago Mariño',
                'estatus'       => 'activa',
                'ciudad'       => 'Porlamar', 
                'siglas'       => 'PMV'                      
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Simon Bolivar',
                'estatus'       => 'activa',
                'ciudad'       => 'Maiquetia', 
                'siglas'       => 'CCS'    
                                 
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'La Chinita',
                'estatus'       => 'activa',
                'ciudad'       => 'Maracaibo',   
                'siglas'       => 'MAR'                   
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Cacique Arame',
                'estatus'       => 'activa',
                'ciudad'       => 'Puerto Ayacucho',    
                'siglas'       => 'PYH'                  
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Don Edmundo Barrios',
                'estatus'       => 'activa',
                'ciudad'       => 'San tome',  
                'siglas'       => 'SOM'

             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'las Flecheras',
                'estatus'       => 'activa',
                'ciudad'       => 'San Fernando De Apure',  
                'siglas'       => 'SFD'                  
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Luisa Caceres de Arismendi',
                'estatus'       => 'activa',
                'ciudad'       => 'Barinas',    
                'siglas'       => 'BNS'              
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Tomas de Heres',
                'estatus'       => 'activa',
                'ciudad'       => 'Ciudad Bolivar',  
                'siglas'       => 'CBL'                    
             ],

             [ 
                'tipo_sucursal'=>  'operativa',
                'nombre'       => 'Antonio Jose de Sucre',
                'estatus'       => 'activa',
                'ciudad'       => 'Cumana',     
                'sigla'       => 'CUM'              
             ]

        ]);  
        
    }
}

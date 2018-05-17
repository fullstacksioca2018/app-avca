<?php

use Illuminate\Database\Seeder;

class VueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dia=array('8','9','10','11','12','13', '15','16','17','18','19','20','22','23','24','25','26','27', '29','30','31');
        $mes=date('m');            //valor del mes
        $diactual=date('d');
        $h=array('6','7','10','12','14','16','6','8','10','12','15','16','7','8','11','13','15','17','7','9','11','13','16','17');
        $min=array('00','40','20','00','40','20', '30','10','50','30','10','50','00','40','20','00','40','20', '30','10','50','30','10','50');
        
      
        for($i = 1; $i < 10; $i++){
            factory(\App\Models\operativo\Vuelo::class, 20)->create([          //crear la hora y minutos como un arreglo
                'fecha_salida'      => '2018-'.$mes.'-'.$dia[$i].' '.$h[$i].':'.$min[$i].':00', 
                    'estado' => 'abierto'              //ejecutado //cancelado
            ]);
            DB::table('segmentos')->insert([                  //pierna o vuelo
                //  para avion 4
                'aeronave_id' => '1',      // $aeronave;     
                'vuelo_id'    => $i, 
                'ruta_id'     => $i ]);  
                }
            }
        }
        
                           
                      
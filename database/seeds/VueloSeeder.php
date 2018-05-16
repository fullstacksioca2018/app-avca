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
        $dia=array('8','9','10','11','12','13', '15','16','17','18','19','20','22','23','24','25','26','27', '29','30','31');             // dias del mes
        $mes=date('m');            //valor del mes
        $diactual=date('d');
        $cont=0; //$cont
        for($u=0;$u<sizeof($dia);$u++) {  // recorre el mez     
            for($i=0;$i<24;$i++) {    // recorre el dia 
                $cont++; //para el id del vuelo
                $h=array('6','7','10','12','14','16','6','8','10','12','15','16','7','8','11','13','15','17','7','9','11','13','16','17');
                $min=array('00','40','20','00','40','20', '30','10','50','30','10','50','00','40','20','00','40','20', '30','10','50','30','10','50');
                if($dia[$u]<$diactual){
                    $estado      = 'ejecutado';
                }  
                else{
                    $estado      = 'abierto';
                }
                $aeronave;
                if($i<6) $aeronave=1;     // primeras 6 piernas para avion 1
                    if(($i>=6)&&($i<12)) $aeronave=2;     // segundas 6 piernas para avion 2
                    if(($i>=12)&&($i<18)) $aeronave=3;     // terceras 6 piernas para avion 3
                    if(($i>=18)&&($i<24)) $aeronave=4;     // cuartas  6 piernas
                    $rutas1=array('19','38','16','35','5','24',  '13','32','1','20','7','26','6','25','3','22','8','27', '2','21','4','23','9','28');     // para el lunes miercoles y viernes
                    $rutas2=array('10','29','15','34','13','32',  '11','30','17','36','6','25','12','31','18','37','2','21',   '14','33','19','38','16','35');   // para el martes jueves y sabado
       
                               if (($u%2)==0) { $ruta_id = $rutas1[$i]; }     //u es par ( asigna lunes miercoles y viernes)
                                    else { $ruta_id = $rutas2[$i];}      //u es impar(asigna martes jueves sabado)  
                       factory(Vuelo::class, 1)->create([          //crear la hora y minutos como un arreglo
                                   'salida'      => '2018-'.$mes.'-'.$dia[$u].' '.$h[$i].':'.$min[$i].':00', 
                                   'estado' => $estado                 //ejecutado //cancelado
                                  ]);
                                 DB::table('piernas')->insert([                  //pierna o vuelo
                                         //  para avion 4
                                     'aeronave_id' => $aeronave,      // $aeronave;     
                                     'vuelo_id'    => $cont, 
                                     'ruta_id'     => $ruta_id   ]);  
                           
                        if(($i<6)&&(($u%2)==0)) {$aux=1;}  else {$aux=5;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=2;}  else if(($i>=6)&&($i<12)){$aux=6;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=3;}else if(($i>=12)&&($i<18))  {$aux=7;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=4;}  else if($i>=18 && $i<24)  {$aux=8;}
                       DB::table('tripulante_vuelo')->insert([         //PILOTO
                           'tripulante_id' => $aux, // $aux            
                           'vuelo_id'      => $cont
                       ]);
                       if(($i<6)&&(($u%2)==0)) {$aux=11;}  else {$aux=15;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=12;}  else if(($i>=6)&&($i<12)){$aux=16;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=13;}else if(($i>=17)&&($i<18))  {$aux=17;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=14;}  else if($i>=18 && $i<24)  {$aux=18;}
                       DB::table('tripulante_vuelo')->insert([         //copiloto
                           'tripulante_id' => $aux, //$aux
                           'vuelo_id'      => $cont
                       ]);
                       if(($i<6)&&(($u%2)==0)) {$aux=23;}  else {$aux=27;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=24;}  else if(($i>=6)&&($i<12)){$aux=28;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=25;}else if(($i>=17)&&($i<18))  {$aux=29;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=26;}  else if($i>=18 && $i<24)  {$aux=30;}
                       DB::table('tripulante_vuelo')->insert([         //Jefe cabina
                           'tripulante_id' => $aux, //$aux
                           'vuelo_id'      => $cont
                       ]);
                       if(($i<6)&&(($u%2)==0)) {$aux=35;}  else {$aux=47;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=38;}  else if(($i>=6)&&($i<12)){$aux=50;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=41;}else if(($i>=17)&&($i<18))  {$aux=53;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=44;}  else if($i>=18 && $i<24)  {$aux=56;}
                       DB::table('tripulante_vuelo')->insert([         //sobre cargo 1
                           'tripulante_id' => $aux, //$aux
                           'vuelo_id'      => $cont
                       ]);
                       if(($i<6)&&(($u%2)==0)) {$aux=36;}  else {$aux=48;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=39;}  else if(($i>=6)&&($i<12)){$aux=51;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=42;}else if(($i>=17)&&($i<18))  {$aux=54;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=45;}  else if($i>=18 && $i<24)  {$aux=57;}
                       DB::table('tripulante_vuelo')->insert([           //sobre cargo 2
                           'tripulante_id' => $aux, //$aux
                           'vuelo_id'      => $cont
                       ]);
                       if(($i<6)&&(($u%2)==0)) {$aux=37;}  else {$aux=49;}
                        if(($i>=6)&&($i<12)&&(($u%2)==0)){$aux=40;}  else if(($i>=6)&&($i<12)){$aux=52;}                                  
                       if(($i>=12)&&($i<18)&&(($u%2)==0)){$aux=43;}else if(($i>=17)&&($i<18))  {$aux=55;}
                       if(($i>=18)&&($i<24)&&($u%2)==0)   {$aux=46;}  else if($i>=18 && $i<24)  {$aux=58;}
                       DB::table('tripulante_vuelo')->insert([          //sobre cargo 3
                           'tripulante_id' => $aux, //$aux
                           'vuelo_id'      => $cont
                       ]);
       
              }// for i 
            } //for U
    }
}

<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\operativo\Vuelo;
use App\Models\operativo\Ruta;
use App\Models\operativo\Aeronave;
use App\Models\operativo\Tripulante;
use Carbon\Carbon;
use stdClass;

class PlanificarVueloController extends Controller
{

    public function __construct(){
        Carbon::setLocale('es');
        date_default_timezone_set('America/Caracas');
        $vuelos= new Vuelo();
        //busco todos los destinos programados de la fecha actual en adelante
        $actual = Carbon::now();
        $actual2=Carbon::now();
        $actual2->addHours(1); //agg 1hra para buscar y actualizar los vuelos que ya estan cerrados
        //$vuelos->VuelosRetrasados($actual2->toDateTimeString());
        $actual2->addHours(6); 
        //$vuelos->VuelosCerrados($actual2->toDateTimeString());
    }

    public function vuelo(){
      
       
        return view('Operativo.Vuelo.vuelo');
    }

    public function vuelos(){           
      
     
        $obj = array();
        //$sucursales= Sucursal::orderBy('nombre','ASC')->get();
        $vuelos= Vuelo::orderBy('id')->get();
        foreach($vuelos as $vuelo){
            $objAux = new stdClass();  
            $segmentos = $vuelo->segmentos;
           foreach($segmentos as $segmento){
               // $objAux2 = new stdClass();  
                $segmento->ruta;
               $segmento->aeronave;
                //array_push($objAux,$objAux2);
            } 
            
        
             foreach($vuelo->tripulantes as $tripulante){
           
                $tripulante->empleado;
                //$tripulante->empleado2->experiencia = 
                $tripulante->empleado->experiencia = $tripulante->HorasExperiencia($tripulante->id);
                
            }
            //$vuelo->tripulantes;  
          $objAux->vuelo = $vuelo;   
          array_push($obj,$objAux);
         
         
        }
        return $obj;

       
    }

    public function rutas(){
        $obj = array();
        //$sucursales= Sucursal::orderBy('nombre','ASC')->get();
        $rutas= Ruta::orderBy('id')->get();
        foreach($rutas as $ruta){
          $objAux = new stdClass();
        
         
         $ruta->origen;
         $ruta->destino;
       
         $objAux->ruta = $ruta;
          array_push($obj,$objAux);
         
         
        }
        return $obj;
    }

    public function pilotos(){
        $obj = array();
         
        $tripulantes = Tripulante::orderBy('id')->get();
        foreach($tripulantes as $tripulante){
            $objAux = new stdClass(); 
            $tripulante->empleado;
            $tripulante->empleado->experiencia = $tripulante->HorasExperiencia($tripulante->id);
            $objAux->tripulante = $tripulante;   
            array_push($obj,$objAux);
        }
        return $obj;
    }

    public function disponibilidad(Request $datos){
        
        $year=DATE("Y",strtotime($datos['fecha']));
        $mes=DATE("m",strtotime($datos['fecha']));
        $dia=DATE("d",strtotime($datos['fecha']));
        $minuto=DATE("i",strtotime($datos['fecha'])); //minutos
        $hora=DATE("H",strtotime($datos['fecha']));//hora en formato 24hras
        $actual = Carbon::now();
        $salidaCarbon = Carbon::parse($datos['fecha']);
        $actual->addHours(4); //agg 24hras a la hora actual con el fin de permitir planificar vuelos con minimo 4hras de antelación

        if(!($salidaCarbon->gt($actual))){ //si la salida no es despues de la fecha actual
            return 'Fecha inválida';
        } 
       
        
       $personal = new Tripulante;
        
        $aeronave= new Aeronave;
       
       
        $horaA=$hora-4;
        $horaD=$hora+4;
        $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
        $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
        
        //DATOS PARA CALCULAR HORAS PLANIFICADAS DEL PERSONAL PARA LA QUICENA
        //Y LAS HORAS DE VUELO DE EXPERIENCIA
        //
        $actual2=Carbon::now();
        
        $mes2=DATE("m",strtotime($salidaCarbon->toDateTimeString()));
        
        $year2=DATE("Y",strtotime($salidaCarbon->toDateTimeString()));
        $fechaincio=DATE("d",strtotime($salidaCarbon->toDateTimeString()));
        if($fechaincio<15){ //dia de partida para calcular las horas de vuelos planificadas en la quicena
            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
        }
        else{
            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
        } 

       
        
        $pilotos=$personal->Disponibilidad('piloto',$antes,$despues);
        
        $pihe= array(); //HORAS DE EXPERIENCIA DEL PILOTO
        $pihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($pilotos as $piloto) {
            $personal->piloto = $piloto;
            $personal->piloto->pihe = $personal->HorasExperiencia($piloto->id,$actual2->toDateTimeString()[0]);
            $personal->piloto->pihp = $personal->VuelosPlanificadas($piloto->id,$fechaincio,$fechafin)[0];
           
        } 
        $data['piloto'] = $pilotos;
       
        
        $copilotos=$personal->Disponibilidad("copiloto",$antes,$despues);
        $copihe= array(); //HORAS DE EXPERIENCIA DEL COPILOTO
        $copihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($copilotos as $copiloto) {
            $personal->copiloto = $copiloto;
            $personal->copiloto->copihe = $personal->HorasExperiencia($copiloto->id,$actual2->toDateTimeString()[0]);
            $personal->copiloto->copihp = $personal->VuelosPlanificadas($copiloto->id,$fechaincio,$fechafin)[0];
        }
        $data['copiloto'] = $copilotos;

      
        $sobrecargos=$personal->Disponibilidad("sobrecargo",$antes,$despues);
        $sohe= array(); //HORAS DE EXPERIENCIA DEL SOBRECARGO
        $sohp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        $i = 0;
        foreach ($sobrecargos as $sobrecargo) {
            $personal->sobrecargo = $sobrecargo;
            $personal->sobrecargo->sohe = $personal->HorasExperiencia($sobrecargo->id,$actual2->toDateTimeString()[0]);
            $personal->sobrecargo->sohp = $personal->VuelosPlanificadas($sobrecargo->id,$fechaincio,$fechafin)[0];
            
        }
        $data['sobrecargo'] = $sobrecargos;

        $jefacs=$personal->Disponibilidad("jefe de cabina",$antes,$despues);
        $jche= array(); //HORAS DE EXPERIENCIA DEL JEFA DE CABINA
        $jchp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($jefacs as $jefac) {
            $personal->jefac = $jefac;
            $personal->jefac->jche = $personal->HorasExperiencia($jefac->id,$actual2->toDateTimeString()[0]);
            $personal->jefac->jchp = $personal->VuelosPlanificadas($jefac->id,$fechaincio,$fechafin)[0];
        }

        $data['jefac'] = $jefacs;
        
        
      /*   $aeronaves=$aeronave->Disponibilidad($antes,$despues);
        $aehm= array(); //HORAS DE VUELOS DESPUES DEL MANTENIMIENTO DE LA AERONAVE
        foreach ($aeronaves as $aeronaveF) {
            $personal->aeronave = $aeronaveF;
            $personal->aeronave->$aehm = $aeronave->HorasPostMantenimiento($aeronaveF->id)[0];
        }  
        $data['aeronave'] = $aeronaves; */
        return $data;
        
    
    }

    public function prueba(Request $dato){
        $datos['fecha'] = "2018-05-18";
        $year=DATE("Y",strtotime($datos['fecha']));
        $mes=DATE("m",strtotime($datos['fecha']));
        $dia=DATE("d",strtotime($datos['fecha']));
        $minuto=DATE("i",strtotime($datos['fecha'])); //minutos
        $hora=DATE("H",strtotime($datos['fecha']));//hora en formato 24hras
        $actual = Carbon::now();
        $salidaCarbon = Carbon::parse($datos['fecha']);
        $actual->addHours(4); //agg 24hras a la hora actual con el fin de permitir planificar vuelos con minimo 4hras de antelación

        if(!($salidaCarbon->gt($actual))){ //si la salida no es despues de la fecha actual
            return 'Fecha inválida';
        } 
       
        
       $personal = new Tripulante;
        
        $aeronave= new Aeronave;
       
       
        $horaA=$hora-4;
        $horaD=$hora+4;
        $antes=$year.'-'.$mes.'-'.$dia.' '.$horaA.':'.$minuto.':00';
        $despues=$year.'-'.$mes.'-'.$dia.' '.$horaD.':'.$minuto.':00';
        
        //DATOS PARA CALCULAR HORAS PLANIFICADAS DEL PERSONAL PARA LA QUICENA
        //Y LAS HORAS DE VUELO DE EXPERIENCIA
        //
        $actual2=Carbon::now();
        
        $mes2=DATE("m",strtotime($salidaCarbon->toDateTimeString()));
        
        $year2=DATE("Y",strtotime($salidaCarbon->toDateTimeString()));
        $fechaincio=DATE("d",strtotime($salidaCarbon->toDateTimeString()));
        if($fechaincio<15){ //dia de partida para calcular las horas de vuelos planificadas en la quicena
            $fechaincio=$year2.'-'.$mes2.'-'.'1 12:00:00';
            $fechafin=$year2.'-'.$mes2.'-'.'15 12:00:00';
        }
        else{
            $fechaincio=$year2.'-'.$mes2.'-'.'15 12:00:00';
            $fechafin=$year2.'-'.$mes2.'-'.'31 12:00:00';
        } 

       
        
        $pilotos=$personal->Disponibilidad('piloto',$antes,$despues);
        
        $pihe= array(); //HORAS DE EXPERIENCIA DEL PILOTO
        $pihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($pilotos as $piloto) {
            $personal->piloto = $piloto;
            $personal->piloto->pihe = $personal->HorasExperiencia($piloto->id,$actual2->toDateTimeString()[0]);
            $personal->piloto->pihp = $personal->VuelosPlanificadas($piloto->id,$fechaincio,$fechafin)[0];
           
        } 
        $data['piloto'] = $pilotos;
       
        
        $copilotos=$personal->Disponibilidad("copiloto",$antes,$despues);
        $copihe= array(); //HORAS DE EXPERIENCIA DEL COPILOTO
        $copihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($copilotos as $copiloto) {
            $personal->copiloto = $copiloto;
            $personal->copiloto->copihe = $personal->HorasExperiencia($copiloto->id,$actual2->toDateTimeString()[0]);
            $personal->copiloto->copihp = $personal->VuelosPlanificadas($copiloto->id,$fechaincio,$fechafin)[0];
        }
        $data['copiloto'] = $copilotos;

      
        $sobrecargos=$personal->Disponibilidad("sobrecargo",$antes,$despues);
        $sohe= array(); //HORAS DE EXPERIENCIA DEL SOBRECARGO
        $sohp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        $i = 0;
        foreach ($sobrecargos as $sobrecargo) {
            $personal->sobrecargo = $sobrecargo;
            $personal->sobrecargo->sohe = $personal->HorasExperiencia($sobrecargo->id,$actual2->toDateTimeString()[0]);
            $personal->sobrecargo->sohp = $personal->VuelosPlanificadas($sobrecargo->id,$fechaincio,$fechafin)[0];
            
        }
        $data['sobrecargos'] = $sobrecargos;

        $jefacs=$personal->Disponibilidad("jefe de cabina",$antes,$despues);
        $jche= array(); //HORAS DE EXPERIENCIA DEL JEFA DE CABINA
        $jchp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($jefacs as $jefac) {
            $personal->jefac = $jefac;
            $personal->jefac->jche = $personal->HorasExperiencia($jefac->id,$actual2->toDateTimeString()[0]);
            $personal->jefac->jchp = $personal->VuelosPlanificadas($jefac->id,$fechaincio,$fechafin)[0];
        }

        $data['jefac'] = $jefacs;
        
        
        $aeronaves=$aeronave->Disponibilidad($antes,$despues);
        $aehm= array(); //HORAS DE VUELOS DESPUES DEL MANTENIMIENTO DE LA AERONAVE
        foreach ($aeronaves as $aeronaveF) {
            $personal->aeronaveF = $aeronaveF;
            $personal->aeronaveF->$aehm = $aeronave->HorasPostMantenimiento($aeronaveF->id)[0];
        }  
        $data['aeronave'] = $aeronaves;
        return $data;
        
    }
       

      
    }

/*     <!-- Estados de los vuelos
    abierto=cuando el gerente de sucursales lo planifica y inicia la venta
    cerrado=cuando es hora de autorización y embarquaje para iniciar la ejecución del vuelo
    cancelado=cuando por alguna dificulta inremediable el vuelo se cancela
    retrasado=cuando se pasa la hora de salida
    ejecutado=cuando el subgerente de sucursal notifica que ya la aeronave partio a su destino
   */
   //PROBLEMA LOS BOLETOS NO PODEMOS RELACIONARLO CON LA TABLA VUELO SI UN VUELO POSEE VARIAS PIERNAS PORQUE UN BOLETO ES DISTINTO POR CADA PIERNA... SOLUCIÓN O RELACIONAR EL BOLETO DIRECCTAMENTE CON PIERNA O ELIMINAR LA TABLA PIERNA O DEJAR LA TABLA PIERNA PERO COLOCAR CADA VUELO UNA PIERNA SI EL DESTINO SE REQUIERE VARIAS PIERNAS NO SE REGISTRA UN SOLO VUELO SINO IGUAL VARIOS VUELOS
          //AL BOLETO LE AGG LOS CAMPOS CODIGO ASIENTO Y COSTO TOTAL --> */
  


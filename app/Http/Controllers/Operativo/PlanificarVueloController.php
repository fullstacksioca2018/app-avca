<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\operativo\Vuelo;
use App\Models\operativo\Segmento;
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
        $actual2->subHours(2); //agg 1hra para buscar y actualizar los vuelos que ya estan cerrados
        $vuelos->VuelosRetrasados($actual2->toDateTimeString());


        $actual2=Carbon::now();
        $actual2->addHours(2); 
        $vuelos->VuelosChequeando($actual2->toDateTimeString()); 

        $actual2=Carbon::now();
        $actual2->subHours(6);         
        $vuelos->VuelosCerrados($actual2->toDateTimeString());

        if($vuelos->estado == 'abierto'){
            $vuelos->BoletosAgotados();
            $vuelos->BoletosDisponible();
        }
           

       /*    */

        // Disponibilidad de Boletos
      /*   */
        //$actual2=Carbon::now(); 
        //$actual2->subHours(2); 
       // $vuelos->VuelosChequeando($actual2->toDateTimeString());       
    }

    public function ejecutar(Request $datos){
        $fecha = $datos['Fecha'] . " " . $datos['Hora'];

        if($fecha <= Carbon::now()){
            $vuelo = new Vuelo();
            $vuelo->Actualizar($datos['id'], "ejecutado");
            return "Vuelo Ejecutado";
            
        }
        else{
           return "La fecha de ejecucion esta pautada para el ".$fecha;
        }            
    }

    public function cancelar(Request $datos){
      
            $vuelo = new Vuelo();
            $vuelo->Actualizar($datos['id'], "cancelado");
            return "Vuelo cancelado";
            
    
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

    public function vuelos_manifiesto(){           
      
     
        $obj = array();
        //$sucursales= Sucursal::orderBy('nombre','ASC')->get();
        $vuelos= Vuelo::where('estado','=','Chequeando')->get();
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
           // $vuelo->boletos;
            //$vuelo->tripulantes;  
            $vuelo->boletos;
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
        $objAeronaves = new stdClass(); 
        $objAeronaves->aeronaves = Aeronave::orderBy('id')->get();
        array_push($obj,$objAeronaves);
       
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

       
        
        $pilotos=$personal->Disponibilidad('Piloto',$antes,$despues);
        
        $pihe= array(); //HORAS DE EXPERIENCIA DEL PILOTO
        $pihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($pilotos as $piloto) {
            $personal->piloto = $piloto;
            $personal->piloto->pihe = $personal->HorasExperiencia($piloto->id,$actual2->toDateTimeString()[0]);
            $personal->piloto->pihp = $personal->VuelosPlanificadas($piloto->id,$fechaincio,$fechafin)[0];
           
        } 
        $data['piloto'] = $pilotos;
       
        
        $copilotos=$personal->Disponibilidad("Copiloto",$antes,$despues);
        $copihe= array(); //HORAS DE EXPERIENCIA DEL COPILOTO
        $copihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($copilotos as $copiloto) {
            $personal->copiloto = $copiloto;
            $personal->copiloto->copihe = $personal->HorasExperiencia($copiloto->id,$actual2->toDateTimeString()[0]);
            $personal->copiloto->copihp = $personal->VuelosPlanificadas($copiloto->id,$fechaincio,$fechafin)[0];
        }
        $data['copiloto'] = $copilotos;

      
        $sobrecargos=$personal->Disponibilidad("Sobrecargo",$antes,$despues);
        $sohe= array(); //HORAS DE EXPERIENCIA DEL SOBRECARGO
        $sohp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        $i = 0;
        foreach ($sobrecargos as $sobrecargo) {
            $personal->sobrecargo = $sobrecargo;
            $personal->sobrecargo->sohe = $personal->HorasExperiencia($sobrecargo->id,$actual2->toDateTimeString()[0]);
            $personal->sobrecargo->sohp = $personal->VuelosPlanificadas($sobrecargo->id,$fechaincio,$fechafin)[0];
            
        }
        $data['sobrecargo'] = $sobrecargos;

        $jefacs=$personal->Disponibilidad("Jefe de Cabina",$antes,$despues);
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
            $personal->aeronaveF->aehm = $aeronave->HorasPostMantenimiento($aeronaveF->id);
        }  
        $data['aeronave'] = $aeronaves;
        return $data;
        
        
    
    }

    public function prueba(Request $datos){
        $datos['fecha'] = "2018-06-23 00:00:00";
        
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

       
        
        $pilotos=$personal->Disponibilidad('Piloto',$antes,$despues);
        
        $pihe= array(); //HORAS DE EXPERIENCIA DEL PILOTO
        $pihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($pilotos as $piloto) {
            $personal->piloto = $piloto;
            $personal->piloto->pihe = $personal->HorasExperiencia($piloto->id,$actual2->toDateTimeString()[0]);
            $personal->piloto->pihp = $personal->VuelosPlanificadas($piloto->id,$fechaincio,$fechafin)[0];
           
        } 
        $data['piloto'] = $pilotos;
       
        
        $copilotos=$personal->Disponibilidad("Copiloto",$antes,$despues);
        $copihe= array(); //HORAS DE EXPERIENCIA DEL COPILOTO
        $copihp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        foreach ($copilotos as $copiloto) {
            $personal->copiloto = $copiloto;
            $personal->copiloto->copihe = $personal->HorasExperiencia($copiloto->id,$actual2->toDateTimeString()[0]);
            $personal->copiloto->copihp = $personal->VuelosPlanificadas($copiloto->id,$fechaincio,$fechafin)[0];
        }
        $data['copiloto'] = $copilotos;

      
        $sobrecargos=$personal->Disponibilidad("Sobrecargo",$antes,$despues);
        $sohe= array(); //HORAS DE EXPERIENCIA DEL SOBRECARGO
        $sohp= array(); //HORAS PLANIFICAS PARA LA QUINCENA
        $i = 0;
        foreach ($sobrecargos as $sobrecargo) {
            $personal->sobrecargo = $sobrecargo;
            $personal->sobrecargo->sohe = $personal->HorasExperiencia($sobrecargo->id,$actual2->toDateTimeString()[0]);
            $personal->sobrecargo->sohp = $personal->VuelosPlanificadas($sobrecargo->id,$fechaincio,$fechafin)[0];
            
        }
        $data['sobrecargo'] = $sobrecargos;

        $jefacs=$personal->Disponibilidad("Jefe de Cabina",$antes,$despues);
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
            $personal->aeronaveF->aehm = $aeronave->HorasPostMantenimiento($aeronaveF->id);
        }  
       
        $data['aeronave'] = $aeronaves;
        return $data;
        
    
    }

    public function crear(Request $request){
        $fecha          = $request->fecha; 
        $ruta_id        = $request['ruta']['id'];      
        $piloto         = Tripulante::find($request->piloto);
        $copiloto       = Tripulante::find($request->copiloto);
        $jefac          = Tripulante::find($request->jefac);
        $sobrecargo1    = Tripulante::find($request->sobrecargo[0]);
        $sobrecargo2    = Tripulante::find($request->sobrecargo[1]);
        $sobrecargo3    = Tripulante::find($request->sobrecargo[2]);        
        $aeronave       = $request['aeronave'];
        //Generar Vuelo
        $vuelo = new Vuelo();       
        $vuelo->estado= "abierto";
        $vuelo->n_vuelo = 'VH-'.str_random(5);       
        $vuelo->fecha_salida=$fecha;
        $vuelo->save();
        //Generar Segmento
        $segmento = new Segmento();
        $segmento->aeronave_id=$aeronave;       
        $segmento->vuelo_id=$vuelo->id;        
        $segmento->ruta_id=$ruta_id;        
        $segmento->save();
        //Generar Tripulantes
        
        $piloto->vuelos()->attach($vuelo->id);
       
        $copiloto->vuelos()->attach($vuelo->id);
        
        $jefac->vuelos()->attach($vuelo->id);
      
        $sobrecargo1->vuelos()->attach($vuelo->id);
        
        $sobrecargo2->vuelos()->attach($vuelo->id);
        
        $sobrecargo3->vuelos()->attach($vuelo->id);
  
        return "El Vuelo ha sido planificado, [ir a vuelos abiertos]";
       
     
        
        //return $fecha;
    }

    public function creart(){
        $fecha          = "2018-05-23 00:00:00"; 
        $ruta_id        = "1";      
        $piloto         = Tripulante::find("1");
        $copiloto       = Tripulante::find("2");
        $jefac          = Tripulante::find("3");
        $sobrecargo1    = Tripulante::find("4");
        $sobrecargo2    = Tripulante::find("5");
        $sobrecargo3    = Tripulante::find("6");        
        $aeronave       = "1";
        //Generar Vuelo
        $vuelo = new Vuelo();       
        $vuelo->estado= "abierto";
        $vuelo->n_vuelo = 'VH-'.str_random(5);       
        $vuelo->fecha_salida=$fecha;
        $vuelo->save();
        //Generar Segmento
        $segmento = new Segmento();
      
        $segmento->aeronave_id=$aeronave;
       
        $segmento->vuelo_id=$vuelo->id;
        
        $segmento->ruta_id=$ruta_id;

        $piloto->vuelos()->attach($vuelo->id);
        $copiloto->vuelos()->attach($vuelo->id);
        $jefac->vuelos()->attach($vuelo->id);
        $sobrecargo1->vuelos()->attach($vuelo->id);
        $sobrecargo2->vuelos()->attach($vuelo->id);
        $sobrecargo3->vuelos()->attach($vuelo->id);
  
        
        $segmento->save();
        return "ok";
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
  


<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\online\Factura;
use App\Models\online\Tarjeta;
use App\Models\online\Boleto;
use App\Models\Operativo\Maleta;
use App\Models\Operativo\Asiento;

use stdClass;

class CheckController extends Controller
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
        $actual2->subHours(6); 
        
        $vuelos->VuelosCerrados($actual2->toDateTimeString());
        // Disponibilidad de Boletos
        $vuelos->BoletosAgotados();
        $vuelos->BoletosDisponible();


       
    }
    
    public function check(){
         
        return view('Operativo.Taquilla.Check');
        
    }

    public function checks(){
        $obj=array();
        $boleto=Boleto::where('boleto_estado','!=','Chequeado')->get();
           
            foreach($boleto as $boletos){                
                $objAUX= new stdClass();
                $objAUX->id=$boletos->id;
                $objAUX->codvuelos =$boletos->vuelo->n_vuelo;
                $objAUX->pasajero=$boletos->primerNombre." ".$boletos->apellido;
              //  $objAUX->nombre_pasajero=$boletos->primerNombre;
                $objAUX->documento=$boletos->documento;
               // $objAUX->tipo_boleto=$boletos->tipo_boleto;
               // $objAUX->genero=$boletos->genero;
                //$objAUX->tipo_documento=$boletos->tipo_documento;
                //$objAUX->fecha_nacimiento=$boletos->fecha_nacimiento;
                //$objAUX->apellido_pasajero=$boletos->apellido;
              //  $objAUX->fecha_salida=$boletos->vuelo->fecha_salida;
                $objAUX->origen=$boletos->vuelo->segmentos[0]->ruta->origen->nombre;
                $objAUX->sigla_origen=$boletos->vuelo->segmentos[0]->ruta->origen->sigla;
                $objAUX->aeropuerto_origen=$boletos->vuelo->segmentos[0]->ruta->origen->aeropuerto; 
                $objAUX->destino=$boletos->vuelo->segmentos[0]->ruta->destino->nombre;
                $objAUX->sigla_destino=$boletos->vuelo->segmentos[0]->ruta->destino->sigla;
                $objAUX->aeropuerto_destino=$boletos->vuelo->segmentos[0]->ruta->destino->aeropuerto;
               // $objAUX->duracion=$boletos->vuelo->segmentos[0]->ruta->duracion;
                $objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
                $objAUX->estatus=$boletos->boleto_estado;
                $objAUX->localizador=$boletos->localizador;
                array_push($obj,$objAUX);
            }//fin foreach buscar todos los boletos

            return $obj;
        } //fin buscar cheks

        public function chequeados(){
            $obj=array();
            $boleto=Boleto::where('boleto_estado','=','Chequeado')->get();
               
                foreach($boleto as $boletos){                
                    $objAUX= new stdClass();
                    $objAUX->id=$boletos->id;
                    $objAUX->codvuelos =$boletos->vuelo->n_vuelo;
                    $objAUX->pasajero=$boletos->primerNombre." ".$boletos->apellido;
                  //  $objAUX->nombre_pasajero=$boletos->primerNombre;
                    $objAUX->documento=$boletos->documento;
                   // $objAUX->tipo_boleto=$boletos->tipo_boleto;
                   // $objAUX->genero=$boletos->genero;
                    //$objAUX->tipo_documento=$boletos->tipo_documento;
                    //$objAUX->fecha_nacimiento=$boletos->fecha_nacimiento;
                    //$objAUX->apellido_pasajero=$boletos->apellido;
                  //  $objAUX->fecha_salida=$boletos->vuelo->fecha_salida;
                    $objAUX->origen=$boletos->vuelo->segmentos[0]->ruta->origen->nombre;
                    $objAUX->sigla_origen=$boletos->vuelo->segmentos[0]->ruta->origen->sigla;
                    $objAUX->aeropuerto_origen=$boletos->vuelo->segmentos[0]->ruta->origen->aeropuerto; 
                    $objAUX->destino=$boletos->vuelo->segmentos[0]->ruta->destino->nombre;
                    $objAUX->sigla_destino=$boletos->vuelo->segmentos[0]->ruta->destino->sigla;
                    $objAUX->aeropuerto_destino=$boletos->vuelo->segmentos[0]->ruta->destino->aeropuerto;
                   // $objAUX->duracion=$boletos->vuelo->segmentos[0]->ruta->duracion;
                    $objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
                    $objAUX->estatus=$boletos->boleto_estado;
                    $objAUX->localizador=$boletos->localizador;
                    array_push($obj,$objAUX);
                }//fin foreach buscar todos los boletos
    
                return $obj;
            } //fin buscar cheks

           public function todos(){ //va a buscar todos los vuelos abiertos.
            $vuelos=Vuelo::where('estado','=','chequeando')->get();
            $datos_vuelos=array();
            foreach($vuelos as $vuelo){
                $obj=new stdClass();
                $obj->id=$vuelo->id;
                $obj->n_vuelo=$vuelo->n_vuelo;
                $obj->fecha_salida=$vuelo->fecha_salida;
                $obj->n_boletos=$vuelo->n_boletos;
                $obj->origen=$vuelo->segmentos[0]->ruta->origen->sigla;
                $obj->destino=$vuelo->segmentos[0]->ruta->destino->sigla;
                $obj->boletos=Boleto::where('vuelo_id','=',$vuelo->id)->get();
                foreach($obj->boletos as $boleto){
                    $boleto->maleta;
                }
                
                array_push($datos_vuelos,$obj);
            }
            return $datos_vuelos;
    
           }
           
            /* public function todos(){
                $obj=array();
                $boleto=Boleto::orderBy('id')->get();
                   
                    foreach($boleto as $boletos){                
                        $objAUX= new stdClass();
                        $objAUX->id=$boletos->id;
                        $objAUX->codvuelos =$boletos->vuelo->n_vuelo;
                        $objAUX->pasajero=$boletos->primerNombre." ".$boletos->apellido;
                       //$objAUX->nombre_pasajero=$boletos->primerNombre;
                        $objAUX->documento=$boletos->documento;
                        //$objAUX->tipo_boleto=$boletos->tipo_boleto;
                        //$objAUX->genero=$boletos->genero;
                        //$objAUX->tipo_documento=$boletos->tipo_documento;
                        //$objAUX->fecha_nacimiento=$boletos->fecha_nacimiento;
                        //$objAUX->apellido_pasajero=$boletos->apellido;
                        //$objAUX->fecha_salida=$boletos->vuelo->fecha_salida;
                        $objAUX->origen=$boletos->vuelo->segmentos[0]->ruta->origen->nombre;
                        $objAUX->sigla_origen=$boletos->vuelo->segmentos[0]->ruta->origen->sigla;
                        $objAUX->aeropuerto_origen=$boletos->vuelo->segmentos[0]->ruta->origen->aeropuerto; 
                        $objAUX->destino=$boletos->vuelo->segmentos[0]->ruta->destino->nombre;
                        $objAUX->sigla_destino=$boletos->vuelo->segmentos[0]->ruta->destino->sigla;
                        $objAUX->aeropuerto_destino=$boletos->vuelo->segmentos[0]->ruta->destino->aeropuerto;
                       // $objAUX->duracion=$boletos->vuelo->segmentos[0]->ruta->duracion;
                        $objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
                        $objAUX->estatus=$boletos->boleto_estado;
                        $objAUX->localizador=$boletos->localizador;
                        array_push($obj,$objAUX);
                    }//fin foreach buscar todos los boletos
        
                    return $obj;
            } //fin buscar cheks */
        
        public function checkearBoleto(Request $datos)
        {
        
            $boleto = Boleto::find($datos['id']);
            $boleto->boleto_estado="Chequeado";
            $boleto->save();
            return "El Boleto ha sido Chequeado";
        }

        public function addMaletas(Request $datos)
        {
           //dd($datos->all());
           $maleta= new Maleta();
           $maleta->boleto_id=$datos['id'];
           $maleta->cantidad=$datos['equipaje'];
           $maleta->peso=$datos['peso'];
           $maleta->save();

           $boleto=Boleto::find($datos['id']);
           $boleto->asiento=$datos['puesto'];
           $boleto->boleto_estado="Chequeado";
           $boleto->save();
           return "Boleto Chequeado Correctamente";
        }

        public function asignados(Request $vuelos)
        {
            $lista_puestos=Asiento::orderBy('id')->get();
            $vuelo=json_decode($vuelos['vuelo']);
            $objvuelo=Vuelo::where('n_vuelo','=',$vuelo)->get();
            $obj=Boleto::select('asiento')->where('vuelo_id','=',$objvuelo[0]->id)->get();
            $result=array();
            for($i=0;$i<count($lista_puestos);$i++){
                
                $bandera=true;
                for($j=0;$j<count($obj);$j++){
                    if($lista_puestos[$i]->puesto==$obj[$j]->asiento){
                        $bandera=false;
                       
                    }
                }
                if($bandera){
                    array_push($result,$lista_puestos[$i]->puesto);
                }
            }
            return $result;
        }

}
?>
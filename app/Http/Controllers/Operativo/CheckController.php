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
use stdClass;

class CheckController extends Controller
{
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
                //$objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
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
                    //$objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
                    $objAUX->estatus=$boletos->boleto_estado;
                    $objAUX->localizador=$boletos->localizador;
                    array_push($obj,$objAUX);
                }//fin foreach buscar todos los boletos
    
                return $obj;
            } //fin buscar cheks

            public function todos(){
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
                        //$objAUX->tarifa_vuelo=$boletos->vuelo->segmentos[0]->ruta->tarifa_vuelo;
                        $objAUX->estatus=$boletos->boleto_estado;
                        $objAUX->localizador=$boletos->localizador;
                        array_push($obj,$objAUX);
                    }//fin foreach buscar todos los boletos
        
                    return $obj;
                } //fin buscar cheks
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

}
?>
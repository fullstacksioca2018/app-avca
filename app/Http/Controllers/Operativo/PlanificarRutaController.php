<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Operativo\Ruta;
use App\Models\Operativo\Sucursal;


use stdClass;

class PlanificarRutaController extends Controller
{
    //Mostrar Ruta
    public function ruta(){
      return view('Operativo.Ruta.ruta');
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

    public function ModificarRuta(Request $datos){
      $ruta= Ruta::find($datos['id']);
      $ruta->distancia=$datos['Distancia'];
      $ruta->duracion=$datos['Duracion'];
      $ruta->tarifa_vuelo=$datos['Tarifa'];

   
      
      //return $datos;
      $ruta->save();
      return 'La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." Fue Actualizada Correctamente";
    }

    public function ModificarRuta2(){
      $ruta= Ruta::find('1');
      $ruta->distancia="1";
      $ruta->duracion="1";
      $ruta->tarifa_vuelo="1"; 
      $ruta->save();
      return "ok";
    }

  public function EliminarRuta(Request $datos){
    
    $ruta =Ruta::find($datos['id']);
    $ruta->estado="inactivo";
    $ruta->save();
   
    return "La Ruta ha sido deshabilitada";
  }

  public function HabilitarRuta(Request $datos){
    
    $ruta =Ruta::find($datos['id']);
    $ruta->estado="activo";
    $ruta->save();
    return "La Ruta ha sido habilitada";
  }

  public function obtenerruta(){
    return Sucursal::orderBy('nombre','ASC')->get();        
  }
  public function rutasTodas(){
    return Ruta::orderBy('id','ASC')->get();        
  }
  

  public function crearuta(Request $datos){

    $ruta = new Ruta();
  
    // return  $datos->all();
    // return count($ruta->Buscador($datos->origen['id'],$datos->destino['id'])->get());
  
    if(count($ruta->Buscador($datos->origen['id'],$datos->destino['id'])->get())){
      
      return 'La Ruta '.$datos->origen['nombre']." ---> ".$datos->destino['nombre']." Ya Existe";
    }
    else{
      $sucursal_origen = new Sucursal();
      $sucursal_destino = new Sucursal();
      $ruta->origen_id=$datos->origen['id'];
      $ruta->destino_id=$datos->destino['id'];
      $ruta->distancia=(float)$datos->distancia;
      $ruta->duracion=$datos->duracion['HH'].":".$datos->duracion['mm'].":".$datos->duracion['ss'];
      $ruta->tarifa_vuelo=(float)$datos->tarifa;    
      $ruta->estado="activo";
     
      $origen = $sucursal_origen->find($datos->origen['id'])->sigla;
  
      $destino = $sucursal_destino->find($datos->destino['id'])->sigla;
      
      $ruta->sigla =  $origen."-".$destino;
    
      

      $ruta->save();
      
      return 'La Ruta '.$datos->origen['nombre']." ---> ".$datos->destino['nombre']." Se ha Generado Exitosamente";
    }
   
   
  }

  
}
   

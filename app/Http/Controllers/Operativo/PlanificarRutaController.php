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
      $ruta= Ruta::find($datos->id);
      $ruta->distancia=$datos->Distancia;
      $ruta->duracion=$datos->Duracion;
      $ruta->tarifa_vuelo=$datos->Tarifa; 
      $ruta->save();
      return 'La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." Fue Actualizada Correctamente";
        
      
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

  public function crearuta(Request $datos){
    //  return $datos;
    $ruta = new Ruta();
    //return count($ruta->Buscador($datos->origen['id'],$datos->destino['id'])->get());
    if(count($ruta->Buscador($datos->origen['id'],$datos->destino['id'])->get())){
      return 'La Ruta '.$datos->origen['nombre']." ---> ".$datos->destino['nombre']." Ya Existe";
    }
    else{
      $ruta->origen_id=$datos->origen['id'];
      $ruta->destino_id=$datos->destino['id'];
      $ruta->distancia=$datos->distancia;
      $ruta->duracion=$datos->duracion['HH'].":".$datos->duracion['mm'].":".$datos->duracion['ss'];
      $ruta->tarifa_vuelo=$datos->tarifa;    
      $ruta->estado="activo";
     
      $ruta->save();
      return 'La Ruta '.$datos->origen['nombre']." ---> ".$datos->destino['nombre']." Se ha Generado Exitosamente";
    }
    return "ok2";
   
  }

  public function prueba(){
    $ruta = new Ruta();
    
    $ruta->origen_id=1;
    $ruta->destino_id=2;
    $ruta->distancia=500;
    $ruta->duracion="00:00:00";
    $ruta->tarifa_vuelo=7000;    
    $ruta->estado="activo";
  
    $ruta->save();
  }
    /*
    //POST - CREAR UNA RUTA
    public function CreateRuta(Request $datos){
        $nueva= new Ruta();
        $origen=Sucursal::find($datos->origenid);
        $destino=Sucursal::find($datos->destinoid);
        if(sizeof($nueva->Buscador($datos->origenid,$datos->destinoid)->first())){
          flash::error('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Ya Existe");
          return redirect('/gerente-sucursales/administracion-rutas');
        }
        else{
          if(sizeof($nueva->RutaInactiva($datos->origenid,$datos->destinoid)->first())){
              $nueva=RutaInactiva($datos->origenid,$datos->destinoid)->first();
          }
          $nueva->origen_id=$datos->origenid;
          $nueva->destino_id=$datos->destinoid;
          $nueva->distancia=$datos->distancia;
          $nueva->duracion=$datos->horas.":".$datos->minutos.":00";
          $nueva->tarifa_vuelo=$datos->precio;
          $nueva->siglas=$origen->siglas."-".$destino->siglas;
          $nueva->estado="activa";
          $nueva->save();
          flash::success('La Ruta '.$origen->nombre." ---> ".$destino->nombre." Fue Registrado Correctamente");
          return redirect('/gerente-sucursales/administracion-rutas');
        }
    }

    //DELETE DESAHIBITAR UNA RUTA
    

    //POST HABILITAR UNA RUTA
    public function habilitarRuta(Request $datos){
        $ruta =Ruta::find($datos->ruta_idH);
        $ruta->estado="activa";
        $ruta->save();
        flash::info('La Ruta '.$ruta->origen->nombre." ---> ".$ruta->destino->nombre." ha sido habilitada");
        return redirect('/gerente-sucursales/administracion-rutas');
    }

    //
    
    */
}

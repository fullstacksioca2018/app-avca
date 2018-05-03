<?php

namespace App\Http\Controllers\operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\operativo\Ruta;
use App\model\operativo\Sucursal;
use stdClass;

class RutaController extends Controller
{
    public function ruta(Request $datos){
        $rutas;
        if(isset($datos->origen)){
          $rutas=$this->rutasO($datos->origen);
        }
        else{
          if(isset($datos->destino)){
            $rutas=$this->rutasD($datos->destino);
          }
          else{
            //$rutas= Ruta::orderBy('id')->paginate(15);
            $rutas= Ruta::orderBy('id')->get();
          }
        }
        $sucursales= Sucursal::orderBy('nombre','ASC')->get();


        return view('operativo.rutas.ruta')->with('rutas',$rutas)->with('sucursales',$sucursales);
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
      
      public function rutasO($id){
        $sucursal=Sucursal::find($id);
        $destinos= $sucursal->destinos()->get();
       // $destinos= $sucursal->destinos()->paginate(15);
        return $destinos;
      }
      public function rutasD($id){
        $sucursal=Sucursal::find($id);
        $origenes= $sucursal->origenes()->get();
       // $origenes= $sucursal->origenes()->paginate(15);
        return $origenes;
      }
}

<?php

namespace App\Http\Controllers\Operativo;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

use DateTime;
use Illuminate\Http\Request;
use App\Models\operativo\Sucursal;
use App\Models\operativo\Ruta;
use App\Models\operativo\Vuelo;
use App\Models\operativo\Factura;
use App\Models\online\Tarjeta;
use App\Models\online\Boleto;
use App\Models\Operativo\Maleta;
use App\Models\Operativo\Asiento;

use stdClass;

class FacturacionController extends Controller
{
    public function factura(){
         
        return view('Operativo.Taquilla.Factura');
        
    } 

    public function facturas(){
        $facturas=Factura::porpagar();
        $datos=array();
       
        foreach($facturas as $factura){
            $obj= new stdClass();
            $fac=Factura::find($factura->factura_id);
            $boleto=Boleto::where('factura_id','=',$factura->factura_id)->get();
            $obj->id=$factura->factura_id;
            $obj->numero_factura=$fac->numero_factura;
            $obj->importe_facturado=$fac->importe_facturado;
            $obj->numero_control=$fac->numero_control;
            $obj->adultos_cant=$fac->adultos_cant;
            $obj->ninos_cant=$fac->ninos_cant;
            $obj->NinosBrazos_cant=$fac->NinosBrazos_cant;
            $obj->boletos=$boleto;
            $vuelos=Boleto::select('vuelo_id')->where('factura_id','=',$factura->factura_id)->GroupBy('vuelo_id')->get();
            $datosV=array();
            foreach($vuelos as $vuelo)
            {
                $objAux=Vuelo::find($vuelo)->first();
                $objAux->segmentos[0]->ruta->origen;
                $objAux->segmentos[0]->ruta->destino;
                array_push($datosV,$objAux);
            }
            $obj->vuelos=$datosV;
            array_push($datos,$obj);
        }
       // dd($datos);
        return $datos;
    }

    public function pagar (Request $data){
        
         $tarjeta = new Tarjeta();
         $tarjeta->titular = $data['nombre'];
         $tarjeta->numero_tarjeta = $data['referencia'];
         $tarjeta->fecha_vencimiento = $data['tipo']." ".$data['tarjeta'];
         $tarjeta->save();
         $boletos=Boleto::where('factura_id','=',$data['id'])->get();

         foreach($boletos as $boleto){
             $boleto->boleto_estado="Pagado";
             $boleto->save();
         }
        return "Factura Pagada Correctamente";
    }

    public function cancelar (Request $data){
        $datos=$data->all();
        //dd($datos['boletos'][0]['id']);
        
        foreach($datos['boletos'] as $boleto){
            $bole=Boleto::find($boleto['id']);
            $vuelo=Vuelo::find($bole->vuelo_id);
            $bole->boleto_estado="Cancelado";
            $vuelo->boletos_reservados=$vuelo->boletos_reservados-1;
            $bole->save();
            $vuelo->save();
        }
        return "Factura Cancelada ";
    }
 
        //=====LLEGADA DE AVIONES===
    public function llegada()
    {
        //codigo de llegada
        return view('Operativo.Taquilla.LLegada');
    }

    public function llegadas()
    {
      //$fecha=Carbon::now()->format('Y-m-d');
     $fecha="2018-06-15";
     $vuelos=Vuelo::whereDate('fecha_salida','=',$fecha)->get(); 
     $datosV=array();
     foreach($vuelos as $objAux)
     {
         $objAux->segmentos[0]->ruta->origen;
         $objAux->segmentos[0]->ruta->destino;
         array_push($datosV,$objAux) ;
     }
    return $datosV;
    }
    
    public function llego(Request $data){
        $datos=json_decode($data['datos']);
        $vuelo=Vuelo::find($datos->id);
        $fecha=Carbon::now()->format('Y-m-d');
        $vuelo->fecha_llegada=$fecha." ".$datos->HH.":".$datos->mm.":".$datos->ss;
        $vuelo->observaciones=$datos->area;
        $vuelo->estado='finalizdo';
        $vuelo->save();
        return "ok";
        //$vuelo->fecha
    }

}
?>
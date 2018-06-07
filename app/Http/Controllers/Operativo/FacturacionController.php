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
                $auxiliar=new stdClass();
                $objAux=Vuelo::find($vuelo)->first();
              //  dd($objAux->segmentos);
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

}
?>
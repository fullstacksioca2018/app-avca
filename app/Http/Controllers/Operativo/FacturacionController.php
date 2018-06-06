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
        $id=$facturas[0]->factura_id;
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
            array_push($datos,$obj);
        }
        return $datos;
    }

}
?>
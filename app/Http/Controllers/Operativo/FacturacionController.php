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
        $factura=Factura::porpagar();
        return $factura;
    }

}
?>
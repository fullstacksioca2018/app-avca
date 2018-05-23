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
use stdClass;

class PlanificarAeronaveController extends Controller
{
    public function aeronave(){
        
        return view('Operativo.Aeronave.aeronave');
        
    }

}
?>
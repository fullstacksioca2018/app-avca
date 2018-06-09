<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use stdClass;

class PronosticoIngresosController extends Controller
{
    public function PanelPronosticar(Request $consulta){
    	return $consulta->all();
    } 
}

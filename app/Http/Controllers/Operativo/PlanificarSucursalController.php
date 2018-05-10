<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operativo\Sucursal;
use App\Models\Operativo\Ruta;

class PlanificarSucursalController extends Controller
{
    public function ruta(){
        return Sucursal::orderBy('nombre','ASC')->get();        
    }

    
}

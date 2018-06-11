<?php

namespace App\Http\Controllers\Operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReporteBoleto extends Controller
{
    public function boletos(){
        return view('Operativo.Reportes.reporte');
    }
}

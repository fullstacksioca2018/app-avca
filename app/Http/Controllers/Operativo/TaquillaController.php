<?php

namespace App\Http\Controllers\operativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\model\operativo\Sucursal;

class TaquillaController extends Controller
{
    public function __construct(){
		Carbon::setLocale('es');
		date_default_timezone_set('America/Caracas');
	}

    public function taquilla(){
    	$sucursales = Sucursal::orderBy('ciudad','ASC')->get();
		return view('operativo.taquilla.taquilla',compact('sucursales'));
		//return view('prueba');
    }
}

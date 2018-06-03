<?php

namespace App\Http\Controllers\rrhh;

use Illuminate\Http\Request;
use App\Models\rrhh\Empleado;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->isRole('empleado')) {
            $empleado = Empleado::findOrFail(auth()->user()->id);
            return view('rrhh.backend.dashboard', compact('empleado'));
        } else {
            return view('rrhh.backend.dashboard');
        }
    }
}

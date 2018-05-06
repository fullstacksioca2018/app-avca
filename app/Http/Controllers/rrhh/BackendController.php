<?php

namespace App\Http\Controllers\rrhh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function dashboard()
    {
        return view('rrhh.backend.dashboard');
    }
}

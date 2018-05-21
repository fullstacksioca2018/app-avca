<?php

namespace App\Http\Controllers\rrhh;

use Illuminate\Http\Request;
use App\Models\rrhh\Sucursal;
use App\Http\Controllers\Controller;

class SucursalController extends Controller
{
    public function listadoSucursales()
    {
        $sucursales = Sucursal::where('estatus', 'activa')->orderBy('sucursal_id', 'DESC')->get();
        return view('rrhh.backend.mantenimiento.sucursal.list', compact('sucursales'));
    }

    public function registrarSucursal(Request $request)
    {        
        $sucursal = new sucursal;
        
        $sucursal->fill([
            'tipo_sucursal' => $request->tipo_sucursal,
            'nombre' => $request->nombre,
            'estatus' => 'activa',
            'ciudad' => $request->ciudad
        ]);

        if ($sucursal->save()) {
            return redirect()->back()->with('message', 'success');
        } else {            
            return redirect()->back()->with('message', 'error');
        }
        
    }

    public function obtenerSucursal($sucursal_id)
    {
        $sucursal = Sucursal::findOrFail($sucursal_id);

        return response()->json($sucursal);
    }

    public function actualizarSucursal(Request $request)
    {
        $sucursal = Sucursal::findOrFail($request->sucursal_id);

        $sucursal->fill([
            'tipo_sucursal' => $request->tipo_sucursal,
            'nombre' => $request->nombre,
            'ciudad' => $request->ciudad,
            'estatus' => 'activa'
        ]);

        if ($sucursal->save()) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error']);            
        }
        
    }
}

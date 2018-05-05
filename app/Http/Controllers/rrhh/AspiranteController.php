<?php

namespace App\Http\Controllers\rrhh;

use App\Models\rrhh\Aspirante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AspiranteController extends Controller
{
    public function store(Request $request)
    {
        $aspirante = new Aspirante($request->all());

        $aspirante->curriculum = $request->file('curriculum')->getClientOriginalName();
        if ($aspirante->save()) {
            // Almaceno el pdf subido
            if ($request->hasFile('curriculum')) {
                Storage::put('aspirantes', $request->curriculum);
            }
        }

        alert()->success('Registro exitoso', 'Solicitud registrada')->autoclose(3000);

        return redirect()->route('home');
    }
}

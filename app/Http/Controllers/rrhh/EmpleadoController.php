<?php

namespace App\Http\Controllers\rrhh;

use Carbon\Carbon;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Voucher;
use Illuminate\Http\Request;
use App\Models\rrhh\Concepto;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Sucursal;
use App\Models\rrhh\Profesion;
use App\Models\rrhh\Departamento;
use App\Models\rrhh\CargaFamiliar;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateEmpleadoRequest;

class EmpleadoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        if (auth()->user()->isRole('empleado')) {
            return redirect()->route('dashboard.empleado');
        } else {
            return view('rrhh.backend.dashboard');
        }
    }

    public function dashboardEmpleado(Request $request, $empleado = null, $section = null)
    {       
        if ($empleado == null) {            
            $empleado = DB::table('empleados')
                ->join('sucursales', 'sucursales.sucursal_id', '=', 'empleados.sucursal_id')
                ->join('cargos', 'cargos.cargo_id', '=', 'empleados.cargo_id')
                ->join('departamentos', 'departamentos.departamento_id', '=', 'empleados.departamento_id')            
                ->select('empleados.*', 'sucursales.nombre as nombre_sucursal', 'cargos.titulo as nombre_cargo', 'departamentos.descripcion')
                ->where('empleados.empleado_id', '=', auth()->user()->id)
                ->first();
        } else {
            $empleado = DB::table('empleados')
                ->join('sucursales', 'sucursales.sucursal_id', '=', 'empleados.sucursal_id')
                ->join('cargos', 'cargos.cargo_id', '=', 'empleados.cargo_id')
                ->join('departamentos', 'departamentos.departamento_id', '=', 'empleados.departamento_id')            
                ->select('empleados.*', 'sucursales.nombre as nombre_sucursal', 'cargos.titulo as nombre_cargo', 'departamentos.descripcion')
                ->where('empleados.empleado_id', '=', $empleado)
                ->first();            
        }
        

        if ($section == null || $section == 0) {
            $section = 0;
            $datos_personales = $this->datosPersonales($empleado->empleado_id);

            return view('rrhh.backend.empleado.dashboard', compact('empleado', 'datos_personales', 'section'));
        }

        if ($section == 1) {
            $vouchers = $this->voucherPagoAjax($empleado->empleado_id);
            return view('rrhh.backend.empleado.dashboard', compact('empleado', 'vouchers', 'section'));
        }

        if ($section == 2) {
            $carga_familiar = $this->cargaFamiliar($empleado->empleado_id);
            return view('rrhh.backend.empleado.dashboard', compact('empleado', 'carga_familiar', 'section'));
        }

        if ($section == 3) {
            return view('rrhh.backend.empleado.dashboard', compact('empleado', 'section'));
        }

    }

    public function datosPersonales($empleado_id)
    {
        $empleado = Empleado::findOrFail($empleado_id);
        $datos_personales = Profesion::select('titulo as nombre_profesion')->where('profesion_id', $empleado->profesion)->first();

        return $datos_personales;
    }

    /* public function voucherPago($empleado_id, $mes = null)
    {        
        $voucher = Voucher::select('*')
            ->where('empleado_id', $empleado_id)
            ->whereMonth('fecha', Carbon::now()->month)
            ->get();

        return $voucher;
    } */

    /**
     * Obtiene los datos familiares y los pasa por ajax
     */
    public function voucherPagoAjax($empleado_id, $mes = null)
    {         
        $mes = $mes == null ? Carbon::now()->month : $mes;               
        $voucher = DB::table('vouchers')
            ->join('conceptos', 'conceptos.concepto_id', '=', 'vouchers.concepto_id')
            ->where('empleado_id', $empleado_id)
            ->whereMonth('fecha', $mes)
            ->get();

        return $voucher;
    }

    public function imprimirVoucher($empleado_id, $mes = null)
    {
        $empleado = Empleado::findOrFail($empleado_id);
        $mes = $mes == null ? Carbon::now()->month : $mes;
        $vouchers = Voucher::select('*')
            ->where('empleado_id', $empleado_id)
            ->whereMonth('fecha', $mes)
            ->get();

        $pdf = PDF::loadView('rrhh.backend.pdf.empleado.voucher', compact('vouchers'));
        return $pdf->download($empleado->cedula .  ' - voucher.pdf');
    }

    public function cargaFamiliar($empleado_id)
    {
        $carga_familiar = CargaFamiliar::where('empleado_id', $empleado_id)
                        ->where('estatus', 1)
                        ->get();

        return $carga_familiar;
    }

    public function imprimirCargaFamiliar($empleado_id)
    {
        $empleado = Empleado::findOrFail($empleado_id);        
        $carga_familiar = CargaFamiliar::where('empleado_id', $empleado_id)
                        ->where('estatus', 1)
                        ->get();                        

        $pdf = PDF::loadView('rrhh.backend.pdf.empleado.carga-familiar', compact('carga_familiar'));
        return $pdf->download($empleado->cedula .  ' - carga-familiar.pdf');
    }

    public function imprimirConstanciaTrabajo($empleado_id)
    {
        $empleado = Empleado::findOrFail($empleado_id);

        $pdf = PDF::loadView('rrhh.backend.pdf.empleado.constancia-trabajo', compact('empleado'));
        return $pdf->download($empleado->cedula .  ' - constancia-trabajo.pdf');
    }


    public function actualizarEmpleado(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        if ($request->hasFile('foto')) {

            // Borrando la foto anterior
            /*if(file_exists(public_path('storage/empleados/' . $empleado->cedula . '/foto/', $empleado->foto))) {
                //unlink(public_path('storage/empleados/' . $empleado->cedula . '/foto/', $empleado->foto));
                Storage::disk('local')->delete('empleados/' . $request->cedula . '/foto/', $empleado->foto);
            }*/

            // Actualizando el registro
            $empleado->update($request->all());

            // Guardando la nueva foto
            $empleado->foto = $request->file('foto')->hashName();
            $empleado->save();

            Storage::disk('public')->put('empleados/' . $request->cedula . '/foto/', $request->file('foto'));

            return redirect()->route('dashboard.empleado')
                ->with('info', 'Empleado actualizado con éxito');
        }

        // Actualizando el registro
        $empleado->update($request->all());

        return redirect()->route('dashboard.empleado')
            ->with('info', 'Empleado actualizado con éxito');
    }

    /**
     * Actualizacion del empleado por parte del analista de sucursal
     */
    public function actualizarEmpleadoSucursal(Request $request)
    {
        if ($request->hasFile('foto')) {

            // Borrando la foto anterior
            /*if(file_exists(public_path('storage/empleados/' . $empleado->cedula . '/foto/', $empleado->foto))) {
                //unlink(public_path('storage/empleados/' . $empleado->cedula . '/foto/', $empleado->foto));
                Storage::disk('local')->delete('empleados/' . $request->cedula . '/foto/', $empleado->foto);
            }*/

            // Actualizando el registro
            $empleado = Empleado::findOrFail($request->empleado_id);
            $empleado->update($request->all());

            // Guardando la nueva foto
            $empleado->foto = $request->file('foto')->hashName();
            $empleado->save();

            Storage::disk('public')->put('empleados/' . $request->cedula . '/foto/', $request->file('foto'));

            return response()->json('Empleado actualizado con éxito', 200);
            //return redirect()->json('dashboard.empleado')
                //->with('info', 'Empleado actualizado con éxito');
        }        

        // Actualizando el registro
        $empleado = Empleado::findOrFail($request->empleado_id);
        $empleado->update($request->all());

        return response()->json('Empleado actualizado con éxito', 200);
       /*  return redirect()->route('dashboard.empleado')
            ->with('info', 'Empleado actualizado con éxito'); */
    }

    /**********************************     metodos para el gerente     *************************************/

    public function index(Request $request)
    {
        //$empleado = Empleado::where('cedula', $request->cedula)->first();
        return view('rrhh.backend.perfil.ficha');
    }

    public function obtenerEmpleado(Request $request)
    {
        $empleado = Empleado::where('cedula', $request->search)->first();
        return view('rrhh.backend.perfil.ficha', compact('empleado'));
        //return response()->json($empleado);
    }

    public function obtenerSucursal(Request $request)
    {
        $sucursal = Sucursal::where('sucursal_id', $request->sucursal)->first();
        return response()->json($sucursal);
    }

    public function obtenerDepartamento(Request $request)
    {
        $departamento = Departamento::where('departamento_id', $request->departamento)->first();
        return response()->json($departamento);
    }

    public function obtenerCargo(Request $request)
    {
        $cargo = Cargo::where('cargo_id', $request->cargo)->first();
        return response()->json($cargo);
    }

    public function obtenerConceptos()
    {
        $conceptos = Concepto::all();

        return response()->json($conceptos);
    }

    public function guardarIngresosDeducciones(Request $request)
    {
        $asignaciones = $request->asignaciones;
        $deducciones = $request->deducciones;
        $empleado_id = $request->empleado_id;

        $conceptos = array_merge($asignaciones, $deducciones);

        $empleado = Empleado::findOrFail($empleado_id);

        $empleado->conceptos()->attach($conceptos);

        return response()->json();
    }

    /**
     * Obtiene el listado de empleados en por la sucursal
     */
    public function empleadosPorSucursal(Sucursal $sucursal)
    {
        $empleados = Empleado::where([
            ['sucursal_id', '=', $sucursal->sucursal_id],
            ['empleado_id', '<>', auth()->user()->empleado->empleado_id]
        ])->get();

        return view('rrhh.backend.gerente_sucursal.empleados', compact('sucursal', 'empleados'));
    }

    // Carga familiar
    public function obtenerCargaFamiliar(Request $request)
    {
        //return $request->empleado_id;
        $carga_familiar = CargaFamiliar::where('empleado_id', $request->empleado_id)
                                        ->where('estatus', 1)
                                        ->get();
        return response()->json($carga_familiar);
    }

    public function agregarCargaFamiliar(Request $request)
    {
        $carga_familiar = new CargaFamiliar($request->all());

        if ($carga_familiar->save()) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error']);
        }

    }
}

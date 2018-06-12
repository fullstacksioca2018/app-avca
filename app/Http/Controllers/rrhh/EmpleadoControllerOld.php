<?php

namespace App\Http\Controllers\rrhh;

use Carbon\Carbon;
use App\Models\rrhh\Area;
use App\Models\rrhh\Cargo;
use App\Models\rrhh\Event;
use Illuminate\Http\Request;
use App\Models\rrhh\Concepto;
use App\Models\rrhh\Empleado;
use App\Models\rrhh\Sucursal;
use App\Models\rrhh\Departamento;
use App\Models\rrhh\CargaFamiliar;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerSucursales()
    {
        $data = Sucursal::all();
        return response()->json($data);
    }

    public function obtenerAreas()
    {
        $data = Area::all();
        return response()->json($data);
    }

    public function obtenerCargos($area_id)
    {
        $data = Cargo::where('area_id', $area_id)->get();
        return response()->json($data);
    }

    public function actualizarEmpleado(Request $request)
    {
        $empleado_id = $request->empleado_id;

        $empleado = Empleado::findOrFail($empleado_id);

        if($request->hasFile('foto')) {
            $empleado->foto = $request->file('foto')->hashName();
            Storage::disk('public')->put('empleados/' . $empleado->cedula . '/foto/', $request->file('foto'));

            $datosEmpleado = $request->except(['foto']);
        } else {
            $datosEmpleado = $request->all();
        }


        if ($empleado->fill($datosEmpleado)) {
            $empleado->save();
            return response()->json(['message' => 'Los datos del empleado han sido actualizados.']);
        }
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

    public function actualizarEstatus($id)
    {
        $carga_familiar = CargaFamiliar::findOrFail($id);

        $carga_familiar->estatus = 0;

        $carga_familiar->save();

        return response()->json();
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
        /*for ($i = 0; $i < count($conceptos); $i++) {
            $empleado->conceptos()->attach($conceptos[$i]);
        }*/

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

    /**
     * Muestra el listado de empleados por sucursal que hayan asistido en el dia
     */
    public function empleadosPorSucursalAsistentes(Sucursal $sucursal)
    {
        $empleados = DB::table('empleados')
            ->join('asistencias', 'empleados.empleado_id', '=', 'asistencias.empleado_id')
            ->join('sucursales', 'empleados.sucursal_id', '=', 'sucursales.sucursal_id')
            ->join('grupos', 'empleados.grupo_id', '=', 'grupos.id')
            ->join('cargos', 'empleados.cargo_id', '=', 'cargos.cargo_id')
            ->where([
                ['asistencias.h_entrada', '<>', null],
                ['asistencias.fecha', '=', Carbon::now()->format('Y-m-d')],
                ['sucursales.sucursal_id', $sucursal->sucursal_id]
            ])
            ->select('empleados.*', 'grupos.nombre as nombre_grupo', 'cargos.titulo as titulo_cargo', 'asistencias.h_entrada')
            ->get();
        
        return view('rrhh.backend.gerente_sucursal.empleados-asistentes', compact('sucursal', 'empleados'));
    }

    public function CalendarioFeriado(Sucursal $sucursal)
    {        
        $events = Event::all()->toArray();
        
        return view('rrhh.backend.gerente_sucursal.calendario-feriado', compact('events', 'sucursal'));
    }

    public function guardarEventoCalendario(Request $request)
    {
        //dd($request->all());
        $event = new Event();
        if ($request->isMethod('post')) {
            //dd($event);
            if ($request->post('title') && $request->post('start') && $request->post('end') && $request->post('color')) {
                //return $request->all();
                $event->title   = $request->title;
                $event->color   = $request->color;
                $event->start   = $request->start;
                $event->end     = $request->end;

                if ($event->save()) {
                    return redirect()->back();
                }
            }
        }        
    }

    public function editarEventoCalendario(Request $request)
    {
        if ($request->post('delete') && $request->post('id')) {
            $id = $request->post('id');
            $event = Event::findOrFail($id);
            if ($event->delete()) {
                return redirect()->back();
            }
        } elseif ($request->post('title') && $request->post('color') && $request->post('id')) {
            $id = $request->post('id');
            $event = Event::findOrFail($id);

            $event->title   = $request->title;
            $event->color   = $request->color;            
            
            if ($event->save()) {
                return redirect()->back();
            }
        }
    }
}

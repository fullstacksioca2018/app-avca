<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate();

        return view('rrhh.backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            if (str_contains($permission->slug, 'users')) {
                $permissions_users[] = $permission;
            }

            if (str_contains($permission->slug, 'roles')) {
                $permissions_roles[] = $permission;
            }

            if (str_contains($permission->slug, 'areas')) {
                $permissions_areas[] = $permission;
            }

            if (str_contains($permission->slug, 'aspirantes')) {
                $permissions_aspirantes[] = $permission;
            }

            if (str_contains($permission->slug, 'carga_familiar')) {
                $permissions_carga_familiar[] = $permission;
            }

            if (str_contains($permission->slug, 'cargos')) {
                $permissions_cargos[] = $permission;
            }

            if (str_contains($permission->slug, 'conceptos')) {
                $permissions_conceptos[] = $permission;
            }

            if (str_contains($permission->slug, 'empleados')) {
                $permissions_empleados[] = $permission;
            }

            if (str_contains($permission->slug, 'entrevistas')) {
                $permissions_entrevistas[] = $permission;
            }

            if (str_contains($permission->slug, 'expedientes')) {
                $permissions_expedientes[] = $permission;
            }

            if (str_contains($permission->slug, 'nominas')) {
                $permissions_nominas[] = $permission;
            }

            if (str_contains($permission->slug, 'profesiones')) {
                $permissions_profesiones[] = $permission;
            }

            if (str_contains($permission->slug, 'sucursales')) {
                $permissions_sucursales[] = $permission;
            }

            if (str_contains($permission->slug, 'tabuladores_salariales')) {
                $permissions_tabuladores_salariales[] = $permission;
            }

            if (str_contains($permission->slug, 'vacantes')) {
                $permissions_vacantes[] = $permission;
            }

            if (str_contains($permission->slug, 'variables')) {
                $permissions_variables[] = $permission;
            }

            if (str_contains($permission->slug, 'vouchers')) {
                $permissions_vouchers[] = $permission;
            }
        }

        /*$permissions_all = collect([$permissions_users, $permissions_roles, $permissions_areas, $permissions_aspirantes, $permissions_carga_familiar, $permissions_cargos, $permissions_conceptos, $permissions_empleados, $permissions_entrevistas, $permissions_expedientes, $permissions_nominas, $permissions_profesiones, $permissions_sucursales, $permissions_tabuladores_salariales, $permissions_vacantes, $permissions_variables, $permissions_vouchers]);*/

        //dd($permissions_all);

        return view('rrhh.backend.roles.create', [
            'permissions_users' => $permissions_users,
            'permissions_roles' => $permissions_roles,
            'permissions_areas' => $permissions_areas,
            'permissions_aspirantes' => $permissions_aspirantes,
            'permissions_carga_familiar' => $permissions_carga_familiar,
            'permissions_cargos' => $permissions_cargos,
            'permissions_conceptos' => $permissions_conceptos,
            'permissions_empleados' => $permissions_empleados,
            'permissions_entrevistas' => $permissions_entrevistas,
            'permissions_expedientes' => $permissions_expedientes,
            'permissions_nominas' => $permissions_nominas,
            'permissions_profesiones' => $permissions_profesiones,
            'permissions_sucursales' => $permissions_sucursales,
            'permissions_tabuladores_salariales' => $permissions_tabuladores_salariales,
            'permissions_vacantes' => $permissions_vacantes,
            'permissions_variables' => $permissions_variables,
            'permissions_vouchers' => $permissions_vouchers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Primero debemos crear el rol
        $role = Role::create($request->all());

        // Despues se actualizan los roles
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')
            ->with('info', 'Rol creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('rrhh.backend.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();

        foreach ($permissions as $permission) {
            if (str_contains($permission->slug, 'users')) {
                $permissions_users[] = $permission;
            }

            if (str_contains($permission->slug, 'roles')) {
                $permissions_roles[] = $permission;
            }

            if (str_contains($permission->slug, 'areas')) {
                $permissions_areas[] = $permission;
            }

            if (str_contains($permission->slug, 'aspirantes')) {
                $permissions_aspirantes[] = $permission;
            }

            if (str_contains($permission->slug, 'carga_familiar')) {
                $permissions_carga_familiar[] = $permission;
            }

            if (str_contains($permission->slug, 'cargos')) {
                $permissions_cargos[] = $permission;
            }

            if (str_contains($permission->slug, 'conceptos')) {
                $permissions_conceptos[] = $permission;
            }

            if (str_contains($permission->slug, 'empleados')) {
                $permissions_empleados[] = $permission;
            }

            if (str_contains($permission->slug, 'entrevistas')) {
                $permissions_entrevistas[] = $permission;
            }

            if (str_contains($permission->slug, 'expedientes')) {
                $permissions_expedientes[] = $permission;
            }

            if (str_contains($permission->slug, 'nominas')) {
                $permissions_nominas[] = $permission;
            }

            if (str_contains($permission->slug, 'profesiones')) {
                $permissions_profesiones[] = $permission;
            }

            if (str_contains($permission->slug, 'sucursales')) {
                $permissions_sucursales[] = $permission;
            }

            if (str_contains($permission->slug, 'tabuladores_salariales')) {
                $permissions_tabuladores_salariales[] = $permission;
            }

            if (str_contains($permission->slug, 'vacantes')) {
                $permissions_vacantes[] = $permission;
            }

            if (str_contains($permission->slug, 'variables')) {
                $permissions_variables[] = $permission;
            }

            if (str_contains($permission->slug, 'vouchers')) {
                $permissions_vouchers[] = $permission;
            }
        }

        return view('rrhh.backend.roles.edit', [
            'role' => $role,
            'permissions_users' => $permissions_users,
            'permissions_roles' => $permissions_roles,
            'permissions_areas' => $permissions_areas,
            'permissions_aspirantes' => $permissions_aspirantes,
            'permissions_carga_familiar' => $permissions_carga_familiar,
            'permissions_cargos' => $permissions_cargos,
            'permissions_conceptos' => $permissions_conceptos,
            'permissions_empleados' => $permissions_empleados,
            'permissions_entrevistas' => $permissions_entrevistas,
            'permissions_expedientes' => $permissions_expedientes,
            'permissions_nominas' => $permissions_nominas,
            'permissions_profesiones' => $permissions_profesiones,
            'permissions_sucursales' => $permissions_sucursales,
            'permissions_tabuladores_salariales' => $permissions_tabuladores_salariales,
            'permissions_vacantes' => $permissions_vacantes,
            'permissions_variables' => $permissions_variables,
            'permissions_vouchers' => $permissions_vouchers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Primero debe actualizarce el usuario
        $role->update($request->all());

        // Despues se actualizan los roles
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')
            ->with('info', 'Role actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}

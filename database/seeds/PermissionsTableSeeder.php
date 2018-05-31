<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuarios
        Permission::create([
            'name'          => 'Listar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista todos los usuarios del sistema'
        ]);
        Permission::create([
            'name'          => 'Crear usuario',
            'slug'          => 'users.create',
            'description'   => 'Crear un usuario del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ver en detalle cada usuario del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Editar cualquier usuario del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Eliminar cualquier usuario del sistema'
        ]);

        // Roles
        Permission::create([
            'name'          => 'Listar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista todos los roles del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de rol',
            'slug'          => 'roles.show',
            'description'   => 'Ver en detalle cada rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de rol',
            'slug'          => 'roles.create',
            'description'   => 'Crear un rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de rol',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar rol',
            'slug'          => 'roles.destroy',
            'description'   => 'Eliminar cualquier rol del sistema'
        ]);

        // Areas
        Permission::create([
            'name'          => 'Listar áreas',
            'slug'          => 'areas.index',
            'description'   => 'Lista todos los áreas del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de área',
            'slug'          => 'areas.show',
            'description'   => 'Ver en detalle cada área del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de área',
            'slug'          => 'areas.create',
            'description'   => 'Crear un área del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de area',
            'slug'          => 'areas.edit',
            'description'   => 'Editar cualquier área del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar área',
            'slug'          => 'areas.destroy',
            'description'   => 'Eliminar cualquier área del sistema'
        ]);

        // Aspirantes
        Permission::create([
            'name'          => 'Listar aspirantes',
            'slug'          => 'aspirantes.index',
            'description'   => 'Lista todos los aspirantes del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de aspirante',
            'slug'          => 'aspirantes.show',
            'description'   => 'Ver en detalle cada aspirante del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de aspirante',
            'slug'          => 'aspirantes.create',
            'description'   => 'Crear un aspirante del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de aspirante',
            'slug'          => 'aspirantes.edit',
            'description'   => 'Editar cualquier aspirante del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar aspirante',
            'slug'          => 'aspirantes.destroy',
            'description'   => 'Eliminar cualquier aspirante del sistema'
        ]);

        // Carga familiar
        Permission::create([
            'name'          => 'Listar carga familiar',
            'slug'          => 'carga_familiar.index',
            'description'   => 'Lista todas las cargas familiares del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de carga familiar',
            'slug'          => 'carga_familiar.show',
            'description'   => 'Ver en detalle cada carga familiar del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de carga familiar',
            'slug'          => 'carga_familiar.create',
            'description'   => 'Crear un carga familiar del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de carga familiar',
            'slug'          => 'carga_familiar.edit',
            'description'   => 'Editar cualquier carga familiar del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar carga familiar',
            'slug'          => 'carga_familiar.destroy',
            'description'   => 'Eliminar cualquier carga familiar del sistema'
        ]);

        // Cargos
        Permission::create([
            'name'          => 'Listar cargos',
            'slug'          => 'cargos.index',
            'description'   => 'Lista todos los cargos del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de cargo',
            'slug'          => 'cargos.show',
            'description'   => 'Ver en detalle cada cargo del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de cargo',
            'slug'          => 'cargos.create',
            'description'   => 'Crear un cargo del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de cargo',
            'slug'          => 'cargos.edit',
            'description'   => 'Editar cualquier cargo del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar cargo',
            'slug'          => 'cargos.destroy',
            'description'   => 'Eliminar cualquier cargo del sistema'
        ]);

        // Conceptos
        Permission::create([
            'name'          => 'Listar conceptos',
            'slug'          => 'conceptos.index',
            'description'   => 'Lista todos los conceptos del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de concepto',
            'slug'          => 'conceptos.show',
            'description'   => 'Ver en detalle cada concepto del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de concepto',
            'slug'          => 'conceptos.create',
            'description'   => 'Crear un concepto del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de concepto',
            'slug'          => 'conceptos.edit',
            'description'   => 'Editar cualquier concepto del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar concepto',
            'slug'          => 'conceptos.destroy',
            'description'   => 'Eliminar cualquier concepto del sistema'
        ]);

        // Empleados
        Permission::create([
            'name'          => 'Listar empleados',
            'slug'          => 'empleados.index',
            'description'   => 'Lista todos los empleados del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de empleado',
            'slug'          => 'empleados.show',
            'description'   => 'Ver en detalle cada empleado del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de empleado',
            'slug'          => 'empleados.create',
            'description'   => 'Crear un empleado del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de empleado',
            'slug'          => 'empleados.edit',
            'description'   => 'Editar cualquier empleado del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar empleado',
            'slug'          => 'empleados.destroy',
            'description'   => 'Eliminar cualquier empleado del sistema'
        ]);

        // Entrevistas
        Permission::create([
            'name'          => 'Listar entrevistas',
            'slug'          => 'entrevistas.index',
            'description'   => 'Lista todas las entrevistas del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de entrevista',
            'slug'          => 'entrevistas.show',
            'description'   => 'Ver en detalle cada entrevista del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de entrevista',
            'slug'          => 'entrevistas.create',
            'description'   => 'Crear un entrevista del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de entrevista',
            'slug'          => 'entrevistas.edit',
            'description'   => 'Editar cualquier entrevista del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar entrevista',
            'slug'          => 'entrevistas.destroy',
            'description'   => 'Eliminar cualquier entrevista del sistema'
        ]);

        // Expedientes
        Permission::create([
            'name'          => 'Listar expedientes',
            'slug'          => 'expedientes.index',
            'description'   => 'Lista todos los expedientes del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de expediente',
            'slug'          => 'expedientes.show',
            'description'   => 'Ver en detalle cada expediente del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de expediente',
            'slug'          => 'expedientes.create',
            'description'   => 'Crear un expediente del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de expediente',
            'slug'          => 'expedientes.edit',
            'description'   => 'Editar cualquier expediente del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar expediente',
            'slug'          => 'expedientes.destroy',
            'description'   => 'Eliminar cualquier expediente del sistema'
        ]);

        // Nóminas
        Permission::create([
            'name'          => 'Listar nóminas',
            'slug'          => 'nominas.index',
            'description'   => 'Lista todas las nóminas del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de nómina',
            'slug'          => 'nominas.show',
            'description'   => 'Ver en detalle cada nómina del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de nómina',
            'slug'          => 'nominas.create',
            'description'   => 'Crear un nómina del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de nómina',
            'slug'          => 'nominas.edit',
            'description'   => 'Editar cualquier nómina del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar nómina',
            'slug'          => 'nominas.destroy',
            'description'   => 'Eliminar cualquier nómina del sistema'
        ]);

        // Profesiones
        Permission::create([
            'name'          => 'Listar profesiones',
            'slug'          => 'profesiones.index',
            'description'   => 'Lista todas las profesiones del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de profesión',
            'slug'          => 'profesiones.show',
            'description'   => 'Ver en detalle cada profesión del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de profesión',
            'slug'          => 'profesiones.create',
            'description'   => 'Crear un profesión del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de profesión',
            'slug'          => 'profesiones.edit',
            'description'   => 'Editar cualquier profesión del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar profesión',
            'slug'          => 'profesiones.destroy',
            'description'   => 'Eliminar cualquier profesión del sistema'
        ]);

        // Sucursales
        Permission::create([
            'name'          => 'Listar sucursales',
            'slug'          => 'sucursales.index',
            'description'   => 'Lista todas las sucursales del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de sucursal',
            'slug'          => 'sucursales.show',
            'description'   => 'Ver en detalle cada sucursal del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de sucursal',
            'slug'          => 'sucursales.create',
            'description'   => 'Crear un sucursal del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de sucursal',
            'slug'          => 'sucursales.edit',
            'description'   => 'Editar cualquier sucursal del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar sucursal',
            'slug'          => 'sucursales.destroy',
            'description'   => 'Eliminar cualquier sucursal del sistema'
        ]);

        // Tabuladores salariales
        Permission::create([
            'name'          => 'Listar tabuladores salariales',
            'slug'          => 'tabuladores_salariales.index',
            'description'   => 'Lista todos los tabuladores salariales del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de tabulador salarial',
            'slug'          => 'tabuladores_salariales.show',
            'description'   => 'Ver en detalle cada tabulador salarial del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de tabulador salarial',
            'slug'          => 'tabuladores_salariales.create',
            'description'   => 'Crear un tabulador salarial del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de tabulador salarial',
            'slug'          => 'tabuladores_salariales.edit',
            'description'   => 'Editar cualquier tabulador salarial del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar tabulador salarial',
            'slug'          => 'tabuladores_salariales.destroy',
            'description'   => 'Eliminar cualquier tabulador salarial del sistema'
        ]);

        // Vacantes
        Permission::create([
            'name'          => 'Listar vacantes',
            'slug'          => 'vacantes.index',
            'description'   => 'Lista todas las vacantes del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de vacante',
            'slug'          => 'vacantes.show',
            'description'   => 'Ver en detalle cada vacante del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de vacante',
            'slug'          => 'vacantes.create',
            'description'   => 'Crear un vacante del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de vacante',
            'slug'          => 'vacantes.edit',
            'description'   => 'Editar cualquier vacante del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar vacante',
            'slug'          => 'vacantes.destroy',
            'description'   => 'Eliminar cualquier vacante del sistema'
        ]);

        // Variables
        Permission::create([
            'name'          => 'Listar variables',
            'slug'          => 'variables.index',
            'description'   => 'Lista todas las variables del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de variable',
            'slug'          => 'variables.show',
            'description'   => 'Ver en detalle cada variable del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de variable',
            'slug'          => 'variables.create',
            'description'   => 'Crear un variable del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de variable',
            'slug'          => 'variables.edit',
            'description'   => 'Editar cualquier variable del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar variable',
            'slug'          => 'variables.destroy',
            'description'   => 'Eliminar cualquier variable del sistema'
        ]);

        // Vouchers
        Permission::create([
            'name'          => 'Listar vouchers',
            'slug'          => 'vouchers.index',
            'description'   => 'Lista todos los vouchers del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de voucher',
            'slug'          => 'vouchers.show',
            'description'   => 'Ver en detalle cada voucher del sistema'
        ]);
        Permission::create([
            'name'          => 'Creación de voucher',
            'slug'          => 'vouchers.create',
            'description'   => 'Crear un voucher del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de voucher',
            'slug'          => 'vouchers.edit',
            'description'   => 'Editar cualquier voucher del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar voucher',
            'slug'          => 'vouchers.destroy',
            'description'   => 'Eliminar cualquier voucher del sistema'
        ]);

        //Permisos Modulo Operativo
        Permission::create([
            'name'          => 'Operaciones de taquilla',
            'slug'          => 'operacion.taquilla',
            'description'   => 'Vender, Reservar y check de boletos'
        ]);
        Permission::create([
            'name'          => 'Operaciones de Sucursal',
            'slug'          => 'operacion.sucursal',
            'description'   => 'Visualizar y cambiar estado de vuelos de sucursal'
        ]);
        Permission::create([
            'name'          => 'Planificaciòn de Vuelos',
            'slug'          => 'planificacion.vuelos',
            'description'   => 'Crear, Eliminar y modificar Vuelos y rutas'
        ]);
        //Permisos Modulo Reporte
        Permission::create([
            'name'          => 'Reporte de Personal',
            'slug'          => 'reporte.personal',
            'description'   => 'Visualizar y parametrizar reportes del personal'
        ]);
        Permission::create([
            'name'          => 'Reporte de Ingresos',
            'slug'          => 'reporte.ingreso',
            'description'   => 'Visualizar y parametrizar reportes del ingresos'
        ]);
        Permission::create([
            'name'          => 'Reporte de Servicios',
            'slug'          => 'reporte.servicio',
            'description'   => 'Visualizar y parametrizar reportes del servicios'
        ]);

    }
}

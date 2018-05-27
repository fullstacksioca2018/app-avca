<?php

// Rutas para el backend del módulo de Recursos Humanos de AVCA
Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
    // Dashboard
    Route::get('admin', 'rrhh\BackendController@dashboard')->name('dashboard');

    // Vacantes
    Route::group(['prefix' => 'vacante'], function () {
      Route::get('registrar', 'rrhh\VacanteController@create')->name('vacante.create');
      Route::post('publicar-vacante', 'rrhh\VacanteController@store')->name('vacante.store');
    });

    // Cargos
    require (__DIR__ . '/cargos.php');

    // Seleccion de aspirantes
    require (__DIR__ . '/aspirantes.php');

    // Datos del empleado
    Route::group(['prefix' => 'perfil'], function () {
        Route::get('perfil-empleado', 'rrhh\EmpleadoController@index')->name('empleado.profile');
        Route::post('datos-empleado', 'rrhh\EmpleadoController@obtenerEmpleado')->name('empleado.info');
        Route::get('obtener-sucursal', 'rrhh\EmpleadoController@obtenerSucursal');
        Route::get('obtener-departamento', 'rrhh\EmpleadoController@obtenerDepartamento');
        Route::get('obtener-cargo', 'rrhh\EmpleadoController@obtenerCargo');
        Route::post('actualizar-empleado', 'rrhh\EmpleadoController@actualizarEmpleado')->name('empleado.update');
        Route::get('obtener-carga-familiar', 'rrhh\EmpleadoController@obtenerCargaFamiliar');
        Route::post('agregar-carga-familiar', 'rrhh\EmpleadoController@agregarCargaFamiliar');
        Route::put('actualizar-estatus/{id}', 'rrhh\EmpleadoController@actualizarEstatus');
        Route::get('obtener-conceptos', 'rrhh\EmpleadoController@obtenerConceptos');
        Route::post('guardar-ingresos-deducciones', 'rrhh\EmpleadoController@guardarIngresosDeducciones');
        Route::get('obtener-expedientes/{empleado}', 'rrhh\ExpedienteController@obtenerExpedientes');
        Route::post('guardar-expediente', 'rrhh\ExpedienteController@guardarExpediente');
    });

    // Contratacion
    Route::group(['prefix' => 'contratacion'], function () {
        Route::get('contratacion', 'rrhh\ContratacionController@formContratacion')->name('contratacion.form');
        Route::post('contratacion', 'rrhh\ContratacionController@procesarContratacion')->name('contratacion.form');
        Route::get('obtener-aspirante-info/{id}', 'rrhh\ContratacionController@obtenerAspiranteInfo');
        Route::get('obtener-estados', 'rrhh\ContratacionController@obtenerEstados');
        Route::get('obtener-profesiones', 'rrhh\ContratacionController@obtenerProfesiones');
        Route::get('obtener-departamentos', 'rrhh\ContratacionController@obtenerDepartamentos');
        Route::get('obtener-profesiones/{nivel_academico}', 'rrhh\ContratacionController@obtenerProfesiones');
        Route::get('obtener-sucursales', 'rrhh\ContratacionController@obtenerSucursales');
        Route::get('obtener-cargos', 'rrhh\ContratacionController@obtenerCargos');
        Route::get('obtener-tabulador', 'rrhh\ContratacionController@obtenerTabuladorSalarial');
        Route::get('obtener-bancos', 'rrhh\ContratacionController@obtenerBancos');
    });

    //  Nóminas
    Route::group(['prefix' => 'nomina', 'namespace' => 'rrhh'], function () {
        Route::get('generar-nomina', 'NominaController@generarNominas')->name('nomina.generate');
        Route::get('obtener-nominas', 'NominaController@obtenerNominas');
        Route::post('procesar-nomina', 'NominaController@procesarNomina');
        Route::get('consultar-nomina', 'NominaController@consultarNomina')->name('nomina.consult');
        // Rutas para la consulta de nomina
        Route::get('obtener-vouchers', 'NominaController@obtenerVouchers');
    });

    Route::group(['prefix' => 'mantenimiento', 'namespace' => 'rrhh'], function () {
        Route::get('listado-sucursales', 'SucursalController@listadoSucursales')->name('sucursal.list');
        Route::post('registrar-sucursal', 'SucursalController@registrarSucursal')->name('sucursal.store');
        Route::get('obtener-sucursal/{sucursal}', 'SucursalController@obtenerSucursal')->name('sucursal.edit');
        Route::post('actualizar-sucursal', 'SucursalController@actualizarSucursal');

        // Parametros de nominas
        Route::get('parametros-nominas', 'ParametrosController@listadoParametros')->name('parametros.list');
        Route::get('obtener-conceptos', 'ParametrosController@obtenerConceptos')->name('conceptos.get');
        Route::post('registrar-concepto', 'ParametrosController@registrarConcepto')->name('concepto.store');
        Route::get('obtener-concepto/{concepto}', 'ParametrosController@obtenerConcepto')->name('concepto.get');
        Route::post('actualizar-concepto', 'ParametrosController@actualizarConcepto')->name('concepto.update');
        
        // Variables
        Route::get('obtener-variables', 'ParametrosController@obtenerVariables')->name('variables.get');
        Route::post('registrar-variable', 'ParametrosController@registrarVariable')->name('variable.store');
        Route::get('obtener-variable/{variable}', 'ParametrosController@obtenerVariable')->name('variable.get');
        Route::post('actualizar-variable', 'ParametrosController@actualizarVariable')->name('variable.update');

        // Tabulador salarial
        Route::get('obtener-tabuladores', 'ParametrosController@obtenerTabuladores')->name('tabuladores.get');
        Route::post('registrar-tabulador', 'ParametrosController@registrarTabulador')->name('tabulador.store');
        Route::get('obtener-tabulador/{tabulador}', 'ParametrosController@obtenerTabulador')->name('tabulador.get');
        Route::post('actualizar-tabulador', 'ParametrosController@actualizarTabulador')->name('tabulador.update');
        

    });

    // Consultas AJAX
    Route::get('obtener-sucursales', 'rrhh\EmpleadoController@obtenerSucursales');
    Route::get('obtener-areas', 'rrhh\EmpleadoController@obtenerAreas');
    Route::get('obtener-cargos/{area}', 'rrhh\EmpleadoController@obtenerCargos');
    Route::get('obtener-aspirantes', 'rrhh\SeleccionController@obtenerAspirantes');
    Route::get('obtener-aspirantes-estatus/{estatus}', 'rrhh\SeleccionController@obtenerAspirantesEstatus');
    Route::get('cambiar-estatus', 'rrhh\SeleccionController@cambiarEstatus');
    Route::post('enviar-convocatoria', 'rrhh\SeleccionController@enviarConvocatoria');
    Route::post('guardar-entrevista', 'rrhh\SeleccionController@guardarEntrevista');
    Route::get('obtener-datos-entrevista/{aspirante}', 'rrhh\SeleccionController@obtenerDatosEntrevista');

    Route::get('obtener-aspirantes/{cedula}', 'rrhh\BusquedaController@obtenerAspirantesPorCedula');

    // Roles
    require(__DIR__ . '/roles.php');

    // Usuarios
    require(__DIR__ . '/users.php');    
});

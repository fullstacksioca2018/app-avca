<?php

// Rutas para el frontend del módulo de Recursos Humanos de AVCA
Route::group(['prefix' => 'backend', 'middleware' => 'auth'], function() {
    Route::get('admin', 'rrhh\BackendController@dashboard')->name('dashboard');
    // Vacantes
    Route::group(['prefix' => 'vacante'], function () {
      Route::get('registrar', 'rrhh\VacanteController@create')->name('vacante.create');
      Route::post('publicar-vacante', 'rrhh\VacanteController@store')->name('vacante.store');
    });

    // Cargos
    Route::group(['prefix' => 'cargo'], function() {
        Route::get('listar-cargos', 'rrhh\CargoController@list')->name('cargo.list');
        Route::get('crear-cargo', 'rrhh\CargoController@create')->name('cargo.create');
        Route::post('registrar-cargo', 'rrhh\CargoController@store')->name('cargo.store');
        Route::get('editar-cargo/{id}', 'rrhh\CargoController@edit')->name('cargo.edit');
        Route::post('actualizar-cargo/{id}', 'rrhh\CargoController@update')->name('cargo.update');
    });

    // Seleccion
    Route::group(['prefix' => 'seleccion'], function () {
        Route::get('seleccion', 'rrhh\SeleccionController@index')->name('seleccion.list');
    });

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
});

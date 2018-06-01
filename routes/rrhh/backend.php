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

    // Datos del empleado || Perfil
    require (__DIR__ . '/perfil.php');    

    // Contratacion
    require(__DIR__ . '/contratacion.php');

    //  Nóminas
    require(__DIR__ . '/nomina.php');

    // Mantenimiento
    require(__DIR__ . '/mantenimiento.php');

    // Asistencia
    require (__DIR__ . '/asistencia.php');

    // Gerente de sucursal
    require(__DIR__ . '/gerente_sucursal.php');

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

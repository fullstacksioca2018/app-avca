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

    // Consultas AJAX
    Route::get('obtener-sucursales', 'rrhh\EmpleadoController@obtenerSucursales');
    Route::get('obtener-areas', 'rrhh\EmpleadoController@obtenerAreas');
    Route::get('obtener-cargos/{area}', 'rrhh\EmpleadoController@obtenerCargos');
    Route::get('obtener-aspirantes', 'rrhh\SeleccionController@obtenerAspirantes');
    Route::get('obtener-aspirantes-estatus/{estatus}', 'rrhh\SeleccionController@obtenerAspirantesEstatus');
    Route::get('cambiar-estatus', 'rrhh\SeleccionController@cambiarEstatus');
});

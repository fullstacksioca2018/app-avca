<?php

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
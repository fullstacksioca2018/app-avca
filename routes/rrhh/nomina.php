<?php

Route::group(['prefix' => 'nomina', 'namespace' => 'rrhh'], function () {
    Route::get('empleados', 'NominaController@empleados')->name('nomina.empleados');
    Route::get('generar-nomina', 'NominaController@generarNominas')->name('nomina.generate');
    Route::get('obtener-nominas', 'NominaController@obtenerNominas');
    Route::post('procesar-nomina', 'NominaController@procesarNomina');
    Route::get('consultar-nomina', 'NominaController@consultarNomina')->name('nomina.consult');
    // Rutas para la consulta de nomina
    Route::get('obtener-vouchers', 'NominaController@obtenerVouchers');
    Route::get('nominas-generadas', 'NominaController@verNominasGeneradas')->name('nomina.generadas');
    Route::get('conceptos-mes', 'NominaController@conceptosPorMes');
});
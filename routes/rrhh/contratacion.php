<?php

Route::group(['prefix' => 'contratacion', 'namespace' => 'rrhh'], function () {
    Route::get('contratacion', 'ContratacionController@formContratacion')->name('contratacion.form');
    Route::post('contratacion', 'ContratacionController@procesarContratacion')->name('contratacion.form');

    //Rutas AJAX
    Route::get('obtener-aspirante-info/{id}', 'ContratacionController@obtenerAspiranteInfo');
    Route::get('obtener-estados', 'ContratacionController@obtenerEstados');
    Route::get('obtener-profesiones', 'ContratacionController@obtenerProfesiones');
    Route::get('obtener-departamentos', 'ContratacionController@obtenerDepartamentos');
    Route::get('obtener-profesiones/{nivel_academico}', 'ContratacionController@obtenerProfesiones');
    Route::get('obtener-sucursal', 'ContratacionController@obtenerSucursal');
    Route::get('obtener-cargo', 'ContratacionController@obtenerCargo');
    Route::get('obtener-tabulador', 'ContratacionController@obtenerTabuladorSalarial');
    Route::get('obtener-bancos', 'ContratacionController@obtenerBancos');

    // Contrato laboral
    Route::get('contrato-laboral', 'ContratacionController@listarEmpleados')->name('empleados.list');
    Route::get('generar-contrato-pdf/{empleado}', 'ContratacionController@generarContratoPdf')->name('pdf.contract');
});
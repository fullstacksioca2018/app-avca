<?php

Route::group(['prefix' => 'sucursal', 'namespace' => 'rrhh'], function () {
    Route::get('empleados/{sucursal}', 'EmpleadoController@empleadosPorSucursal')->name('empleados.sucursal');
    Route::get('empleados-asistentes/{sucursal}', 'EmpleadoController@empleadosPorSucursalAsistentes')->name('empleados.sucursal.asistentes');
    Route::get('calendario-feriado/{sucursal}', 'EmpleadoController@CalendarioFeriado')->name('calendario.feriado');
    Route::post('agregar-evento-calendario', 'EmpleadoController@guardarEventoCalendario')->name('calendar.store');
    Route::post('editar-evento-calendario', 'EmpleadoController@editarEventoCalendario')->name('calendar.edit');    
});
<?php

Route::group(['prefix' => 'asistencia', 'namespace' => 'rrhh'], function () {
    Route::get('registrar-ingreso', 'AsistenciaController@registrarIngreso')->name('asistencia.register');
    Route::get('obtener-empleado/{codigo}', 'AsistenciaController@obtenerEmpleado');
});

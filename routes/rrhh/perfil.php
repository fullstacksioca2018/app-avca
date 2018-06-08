<?php

Route::group(['prefix' => 'perfil'], function () {
    Route::get('perfil-empleado', 'rrhh\EmpleadoController@index')->name('empleado.profile');
    Route::post('datos-empleado', 'rrhh\EmpleadoController@obtenerEmpleado')->name('empleado.info');
    Route::get('obtener-sucursal', 'rrhh\EmpleadoController@obtenerSucursal');
    Route::get('obtener-departamento', 'rrhh\EmpleadoController@obtenerDepartamento');
    Route::get('obtener-cargo', 'rrhh\EmpleadoController@obtenerCargo');
    Route::post('actualizar-empleado', 'rrhh\EmpleadoController@actualizarEmpleadoSucursal')->name('empleado.update');
    Route::get('obtener-carga-familiar', 'rrhh\EmpleadoController@obtenerCargaFamiliar');
    Route::post('agregar-carga-familiar', 'rrhh\EmpleadoController@agregarCargaFamiliar');
    Route::put('actualizar-estatus/{id}', 'rrhh\EmpleadoController@actualizarEstatus');
    Route::get('obtener-conceptos', 'rrhh\EmpleadoController@obtenerConceptos');
    Route::post('guardar-ingresos-deducciones', 'rrhh\EmpleadoController@guardarIngresosDeducciones');
    Route::get('obtener-expedientes/{empleado}', 'rrhh\ExpedienteController@obtenerExpedientes');
    Route::post('guardar-expediente', 'rrhh\ExpedienteController@guardarExpediente');
});
<?php

Route::group(['prefix' => 'empleado', 'namespace' => 'rrhh'], function () {
    // Dashboard
    Route::get('panel', 'EmpleadoController@dashboard')->name('dashboard');
    Route::get('panel-empleado/{empleado?}/{section?}', 'EmpleadoController@dashboardEmpleado')->name('dashboard.empleado');
    Route::put('actualizar-ficha/{empleado}', 'EmpleadoController@actualizarEmpleado')->name('empleado.actualizar-ficha');

    // Para imprimir
    Route::get('imprimir-voucher/{empleado}/{mes?}', 'EmpleadoController@imprimirVoucher')->name('voucher.print'); 
    Route::get('imprimir-carga-familiar/{empleado}', 'EmpleadoController@imprimirCargaFamiliar')->name('carga-familiar.print');
    Route::get('imprimir-constancia-trabajo/{empleado}', 'EmpleadoController@imprimirConstanciaTrabajo')->name('constancia-trabajo.print');

    Route::get('vouchers/{empleado}/{mes?}', 'EmpleadoController@voucherPagoAjax');    // Consulta ajax    
});

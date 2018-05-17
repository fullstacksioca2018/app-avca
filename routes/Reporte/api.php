<?php 


Route::get('listar-cargos', 'Reportes\ApiControllerDW@listCargos')->name('cargo.list.DW');


Route::group(['prefix' => 'reportes'], function() {
    Route::get('/api/vuelos/{estado}', 'Reportes\DashboardController@vuelosEstadoQuincena')->name('reportes.vuelo.estado');

    Route::get('/api/ingresos','Reportes\ApiControllerDW@reporteIngresos')->name('reportes.ingresos');
});





 ?>

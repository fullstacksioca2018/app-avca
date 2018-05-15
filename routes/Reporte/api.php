<?php 


Route::get('listar-cargos', 'Reportes\ApiControllerDW@listCargos')->name('cargo.list.DW');


Route::group(['prefix' => 'api'], function() {
    Route::get('/reporte/vuelos/{estado}', 'Reportes\DashboardController@vuelosEstado')->name('reportes.vuelo.estado');
});





 ?>

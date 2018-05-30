<?php 


Route::get('listar-cargos', 'Reportes\ApiControllerDW@listCargos')->name('cargo.list.DW');


Route::group(['prefix' => 'reportes'], function() {
    Route::get('/api/vuelos/{estado}', 'Reportes\DashboardController@vuelosEstadoQuincena')->name('reportes.vuelo.estado');

    Route::get('/api/ingresos','Reportes\ApiControllerDW@reporteIngresos')->name('reportes.ingresos');
    Route::get('/api/ingresos/pronostico','Reportes\ApiControllerDW@PROMEDIOMOVILDOBLE')->name('reportes.ingresosP');
    Route::get('/api/rutas','Reportes\ApiControllerDW@listRutas')->name('reportes.rutas');

    Route::post('/api/reporte/Personal','Reportes\ReportePersonalController@ReportePersonal')->name('reportes.reporte.Personal');

    Route::post('/api/reporte/Ingresos','Reportes\ReporteIngresosController@ReporteIngreso')->name('reportes.reporte.Ingresos');
    

    Route::post('/api/reporte/Servicios','Reportes\ReporteServiciosController@ReporteServicio')->name('reportes.reporte.Servicios');

    // Route::get('/api/prueba','Reportes\PanelController@prueba')->name('reportes.prueba');
     Route::get('/api/prueba','Reportes\ReporteServiciosController@prueba')->name('reportes.prueba');
     // Route::get('/api/prueba','Reportes\ReporteIngresosController@prueba')->name('reportes.prueba');
     // 
     // 
     
     Route::get('/api/pronostico','Reportes\PronosticoController@PROMEDIOMOVILDOBLE')->name('reportes.pronostico');


});





 ?>

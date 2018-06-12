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
     
     // Route::get('/api/prueba','Reportes\PronosticoController@prueba')->name('reportes.prueba');
     


     Route::post('/api/pronostico/Vuelos','Reportes\PronosticoVuelosController@PanelPronosticar')->name('pronostico.vuelos');

     Route::post('/api/pronostico/Pasajeros','Reportes\PronosticoPasajerosController@PanelPronosticar')->name('pronostico.pasajeros');
     Route::get('/api/pronostico/Pasajeros','Reportes\PronosticoPasajerosController@prueba')->name('pronostico.pasajeros');
     Route::get('/api/pronostico/Ingresos','Reportes\PronosticoIngresosController@prueba')->name('pronostico.ingresos.p');
     Route::get('/api/pronostico/Vuelos','Reportes\PronosticoVuelosController@prueba')->name('pronostico.vuelos.p');

     Route::post('/api/pronostico/Ingresos','Reportes\PronosticoIngresosController@PanelPronosticar')->name('pronostico.ingresos');
     

});





 ?>

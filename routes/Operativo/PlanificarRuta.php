<?php
    Route::group(['prefix'=>'rutas', /* 'middleware' => 'auth' */], function(){

        Route::get('/','Operativo\PlanificarRutaController@ruta')->name('ruta');
        Route::get('/rutas','Operativo\PlanificarRutaController@rutas');
        Route::get('/rutas/all','Operativo\PlanificarRutaController@rutasTodas');
        Route::post('/rutas','Operativo\PlanificarRutaController@ModificarRuta');
        Route::get('/rutas2','Operativo\PlanificarRutaController@ModificarRuta2');
        Route::post('/rutas/deshabilitar','Operativo\PlanificarRutaController@EliminarRuta');
        Route::post('/rutas/habilitar','Operativo\PlanificarRutaController@HabilitarRuta');
    
        
    });

    

    

?>
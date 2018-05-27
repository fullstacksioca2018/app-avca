<?php
    Route::group(['prefix'=>'aeronave', /* 'middleware' => 'auth' */], function(){

        Route::get('/','Operativo\PlanificarAeronaveController@aeronave');
        Route::get('/aeronaves','Operativo\PlanificarAeronaveController@aeronaves');
        Route::post('/aeronaves/deshabilitar','Operativo\PlanificarAeronaveController@deshabilitar');
        Route::post('/aeronaves/habilitar','Operativo\PlanificarAeronaveController@habilitar');
        Route::post('/aeronaves','Operativo\PlanificarAeronaveController@modificar');
    });
?>



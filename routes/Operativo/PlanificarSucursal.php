<?php
    Route::group(['prefix'=>'sucursales', /* 'middleware' => 'auth' */], function(){

        Route::get('/','Operativo\PlanificarSucursalController@sucursal');
        /* Route::get('/sucursales','Operativo\PlanificarSucursalController@sucursales');
        Route::post('/sucursales/deshabilitar','Operativo\PlanificarSucursalController@deshabilitar');
        Route::post('/sucursales/habilitar','Operativo\PlanificarSucursalController@habilitar');
        Route::post('/sucursales','Operativo\PlanificarSucursalController@modificar'); */
    });
?>

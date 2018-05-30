<?php
    Route::group(['prefix'=>'sucursales', /* 'middleware' => 'auth' */], function(){      
   
        Route::get('/','Operativo\PlanificarSucursalController@sucursal');
        Route::post('/','Operativo\PlanificarSucursalController@guardar');
        Route::post('deshabilitar','Operativo\PlanificarSucursalController@deshabilitar');
        Route::post('habilitar','Operativo\PlanificarSucursalController@habilitar');
        Route::post('/sucursales','Operativo\PlanificarSucursalController@modificar');

        Route::get('/all','Operativo\PlanificarRutaController@obtenerruta');
        Route::post('/ruta','Operativo\PlanificarRutaController@crearuta');
       
        /* 
        
        Route::post('/sucursales/habilitar','Operativo\PlanificarSucursalController@habilitar');
        Route::post('/sucursales','Operativo\PlanificarSucursalController@modificar'); */
    });
?>

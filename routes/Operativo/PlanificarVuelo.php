<?php
    Route::group(['prefix'=>'vuelos',/* 'middleware' => 'auth' */], function(){

        Route::get('/','Operativo\PlanificarVueloController@vuelo');
        Route::get('/vuelos','Operativo\PlanificarVueloController@vuelos');
        Route::get('/rutas','Operativo\PlanificarVueloController@rutas');
        Route::get('/pilotos','Operativo\PlanificarVueloController@pilotos');
        Route::post('/disponibilidad','Operativo\PlanificarVueloController@disponibilidad');
        Route::get('/disponibilidad','Operativo\PlanificarVueloController@prueba'); 
        Route::post('/crear','Operativo\PlanificarVueloController@crear');
        Route::get('/crear','Operativo\PlanificarVueloController@creart');
        Route::post('/ejecutar','Operativo\PlanificarVueloController@ejecutar');
        Route::post('/cancelar','Operativo\PlanificarVueloController@cancelar');
        

        
    });

   

?>
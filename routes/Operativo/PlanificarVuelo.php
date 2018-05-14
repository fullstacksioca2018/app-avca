<?php
    Route::group(['prefix'=>'vuelos'], function(){

        Route::get('/','Operativo\PlanificarVueloController@vuelo');
        Route::get('/vuelos','Operativo\PlanificarVueloController@vuelos');
        Route::get('/rutas','Operativo\PlanificarVueloController@rutas');
        Route::get('/pilotos','Operativo\PlanificarVueloController@pilotos');
     
    
        
    });

   

?>
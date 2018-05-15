<?php
    Route::group(['prefix'=>'vuelos'], function(){

        Route::get('/','Operativo\PlanificarVueloController@vuelo');
        Route::get('/vuelos','Operativo\PlanificarVueloController@vuelos');
     
    
        
    });

   

?>
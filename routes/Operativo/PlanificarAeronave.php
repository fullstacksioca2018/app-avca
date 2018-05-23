<?php
    Route::group(['prefix'=>'aeronave', /* 'middleware' => 'auth' */], function(){

        Route::get('/','Operativo\PlanificarAeronaveController@aeronave');
    });
?>
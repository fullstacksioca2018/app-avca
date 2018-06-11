<?php
    Route::group(['prefix'=>'operativo',/* 'middleware' => 'auth' */], function(){

        Route::get('/reportes/boletos','Operativo\ReporteBoleto@boletos');
   

        
    });
   
   

?>
<?php 
	//Boleteria
	Route::group(['prefix'=>'rutas'],function(){
        Route::get('/','operativo\RutaController@ruta');
        Route::get('/rutas','operativo\RutaController@rutas');
    });
?>
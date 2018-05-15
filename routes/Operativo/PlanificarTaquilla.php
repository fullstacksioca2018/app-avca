<?php 
	//Boleteria
	Route::group(['prefix'=>'taquilla','middleware' => 'auth'],function(){
		Route::get('/','Operativo\TaquillaController@taquilla')->name('soloida');
		Route::get('/idayvuelta','Operativo\TaquillaController@taquilla')->name('idayvuelta');
		Route::get('/multidestino','Operativo\TaquillaController@taquilla')->name('multidestino');
		Route::get('/DetalleVuelo','Operativo\TaquillaController@DetalleVuelo')->name('taquilla.DetalleVuelo');
		
	});
?>
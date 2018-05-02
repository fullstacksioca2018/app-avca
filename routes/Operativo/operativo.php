<?php
	Route::group(['prefix'=>'taquilla',],function(){
		Route::get('/','operativo\TaquillaController@taquilla')->name('soloida');
		Route::get('/idayvuelta','TaquillaController@taquilla')->name('idayvuelta');
		Route::get('/multidestino','TaquillaController@taquilla')->name('multidestino');
		Route::get('/DetalleVuelo','TaquillaController@DetalleVuelo')->name('taquilla.DetalleVuelo');
		
	});
?>
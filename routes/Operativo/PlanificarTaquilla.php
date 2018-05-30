<?php 
	//taquilla
	Route::group(['prefix'=>'taquilla',/* 'middleware' => 'auth' */],function(){
		Route::get('/','Operativo\TaquillaController@taquilla')->name('soloida');
		Route::get('/idayvuelta','Operativo\TaquillaController@taquilla')->name('idayvuelta');
		Route::get('/multidestino','Operativo\TaquillaController@taquilla')->name('multidestino');
		Route::get('/DetalleVuelo','Operativo\TaquillaController@DetalleVuelo')->name('taquilla.DetalleVuelo');
		Route::get('/DetalleVuelo2','Operativo\TaquillaController@DetalleVuelo2')->name('taquilla.DetalleVuelo2');
		Route::get('/CompraBoleto','Operativo\TaquillaController@CompraBoleto')->name('operativo.CompraBoleto');
		Route::get('/taquilla/BuscarCedula','Operativo\TaquillaController@BuscarCedula');
		Route::post('/BoletoVendido', 'Operativo\TaquillaController@BoletoVendido')->name('operativo.BoletoVendido');
	});
	//Check
    Route::group(['prefix'=>'check',/* 'middleware' => 'auth' */],function(){
		Route::get('/','Operativo\CheckController@check');
		Route::get('/check','Operativo\CheckController@checks');
		Route::get('/chequeados','Operativo\CheckController@chequeados');
		Route::get('/todos','Operativo\CheckController@todos');
		Route::post('/check/chekear','Operativo\CheckController@checkearBoleto');
		Route::post('/maletas','Operativo\CheckController@addMaletas');

		
	});
?>
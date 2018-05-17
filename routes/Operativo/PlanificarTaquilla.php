<?php 
	//taquilla
	Route::group(['prefix'=>'taquilla','middleware' => 'auth'],function(){
		Route::get('/','Operativo\TaquillaController@taquilla')->name('soloida');
		Route::get('/idayvuelta','Operativo\TaquillaController@taquilla')->name('idayvuelta');
		Route::get('/multidestino','Operativo\TaquillaController@taquilla')->name('multidestino');
		Route::get('/DetalleVuelo','Operativo\TaquillaController@DetalleVuelo')->name('taquilla.DetalleVuelo');
		Route::get('/CompraBoleto/{indicador}','Operativo\TaquillaController@CompraBoleto')->name('operativo.CompraBoleto');
		Route::post('/BoletoVendido', 'Operativo\TaquillaController@BoletoVendido')->name('operativo.BoletoVendido');
	});
	Route::group(['prefix'=>'compra','middleware' => 'auth'],function(){
		Route::get('/','Operativo\TaquillaController@DetalleVuelo');
		
		
		
	});
?>
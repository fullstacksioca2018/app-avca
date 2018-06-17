<?php 
	//taquilla
	Route::group(['prefix'=>'taquilla',/* 'middleware' => 'auth' */],function(){
		Route::get('/','Operativo\TaquillaController@taquilla')->name('soloida');
		Route::get('/idayvuelta','Operativo\TaquillaController@taquilla')->name('idayvuelta');
		Route::get('/multidestino','Operativo\TaquillaController@taquilla')->name('multidestino');
		Route::get('/DetalleVuelo','Operativo\TaquillaController@DetalleVuelo')->name('taquilla.DetalleVuelo');
		Route::get('/DetalleVuelo2','Operativo\TaquillaController@DetalleVuelo2')->name('taquilla.DetalleVuelo2');
		Route::post('/taquilla/imprimir','Operativo\TaquillaController@imprimir');
		Route::get('/CompraBoleto','Operativo\TaquillaController@CompraBoleto')->name('operativo.CompraBoleto');
		Route::get('/taquilla/BuscarCedula','Operativo\TaquillaController@BuscarCedula');
		Route::post('/BoletoVendido', 'Operativo\TaquillaController@BoletoVendido')->name('operativo.BoletoVendido');
		Route::get('/vuelos', 'Operativo\TaquillaController@DetalleVuelo');		
		//Route::get('/prueba','Operativo\TaquillaController@DetalleVuelo');
	});
	//Check
Route::group(['prefix'=>'check',/* 'middleware' => 'auth' */],function(){
	Route::get('/','Operativo\CheckController@check');
	Route::get('/check','Operativo\CheckController@checks');
	Route::get('/chequeados','Operativo\CheckController@chequeados');
	Route::get('/todos','Operativo\CheckController@todos');
	Route::get('/todos2','Operativo\CheckController@todos2');
	Route::post('/check/chekear','Operativo\CheckController@checkearBoleto');
	Route::post('/maletas','Operativo\CheckController@addMaletas');
	Route::post('/asientosAsignados','Operativo\CheckController@asignados');
});
//factura
Route::group(['prefix'=>'factura',/* 'middleware' => 'auth' */],function(){
	Route::get('/','Operativo\FacturacionController@factura');
	Route::get('/facturas','Operativo\FacturacionController@facturas');
	Route::post('/cancelar','Operativo\FacturacionController@cancelar');
	Route::post('/pagar','Operativo\FacturacionController@pagar');
	});
	//llegada de aviones
	Route::group(['prefix'=>'llegada',/* 'middleware' => 'auth' */],function(){
		Route::get('/','Operativo\FacturacionController@llegada');
		Route::get('/llegadas','Operativo\FacturacionController@llegadas');
		Route::post('/llego','Operativo\FacturacionController@llego');
	});
?>
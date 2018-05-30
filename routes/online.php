<?php

Route::get('/inicio', 'Online\ClienteController@index1')->name('cliente.index1');
Route::get('/inicio2', 'Online\ClienteController@index2')->name('cliente.index2');
Route::get('/inicio3', 'Online\ClienteController@index3')->name('cliente.index3');
Route::get('/home', 'Online\ClienteController@indexHome')->name('cliente.inicio2');


Route::get('/boletos', 'Online\UserController@boletos')->name('cliente.inicio3');



// Route::get('/', 'Online\ClienteController@index1')->name('cliente.index1');

Route::group(['prefix' => 'cliente'], function() {

	Route::get('equipaje', 'Online\ClienteController@equipaje')->name('cliente.equipaje');

    Route::get('documentacion', 'Online\ClienteController@documentacion')->name('cliente.documentacion');

	Route::get('ConsultarBoleto','Online\ClienteController@ConsultarBoleto')->name('cliente.ConsultarBoleto');


    Route::get('/DetalleVuelo', 'Online\ClienteController@DetalleVuelo')->name('online.cliente.DetalleVuelo');
    
    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'Online\ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'Online\ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');

    Route::get('/DetalleMultidestino2', 'Online\ClienteController@DetalleMultidestino2')->name('cliente.DetalleMultidestino2');

    Route::get('/DetalleMultidestino', 'Online\ClienteController@DetalleMultidestino')->name('cliente.DetalleMultidestino');

    Route::post('BoletoVendido', 'Online\ClienteController@BoletoVendido')->name('cliente.BoletoVendido');

    Route::get('/DetalleRetorno', 'Online\ClienteController@DetalleRetorno')->name('cliente.DetalleRetorno');

    Route::get('DetalleRetorno/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}/{retorno}', 'Online\ClienteController@DetalleRetorno2')->name('cliente.DetalleRetorno2');

    Route::post('BoletoVendidoRetorno', 'Online\ClienteController@BoletoVendido2')->name('cliente.BoletoVendidoRetorno');

    Route::get('ModificarPerfil/{id}', 'Online\UserController@edit')->name('cliente.ModificarPerfil');

    Route::post('/checkin', 'Online\ClienteController@Checkin')->name('cliente.Checkin');

    Route::post('home', 'Online\UserController@update')->name('cliente.ActualizarPerfil');

    Route::post('/inicio', 'Online\ClienteController@BoletoChequeado')->name('cliente.BoletoChequeado');

    Route::get('/MiPerfil/{id}', 'Online\UserController@MiPerfil')->name('cliente.MiPerfil');

    Route::post('/BoletoReservado', 'Online\RerservarBoletoController@ReservarBoleto')->name('cliente.ReservarBoleto');

    Route::post('/ReservaPagada', 'Online\RerservarBoletoController@PagarBoletoReservado')->name('cliente.PagarBoletoReservado');

});

Route::group(['prefix' => 'destino'], function() {
    
     Route::get('/cumana', 'Online\DestinoController@cumana')->name('destino.cumana'); 

});


//Rutas de login social
Route::get('auth/{provider}', 'OnlineAuth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'OnlineAuth\SocialAuthController@handleProviderCallback');











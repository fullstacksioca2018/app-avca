<?php

Route::get('/inicio', 'Online\ClienteController@index1')->name('cliente.index1');
Route::get('/home', 'Online\ClienteController@indexHome')->name('cliente.inicio2');

Route::get('/inicio2', 'Online\ClienteController@index2')->name('cliente.index2');

Route::get('/inicio3', 'Online\ClienteController@index3')->name('cliente.index3');

// Route::get('/', 'Online\ClienteController@index1')->name('cliente.index1');

Route::group(['prefix' => 'cliente'], function() {
    Route::get('/DetalleVuelo', 'Online\ClienteController@DetalleVuelo')->name('online.cliente.DetalleVuelo');
    
    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'Online\ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'Online\ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');

    Route::get('/DetalleMultidestino', 'Online\ClienteController@DetalleMultidestino2')->name('cliente.DetalleMultidestino2');
});
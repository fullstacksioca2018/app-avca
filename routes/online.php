<?php

Route::get('/inicio', 'Online\ClienteController@index1')->name('cliente.index1');

// Route::get('/', 'Online\ClienteController@index1')->name('cliente.index1');

Route::group(['prefix' => 'cliente'], function() {
    Route::get('/DetalleVuelo', 'Online\ClienteController@DetalleVuelo')->name('online.cliente.DetalleVuelo');
    
    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'Online\ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'Online\ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');
});
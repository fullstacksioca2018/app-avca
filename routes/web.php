<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Online\ClienteController@index1')->name('cliente.index1');
Route::get('/index2', 'Online\ClienteController@index2')->name('cliente.index2');
Route::get('/index3', 'Online\ClienteController@index3')->name('cliente.index3');
/*=================================*/
  		 // Rutas Clientes
/*=================================*/

Route::group(['prefix' => 'cliente'], function() {
    Route::get('/DetalleVuelo', 'Online\ClienteController@DetalleVuelo')->name('cliente.DetalleVuelo');

    Route::get('/DetalleRetorno', 'Online\ClienteController@DetalleRetorno')->name('cliente.DetalleRetorno');

    Route::get('/equipaje', 'Online\ClienteController@equipaje')->name('cliente.equipaje');

    Route::get('/documentacion', 'Online\ClienteController@documentacion')->name('cliente.documentacion');

    // Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'Online\ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    // Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'Online\ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');

    Route::get('DetalleRetorno/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}/{retorno}', 'Online\ClienteController@DetalleRetorno2')->name('cliente.DetalleRetorno2');

    Route::post('BoletoVendido', 'Online\ClienteController@BoletoVendido')->name('cliente.BoletoVendido');

    Route::post('BoletoVendidoRetorno', 'Online\ClienteController@BoletoVendido2')->name('cliente.BoletoVendidoRetorno');

    Route::get('/DetalleMultidestino', 'Online\ClienteController@DetalleMultidestino')->name('cliente.DetalleMultidestino');

});


Route::group(['prefix' => 'online'], function () {
  Route::get('/login', 'OnlineAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'OnlineAuth\LoginController@login');
  Route::post('/logout', 'OnlineAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'OnlineAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'OnlineAuth\RegisterController@register');

  Route::post('/password/email', 'OnlineAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'OnlineAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'OnlineAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'OnlineAuth\ResetPasswordController@showResetForm');
});

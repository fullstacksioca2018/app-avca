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


Route::get('/', 'ClienteController@index1')->name('cliente.index1');
Route::get('/index2', 'ClienteController@index2')->name('cliente.index2');
Route::get('/index3', 'ClienteController@index3')->name('cliente.index3');
/*=================================*/
  		 // Rutas Clientes
/*=================================*/

Route::group(['prefix' => 'cliente'], function() {
    Route::get('/DetalleVuelo', 'ClienteController@DetalleVuelo')->name('cliente.DetalleVuelo');

    Route::get('/DetalleRetorno', 'ClienteController@DetalleRetorno')->name('cliente.DetalleRetorno');

    Route::get('/equipaje', 'ClienteController@equipaje')->name('cliente.equipaje');

    Route::get('/documentacion', 'ClienteController@documentacion')->name('cliente.documentacion');

    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');

    Route::get('DetalleRetorno/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}/{retorno}', 'ClienteController@DetalleRetorno2')->name('cliente.DetalleRetorno2');

    Route::post('BoletoVendido', 'ClienteController@BoletoVendido')->name('cliente.BoletoVendido');

    Route::post('BoletoVendidoRetorno', 'ClienteController@BoletoVendido2')->name('cliente.BoletoVendidoRetorno');

    Route::get('/DetalleMultidestino', 'ClienteController@DetalleMultidestino')->name('cliente.DetalleMultidestino');

    Route::post('/DetalleMultidestino', 'ClienteController@DetalleMultidestino2')->name('cliente.DetalleMultidestino2');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'usuario'], function () {
  Route::get('/login', 'UsuarioAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'UsuarioAuth\LoginController@login');
  Route::post('/logout', 'UsuarioAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'UsuarioAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'UsuarioAuth\RegisterController@register');

  Route::post('/password/email', 'UsuarioAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'UsuarioAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'UsuarioAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'UsuarioAuth\ResetPasswordController@showResetForm');
});

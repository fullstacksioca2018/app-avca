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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


/* LANDING ONLIEN*/
Route::get('/', 'Online\ClienteController@index1')->name('cliente.index1');
Route::get('/index2', 'Online\ClienteController@index2')->name('cliente.index2');
Route::get('/index3', 'Online\ClienteController@index3')->name('cliente.index3');
     /* RUTAS PUBLICAS CLIENTE */
/*=================================*/
  		 // Rutas Clientes
/*=================================*/

Route::group(['prefix' => 'cliente'], function() {
    Route::get('/DetalleVuelo', 'Online\ClienteController@DetalleVuelo')->name('cliente.DetalleVuelo');

    // Route::get('/DetalleRetorno', 'Online\ClienteController@DetalleRetorno')->name('cliente.DetalleRetorno');

    Route::get('/equipaje', 'Online\ClienteController@equipaje')->name('cliente.equipaje');

    Route::get('/documentacion', 'Online\ClienteController@documentacion')->name('cliente.documentacion');

    // Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}', 'Online\ClienteController@CompraBoleto')->name('cliente.CompraBoleto');

    // Route::get('CompraBoleto/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}', 'Online\ClienteController@CompraBoleto2')->name('cliente.CompraBoleto2');

    // Route::get('DetalleRetorno/{cantidad}/{ninosbrazos}/{tarifa_vuelo}/{vuelo}/{retorno}', 'Online\ClienteController@DetalleRetorno2')->name('cliente.DetalleRetorno2');


    Route::get('/DetalleMultidestino', 'Online\ClienteController@DetalleMultidestino')->name('cliente.DetalleMultidestino');

    Route::post('/checkin', 'Online\ClienteController@Checkin')->name('cliente.Checkin'); 

    

});

/*Rutas destinos*/
Route::group(['prefix' => 'destino'], function() {
    
     Route::get('/cumana', 'Online\DestinoController@cumana')->name('destino.cumana'); 

});


/* AUTH ONLINE*/
Route::group(['prefix' => 'online'], function () {
  Route::get('/login', 'OnlineAuth\LoginController@showLoginForm')->name('online.login');
  Route::post('/login', 'OnlineAuth\LoginController@login');
  // Route::post('/logout', 'OnlineAuth\LoginController@cerrarOnline')->name('online.logout');

  Route::get('/register', 'OnlineAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'OnlineAuth\RegisterController@register');

  Route::post('/password/email', 'OnlineAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'OnlineAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'OnlineAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'OnlineAuth\ResetPasswordController@showResetForm');
});



require 'Operativo\PlanificarRuta.php';
require 'Operativo\PlanificarTaquilla.php';
require 'Operativo\PlanificarVuelo.php';
Route::get('/reportes', function () {
    return view('reportes.PanelConsulta');
});

Route::get('listar-cargos', 'Reportes\ApiControllerDW@listCargos')->name('cargo.list.DW');
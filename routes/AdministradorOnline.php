<?php 
Route::group(['prefix' => 'administrador'], function() {
	Route::get('/inicio',function () {
	    return view('online.administrador.inicio');
	})->name('administrador.online.inicio');

});

 ?>
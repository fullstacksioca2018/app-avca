 <?php

// Rutas para el frontend del módulo de Recursos Humanos de AVCA
Route::group(['prefix' => 'frontend', 'middleware' => 'guest'], function() {
   Route::get('/', 'rrhh\FrontendController@home')->name('home');
   Route::get('obtener-cargos/{area}', 'rrhh\FrontendController@obtenerCargos')->name('cargos.get');
   Route::get('perfil-cargo/{vacante_id}/{cargo_id}', 'rrhh\FrontendController@verPerfil')->name('perfil.show');
   Route::post('registrar-aspirante', 'rrhh\AspiranteController@store')->name('aspirante.store');
});

 <?php

// Rutas para el frontend del módulo de Recursos Humanos de AVCA
Route::group(['prefix' => 'frontend', 'middleware' => 'guest', 'namespace' => 'rrhh'], function() {
   Route::get('/', 'FrontendController@home')->name('home');
   Route::get('obtener-cargos/{area}', 'FrontendController@obtenerCargos')->name('cargos.get');
   Route::get('perfil-cargo/{vacante_id}/{cargo_id}', 'FrontendController@verPerfil')->name('perfil.show');
   Route::post('registrar-aspirante', 'FrontendController@registrarAspirante')->name('aspirante.store');
});

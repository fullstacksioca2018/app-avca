<?php

Route::group(['prefix' => 'cargo', 'namespace' => 'rrhh'], function() {
    Route::get('listar-cargos', 'CargoController@list')->name('cargo.list');
    Route::get('crear-cargo', 'CargoController@create')->name('cargo.create');
    Route::post('registrar-cargo', 'CargoController@store')->name('cargo.store');
    Route::get('editar-cargo/{id}', 'CargoController@edit')->name('cargo.edit');
    Route::post('actualizar-cargo/{id}', 'CargoController@update')->name('cargo.update');
    Route::get('generar-vacante/{cargo}', 'CargoController@cambiarEstatus')->name('cargo.vacante');
});
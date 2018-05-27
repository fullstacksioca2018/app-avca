<?php

Route::group(['prefix' => 'seleccion', 'namespace' => 'rrhh'], function () {
    Route::get('areas-vacantes', 'AspiranteController@obtenerAreasVacantes')->name('aspirantes.areas');
    Route::get('listado-aspirantes/{vacante}/{estatus}', 'AspiranteController@obtenerAspirantes')->name('aspirantes.list');
    Route::get('cambiar-estatus/{aspirante}/{vacante}/{estatus}', 'AspiranteController@cambiarEstatus')->name('aspirantes.cambiar-estatus');
    //Route::get('aspirantes-estatus/{vacante}/{estatus}', 'AspiranteController@obtenerAspirantes')->name('aspirantes.obtener-estatus');

    // Rutas ajax
    Route::get('aspirantes-estatus', 'AspiranteController@aspirantesPorEstatus');
    Route::get('cambiar-estatus', 'AspiranteController@cambiarEstatus');
    Route::post('enviar-convocatoria', 'AspiranteController@enviarConvocatoria');
    Route::post('guardar-entrevista', 'AspiranteController@guardarEntrevista');
    Route::get('obtener-datos-entrevista/{aspirante}', 'AspiranteController@obtenerDatosEntrevista');

    //Route::get('listado-cargos-vacantes', 'SeleccionController@listadoCargosVacante')->name('seleccion.listCargosVacante');
    Route::get('seleccion', 'SeleccionController@index')->name('seleccion.list');
});
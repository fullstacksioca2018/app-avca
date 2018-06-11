<?php

Route::group(['prefix' => 'analista', 'namespace' => 'rrhh'], function () {
    Route::get('empleados', 'AnalistaAreaController@empleados')->name('analista.empleados');
});
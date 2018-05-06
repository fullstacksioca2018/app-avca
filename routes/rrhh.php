<?php

// Rutas para el módulo de Recursos Humanos de AVCA (Landing)
Route::group(['prefix' => 'rrhh'], function() {
    // Rutas para el frontend
    require (__DIR__ . '/rrhh/frontend.php');

    // Rutas para el backend
    require (__DIR__ . '/rrhh/backend.php');
});
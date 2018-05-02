<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('usuario')->user();

    //dd($users);

    return view('usuario.home');
})->name('home');


<?php

Route::post('/login', 'UserController@login');

Route::post('/register', 'UserController@register');

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/cards', 'CardController@index');

    Route::post('/cards', 'CardController@store');

    Route::put('/cards/{card}', 'CardController@edit');

    Route::post('/logout', 'UserController@logout');
});


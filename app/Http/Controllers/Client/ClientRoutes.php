<?php

Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () 
{    
    Route::post('/registration', 'ClientController@getRegistration');
    Route::get('/aktivasi/{user_salt}', 'ClientController@getActivationToken');
});

<?php

Route::group(['namespace' => 'Client', 'prefix' => 'client'], function () {
	Route::post('/registration', 'ClientController@getRegistration');
	Route::post('/forgotPassword', 'ClientController@getForgotPassword');
	Route::get('/aktivasi/{user_salt}', 'ClientController@getActivationToken');
	Route::get('/logout', 'ClientController@logout');
	Route::get('/forgot-password/{user_salt}', 'ClientController@frontForgotPassword');
	Route::post('/change-password', 'ClientController@getChangePassword');
});

<?php

Route::group(['namespace' => 'Qurban', 'prefix' => 'qurban', 'middleware' => 'auth'], function () {
	Route::post('/create', 'QurbanController@tambah');
	Route::get('/data', 'QurbanController@getListData');
	Route::get('/', 'QurbanController@getDataQurban');
});

<?php

Route::group(['namespace' => 'Tabungan', 'prefix' => 'tabungan', 'middleware'=>'auth'], function () 
{    
    Route::post('/create', 'PengeluaranController@tambah');
	Route::get('/data', 'PengeluaranController@index');
	Route::get('/', 'TabunganController@getDataTabungan');
});

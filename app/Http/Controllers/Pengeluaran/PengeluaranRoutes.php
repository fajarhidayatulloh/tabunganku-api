<?php

Route::group(['namespace' => 'Pengeluaran', 'prefix' => 'pengeluaran','middleware'=>'auth'], function () 
{    
    Route::post('/create', 'PengeluaranController@tambah');
	Route::get('/data', 'PengeluaranController@index');
	Route::get('/', 'PengeluaranController@getDataPengeluaran');
});

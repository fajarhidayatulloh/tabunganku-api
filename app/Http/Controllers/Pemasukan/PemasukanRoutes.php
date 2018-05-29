<?php

Route::group(['namespace' => 'Pemasukan', 'prefix' => 'pemasukan','middleware'=>'auth'], function () 
{    
    Route::post('/create', 'PemasukanController@tambah');
	Route::get('/data', 'PemasukanController@getListData');
	Route::get('/', 'PemasukanController@getDataPemasukan');
});

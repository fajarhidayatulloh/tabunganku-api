<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



require app()->path(). '/Http/Controllers/Pemasukan/PemasukanRoutes.php';
require app()->path(). '/Http/Controllers/Pengeluaran/PengeluaranRoutes.php';
require app()->path(). '/Http/Controllers/Tabungan/TabunganRoutes.php';
require app()->path(). '/Http/Controllers/Client/ClientRoutes.php';
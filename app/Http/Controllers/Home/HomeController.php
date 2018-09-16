<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
	public function index() {
		$version = config('static.api.version');
		$name = config('static.api.name');
		return response()->json(['api_name' => $name, 'version' => $version]);
	}
}

<?php
if (!function_exists('config_path')) {
	/**
	 * Get the configuration path.
	 *
	 * @param  string $path
	 * @return string
	 */
	function config_path($path = '') {
		return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
	}
}

if (!function_exists('getUser')) {

	/**
	 * [getUser description]
	 * @return [type] [description]
	 */
	function getUser() {
		$user = \App\Model\Users::
			whereRaw('lower(email) = ?', strtolower(\Auth::user()->email))
			->firstOrFail();

		return $user;
	}

}
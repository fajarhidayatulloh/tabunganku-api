<?php

/**
 * author : Fajar Hidayatulloh
 */
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\DaftarRepository;
use Illuminate\Http\Request;

class ClientController extends Controller {

	protected $daftarRepository;

	/**
	 * [__construct description]
	 * @param DaftarRepository $daftarRepository [description]
	 */
	public function __construct(DaftarRepository $daftarRepository) {
		$this->daftarRepository = $daftarRepository;
	}

	/**
	 * [getRegistration description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function getRegistration(Request $request) {

		try {
			$input = $this->daftarRepository->setRegistration($request);
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'message' => 'Registrasi Berhasil, Cek Email Anda untuk Aktivasi.',
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => 'Registrasi Anda gagal, harap coba beberapa saat lagi.',
			], 422);
		}
	}

	/**
	 * [getActivationToken description]
	 * @param  [type] $user_salt [description]
	 * @return [type]            [description]
	 */
	public function getActivationToken($user_salt) {
		try {
			$input = $this->daftarRepository->setActivationToken($user_salt);
			return view('emails.aktivasi');
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => $e,
			], 422);
		}
	}

	/**
	 * [getForgotPassword description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function getForgotPassword(Request $request) {
		try {
			$user = $this->daftarRepository->setCheckEmail($request);
			if (!$user) {

				return response()->json([
					'success' => false,
					'status_code' => 422,
					'message' => 'Email yang Anda masukan tidak terdaftar!',
				], 422);

			}

			$user = $this->daftarRepository->setForgotPassword($request);
			return response()->json([
				'success' => true,
				'message' => 'Link Forgot Password sudah dikirim ke email Anda.',
			], 200);

		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => $e,
			], 422);
		}
	}

	public function frontForgotPassword($user_salt) {
		return view('emails.forgot');
	}

	public function getChangePassword(Request $request) {

		$input = $this->daftarRepository->setChangePassword($request);
		return view('emails.success');

	}

	/**
	 * [logout will revoke access token and delete the token from database]
	 * @param  Request $request [description]
	 * @return [type]           [json response logout status]
	 */
	public function logout(Request $request) {
		$request->user()->token()->revoke();
		$logout = $request->user()->token()->delete();
		return response()->json(array('success' => $logout, 'status_code' => '200'), '200');
	}

}

?>
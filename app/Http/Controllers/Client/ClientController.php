<?php  
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\DaftarRepository;
use Illuminate\Http\Request;

class ClientController extends Controller {

	protected $daftarRepository;

	public function __construct(DaftarRepository $daftarRepository){
		$this->daftarRepository = $daftarRepository;
	}

	public function getRegistration(Request $request) 
	{
		
		try {
			$input = $this->daftarRepository->setRegistration($request);
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'message' => 'Registrasi Berhasil, Cek Email Anda untuk Aktivasi.'
			], 200);
		} catch(\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => $e,
			], 422);
		}
	}

	public function getActivationToken($user_salt)
	{
		try {
			$input = $this->daftarRepository->setActivationToken($user_salt);
			return view('emails.aktivasi');
		} catch(\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => $e,
			], 422);
		}
	}
}

?>
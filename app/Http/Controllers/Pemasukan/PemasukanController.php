<?php
namespace App\Http\Controllers\Pemasukan;

use App\Http\Controllers\Controller;
use App\Repositories\PemasukanRepository;
use Illuminate\Http\Request;

class PemasukanController extends Controller {

	protected $pemasukanRepository;

	/**
	 * [author Fajar Hidayatulloh]
	 * [__construct description]
	 * @param PemasukanRepository $pemasukanRepository [description]
	 */
	public function __construct(PemasukanRepository $pemasukanRepository) {
		$this->pemasukanRepository = $pemasukanRepository;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [getListData description]
	 * @return [type] [description]
	 */
	public function getListData() {

		try {
			$model = $this->pemasukanRepository->setListData();
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'data' => $model,
			]);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
			], 422);
		}
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [getDataPemasukan description]
	 * @return [type] [description]
	 */
	public function getDataPemasukan() {
		try {

			$model = $this->pemasukanRepository->setDataPemasukan();
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'data' => $model,
			]);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
			], 422);
		}
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [tambah description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function tambah(Request $request) {

		try {
			$input = $this->pemasukanRepository->store($request);
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'message' => 'Data Berhasil di Tambah',
			], 200);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'status_code' => 422,
				'message' => 'Gagal Input Data',
			], 422);
		}
	}
}

?>
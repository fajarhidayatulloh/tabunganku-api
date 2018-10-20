<?php
namespace App\Http\Controllers\Qurban;

use App\Http\Controllers\Controller;
use App\Repositories\QurbanRepository;
use Illuminate\Http\Request;

class QurbanController extends Controller {

	protected $qurbanRepository;

	public function __construct(QurbanRepository $qurbanRepository) {
		$this->qurbanRepository = $qurbanRepository;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [getListData description]
	 * @return [type] [description]
	 */
	public function getListData() {

		try {
			$model = $this->qurbanRepository->setListData();
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
	public function getDataQurban() {
		try {

			$model = $this->qurbanRepository->setDataQurban();
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
			$input = $this->qurbanRepository->store($request);
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
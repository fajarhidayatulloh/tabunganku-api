<?php
namespace App\Http\Controllers\Pengeluaran;

use App\Http\Controllers\Controller;
use App\Repositories\PengeluaranRepository;
use Illuminate\Http\Request;

class PengeluaranController extends Controller {

	protected $pengeluaranRepository;

	/**
	 * [author Fajar Hidayatulloh]
	 * [__construct description]
	 * @param PengeluaranRepository $pengeluaranRepository [description]
	 */
	public function __construct(PengeluaranRepository $pengeluaranRepository) {
		$this->pengeluaranRepository = $pengeluaranRepository;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [index description]
	 * @return [type] [description]
	 */
	public function index() {

		try {

			$model = $this->pengeluaranRepository->setListData();
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
	 * [getDataPengeluaran description]
	 * @return [type] [description]
	 */
	public function getDataPengeluaran() {
		try {

			$model = $this->pengeluaranRepository->setDataPengeluaran();
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

			$input = $this->pengeluaranRepository->store($request);
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
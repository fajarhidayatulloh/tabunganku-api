<?php  
namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Repositories\TabunganRepository;

class TabunganController extends Controller {

	protected $tabunganRepository;

	public function __construct(TabunganRepository $tabunganRepository)
	{
		$this->tabunganRepository = $tabunganRepository;
	}

	public function getDataTabungan()
	{
		try {

			$model = $this->tabunganRepository->setDataTabungan();
			return response()->json([
				'success' => true,
				'status_code' => 200,
				'data' => $model
			], 200);

		} catch(\Exception $e) {

			return response()->json([
				'success' => false,
			], 422);
		}
	}
}

?>
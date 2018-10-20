<?php
namespace App\Repositories;

use App\Model\Qurban;
use App\Repositories\Contracts\QurbanRepository as Contracts;
use Cache;
use Illuminate\Http\Request;

class QurbanRepository implements Contracts {

	/**
	 * [author Fajar Hidayatulloh]
	 * [setListData description]
	 */
	public function setListData() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setListDataQurban';
		$setListData = Cache::remember($keyCache, $expiredAt, function () {
			$model = Qurban::where('id_user', \Auth::user()->id)->select('*')->get();
			return $model;
		});
		return $setListData;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [setDataQurban description]
	 */
	public function setDataQurban() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataQurban';
		$Qurbanku = 0;
		$setData = Cache::remember($keyCache, $expiredAt, function () use ($Qurbanku) {
			$Qurban = Qurban::select('jumlah')->where('id_user', \Auth::user()->id)->get();
			foreach ($Qurban as $row) {
				$Qurbanku += $row->jumlah;
			}
			$customMeta = [
				'totalQurban' => number_format($Qurbanku, 2, ',', '.'),
				'currency' => 'IDR',

			];

			return $customMeta;
		});

		return $setData;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [store description]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function store($request) {

		$input = new Qurban;
		$input->title = $request->title;
		$input->deskripsi = $request->deskripsi;
		$input->jumlah = $request->jumlah;
		$input->created_at = \Carbon\Carbon::now();
		$input->id_user = \Auth::user()->id;
		$input->save();
	}
}

?>
<?php
namespace App\Repositories;

use App\Model\Pemasukan;
use App\Repositories\Contracts\PemasukanRepository as Contracts;
use Cache;
use Illuminate\Http\Request;

class PemasukanRepository implements Contracts {

	/**
	 * [author Fajar Hidayatulloh]
	 * [setListData description]
	 */
	public function setListData() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setListDataPemasukan';
		$setListData = Cache::remember($keyCache, $expiredAt, function () {
			$model = Pemasukan::where('id_user', \Auth::user()->id)->select('*')->get();
			return $model;
		});
		return $setListData;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [setDataPemasukan description]
	 */
	public function setDataPemasukan() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataPemasukan';
		$pemasukanku = 0;
		$setData = Cache::remember($keyCache, $expiredAt, function () use ($pemasukanku) {
			$pemasukan = Pemasukan::select('jumlah')->where('id_user', \Auth::user()->id)->get();
			foreach ($pemasukan as $row) {
				$pemasukanku += $row->jumlah;
			}
			$customMeta = [
				'totalPemasukan' => number_format($pemasukanku, 2, ',', '.'),
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

		$input = new Pemasukan;
		$input->title = $request->title;
		$input->deskripsi = $request->deskripsi;
		$input->jumlah = $request->jumlah;
		$input->created_at = \Carbon\Carbon::now();
		$input->id_user = \Auth::user()->id;
		$input->save();
	}
}

?>
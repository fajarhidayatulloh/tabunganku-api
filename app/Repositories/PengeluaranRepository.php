<?php
namespace App\Repositories;

use App\Model\Pengeluaran;
use App\Repositories\Contracts\PengeluaranRepository as Contracts;
use Cache;
use Illuminate\Http\Request;

class PengeluaranRepository implements Contracts {

	/**
	 * [author Fajar Hidayatulloh]
	 * [setListData description]
	 */
	public function setListData() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setListDataPengeluaran';
		$setListData = Cache::remember($keyCache, $expiredAt, function () {
			$model = Pengeluaran::select('*')->where('id_user', \Auth::user()->id)->get();
			return $model;
		});
		return $setListData;
	}

	/**
	 * [author Fajar Hidayatulloh]
	 * [setDataPengeluaran description]
	 */
	public function setDataPengeluaran() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataPengeluaran';
		$pengeluaranku = 0;
		$setData = Cache::remember($keyCache, $expiredAt, function () use ($pengeluaranku) {
			$pengeluaran = Pengeluaran::select('jumlah')->where('id_user', \Auth::user()->id)->get();
			foreach ($pengeluaran as $row) {
				$pengeluaranku += $row->jumlah;
			}
			$customMeta = [
				'totalpengeluaran' => number_format($pengeluaranku, 2, ',', '.'),
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

		$input = new Pengeluaran;
		$input->title = $request->title;
		$input->deskripsi = $request->deskripsi;
		$input->jumlah = $request->jumlah;
		$input->created_at = \Carbon\Carbon::now();
		$input->id_user = \Auth::user()->id;
		$input->save();
	}
}

?>
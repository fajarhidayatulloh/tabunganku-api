<?php
namespace App\Repositories;

use App\Repositories\Contracts\TabunganRepository as Contracts;
use Cache;
use DB;

class TabunganRepository implements Contracts {

	/**
	 * [author Fajar Hidayatulloh]
	 * [setDataTabungan description]
	 */
	public function setDataTabungan() {
		$expiredAt = \Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataTabungan';
		$setData = Cache::remember($keyCache, $expiredAt, function () {
			$pemasukan = DB::table('pemasukan')->select('jumlah')->where('id_user', \Auth::user()->id)->sum('jumlah');
			$pengeluaran = DB::table('pengeluaran')->select('jumlah')->where('id_user', \Auth::user()->id)->sum('jumlah');
			$customMeta = [
				'totalTabungan' => number_format($pemasukan - $pengeluaran, 2, ',', '.'),
				'currency' => 'IDR',

			];
			return $customMeta;
		});
		return $setData;
	}
}

?>
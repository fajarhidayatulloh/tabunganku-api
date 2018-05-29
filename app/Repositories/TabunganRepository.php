<?php  
namespace App\Repositories;

use DB;
use Cache;
use App\Repositories\Contracts\TabunganRepository as Contracts;
use Illuminate\Http\Request;

class TabunganRepository implements Contracts {

	public function setDataTabungan()
	{
		$expiredAt=\Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataTabungan';
		$setData = Cache::remember($keyCache, $expiredAt, function(){
			$pemasukan = DB::table('pemasukan')->select('jumlah')->where('id_user',\Auth::user()->id)->sum('jumlah');
			$pengeluaran = DB::table('pengeluaran')->select('jumlah')->where('id_user',\Auth::user()->id)->sum('jumlah');
			$customMeta = [
	            'totalTabungan' => number_format($pemasukan - $pengeluaran, 2,',','.'),
	            'currency'  =>'IDR',

		    ];
		    return $customMeta;
		});
		return $setData;
	}
}

?>
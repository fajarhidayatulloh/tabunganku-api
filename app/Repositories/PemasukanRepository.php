<?php  
namespace App\Repositories;

use App\Model\Pemasukan;
use App\Repositories\Contracts\PemasukanRepository as Contracts;
use Illuminate\Http\Request;
use DB;
use Cache;

class PemasukanRepository implements Contracts {

	public function setListData()
	{
		$expiredAt=\Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setListDataPemasukan';
		$setListData = Cache::remember($keyCache, $expiredAt, function(){
			$model = Pemasukan::where('id_user',\Auth::user()->id)->select('*')->get();
			return $model;
		});
		return $setListData;
	}

	public function setDataPemasukan()
	{
		$expiredAt=\Carbon\Carbon::now()->addMinutes(5);
		$keyCache = 'tabunganku:setDataPemasukan';
		$pemasukanku = 0;
		$setData = Cache::remember($keyCache, $expiredAt, function() use($pemasukanku){
	        $pemasukan = Pemasukan::select('jumlah')->where('id_user',\Auth::user()->id)->get();
	        foreach($pemasukan as $row){
	            $pemasukanku += $row->jumlah;
	        }
	        $customMeta = [
	            'totalPemasukan' => number_format($pemasukanku, 2,',','.'),
	            'currency'  =>'IDR',

	        ];

	        return $customMeta;
	    });

	    return $setData;
	}

	public function store($request)
	{
		
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
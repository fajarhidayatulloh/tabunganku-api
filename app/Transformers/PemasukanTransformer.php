<?php
namespace App\Transformers;

use League\Fractal;

class PemasukanTransformer extends Fractal\TransformerAbstract {

	/**
	 * [author Fajar Hidayatulloh]
	 * [transform description]
	 * @param  [type] $product [description]
	 * @return [type]          [description]
	 */
	public function transform($product) {
		return [
			'id' => (int) $product->id,
			'title' => $product->name,
			'description' => $product->description,
			'jumlah' => number_format($product->nominal, 2, ',', '.'),
			'created_at' => $product->created_at,
		];
	}
}

?>
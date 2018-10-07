<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Qurban extends Model {

	protected $table = 'qurban';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $fillable = ['id', 'id_user', 'title', 'deskripsi', 'jumlah', 'created_at', 'updated_at'];
}

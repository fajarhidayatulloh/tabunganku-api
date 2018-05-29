<?php  

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    
    protected $table = 'users';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $fillable=['id','name','email','password','user_active','created_at','updated_at'];
}

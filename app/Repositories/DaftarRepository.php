<?php  
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\Contracts\DaftarRepository as Contracts;
use App\Model\Users;
use Mail;
use DB;

class DaftarRepository implements Contracts{
	
	public function setRegistration($request) 
	{
		$databaseSalt = $this->generate_token(env('SALT_LENGTH'));
        $title = 'Tabunganku';
        $content = 'Aktivasi Akun';
		
		$model = new Users;
		$model->name = $request->name;
		$model->email = $request->email;
		$model->password = $this->generate_hash_token($request->password, $databaseSalt, true);
		$model->user_active = 0;
		$model->user_salt = $databaseSalt;
		$model->created_at = \Carbon\Carbon::now();
		$model->save();

        view()->share('model', $model);
        Mail::send('emails.send_email', ['title' => $title, 'content' => $content], function ($message) use($model){
            $message->from('fajarhidayatulloh06@gmail.com', 'Tabunganku');
            $message->subject("Aktivasi Akun");
            $message->to($model->email);
            
        });   
        
	}

	// custom token generation from flexi_auth libraries on private-api
    public function generate_token($length = 8)
    {
        $characters = '23456789BbCcDdFfGgHhJjKkMmNnPpQqRrSsTtVvWwXxYyZz';
        $count = mb_strlen($characters);

        for ($i = 0, $token = ''; $i < $length; $i++)
        {
            $index = rand(0, $count - 1);
            $token .= mb_substr($characters, $index, 1);
        }
        return $token;
    }

    public function generate_hash_token($token, $database_salt = false, $is_password = false)
    {
        if (empty($token))
            return FALSE;

        // Get static salt if set via env file.
        $static_salt = env('STATIC_SALT');

        if ($is_password) {
            $phash = new \App\Libraries\PasswordHash;
            $phpass = $phash->PasswordHash(8, false);

            return $phash->HashPassword($database_salt . $token . $static_salt);
        }else{
            return sha1($database_salt . $token . $static_salt);
        }
    }	

    public function setActivationToken($user_salt)
    {
        $model = DB::table('users')
            ->select('user_salt','user_active')
            ->where('user_salt',$user_salt)
            ->first();

        if($model->user_active == 0 ){
            DB::table('users')
            ->where('user_salt',$user_salt)
            ->update(['user_active'=> 1]);
        }
        return $model;
    }
}

?>
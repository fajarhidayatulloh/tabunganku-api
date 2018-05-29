<?php 
namespace App\Libraries;
use Illuminate\Http\Request;
use League\OAuth2\Server\Exception\OAuthServerException;

class LoginMessage extends OAuthServerException{
    
    public static function Message_Error_1()
    {
        return new static('Username atau Password yang Anda Masukan Salah.', 6, 'invalid_credentials', 401);
    }

    public static function Message_Error_0()
    {
        return new static('Maaf, akun Anda masih belum aktif. Aktivasi terlebih dahulu untuk dapat login.', 6, 'invalid_credentials', 401);
    }
}
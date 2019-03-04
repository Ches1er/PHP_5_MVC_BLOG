<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.02.2019
 * Time: 15:16
 */

namespace app\Services;


use app\models\User;

class AdminService
{
    private static $ins = null;

    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {

    }
    public function findUser($login){
        if(is_null($login)) return null;
        return User::where("login",$login)->first();
    }
    public function changeUser($old_login,$new_login,$sign){
        $user = new User();
        if($old_login===$new_login)$user->changeSign($old_login,$sign);
        else{
            $user->changeSign($old_login,$sign);
            $user->changeLogin($old_login,$new_login);
        }
    }
}
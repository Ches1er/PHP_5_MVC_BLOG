<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.02.2019
 * Time: 13:53
 */

namespace app\Services;


use app\models\Token;
use app\models\User;
use app\models\Users_roles;
use core\auth\Auth;
use core\auth\Credential;
use core\auth\implementation\encoders\Md5PasswordEncoder;


class LoginRegistrService
{
    private static $ins = null;

    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;

    }
    private function __construct()
    {

    }
    public function loginProcess($login, $password){
        $login=empty($login)?null:$login;
        $password=empty($password)?null:$password;
        if($login===null||$password===null){
            Auth::instance()->errorMessagetoSession("Заполните все поля");
            return "";
        }
        if(!Auth::instance()->login(new Credential($login,$password))){
            Auth::instance()->errorMessagetoSession("Неверный логин или пароль");
            return "";
        }
        return "";
    }

    public function registerProcess($login,$password,$email)
    {
        $login=empty($login)?null:$login;
        $password=empty($password)?null:$password;
        $email = empty($email)?null:$email;
        if($login===null||$password===null||$email===null) {
            Auth::instance()->errorMessagetoSession("Заполните все поля");
            return "";
        }
        $encoded_pass = (new Md5PasswordEncoder)->encode($password);
        if((new User())->addUser($login,$encoded_pass,$email)){
            return "";
        }
        else{
            Auth::instance()->errorMessagetoSession("$login уже зарегистрирован");
            return "";
        }
    }
    public function activateuser($token){
        $user_id=(new Token())::where("token",$token)->one()["user_id"];
        (new Users_roles())->addUserRole($user_id);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.02.2019
 * Time: 17:33
 */
namespace app\Services;
use app\models\Category;
use app\models\Post;
use app\models\User;
use core\auth\Auth;
use core\auth\Credential;
use core\auth\implementation\encoders\Md5PasswordEncoder;

class MainService
{
    private static $ins = null;

    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {

    }
    public function activUser(){
        if(Auth::instance()->isAuth()){
            return Auth::instance()->getCredentials()->getLogin();
        }
        else return "non activ user";
    }
    public function activUserRole()
    {
        if (Auth::instance()->isAuth()) {
            return Auth::instance()->getCredentials()->getRoles();
        }
        return null;
    }

    public function getCategories(){
        $cat = Category::get();
        if (!empty($cat))return $cat;
        return [];
    }

    public function getPosts($category_url){
        if ($category_url===null) return Post::get();
        return Category::where("category_url",$category_url)->first()->posts();
    }

    public function getError(){
        if (isset($_SESSION["error"]))return $_SESSION["error"];
        return "";
    }

    public function loginProcess($login, $password){
        $login=empty($login)?null:$login;
        $password=empty($password)?null:$password;
        if($login===null||$password===null){
            Auth::instance()->errorMessagetoSession("some is empty");
            return "";
        }
        if(!Auth::instance()->login(new Credential($login,$password))){
            Auth::instance()->errorMessagetoSession("invalid login or pass");
            return "";
        }
        return "";
    }

    public function registerProcess($login,$password)
    {
        $login=empty($login)?null:$login;
        $password=empty($password)?null:$password;
        if($login===null||$password===null) {
            Auth::instance()->errorMessagetoSession("some is empty try again");
            return "";
        }
        $encoded_pass = (new Md5PasswordEncoder)->encode($password);
        (new User())->addUser($login,$encoded_pass);
        Auth::instance()->errorMessagetoSession("$login is registered");
        return "";
    }
}
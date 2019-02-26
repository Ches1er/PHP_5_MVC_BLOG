<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 11.02.2019
 * Time: 19:35
 */
namespace app\controllers;
use app\models\Film;
use app\models\Post;
use app\models\User;
use core\auth\Auth;
use core\auth\Credential;
use core\auth\implementation\encoders\Md5PasswordEncoder;
use core\base\Controller;
use core\base\TemplateView;
use core\base\View;
use core\db\DBQueryBuilder;
class Main extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("main","templates/def");
        if(Auth::instance()->isAuth()){
            $user_name = Auth::instance()->getCredentials()->getLogin();
            $user_roles = Auth::instance()->getCredentials()->getRoles();
            $view->user_roles = $user_roles;
        }
        else $user_name =  "non activ user";
        if (isset($_SESSION["error"]))$view->error = $_SESSION["error"];
        $view->user_name=$user_name;
        $view->posts=Post::get();
        Auth::instance()->delError();
        return $view;
    }
    public function action404(){
        echo "404";
    }

    public function actionLogout(){
        Auth::instance()->logout();
        return "redirect:/";
    }
    public function actionRegister(){
        $view = new TemplateView("register","templates/def");
        return $view;
    }
    public function actionLogin(){
        $view = new TemplateView("login","templates/def");
        return $view;
    }
    public function actionLoginhandle(){
        $login = empty($_POST["login"])?null:$_POST["login"];
        $password = empty($_POST["pass"])?null:$_POST["pass"];
        if($login===null||$password===null){
            Auth::instance()->errorMessagetoSession("some is empty");
            return "redirect:/";
        }
        if(!Auth::instance()->login(new Credential($login,$password))){
            Auth::instance()->errorMessagetoSession("invalid login or pass");
            return "redirect:/";
        }
        return "redirect:/";
    }
    public function actionRegisterhandle(){
        $login = empty($_POST["login"])?null:$_POST["login"];
        $password = empty($_POST["pass"])?null:$_POST["pass"];
        if($login===null||$password===null) return "redirect:/main/register";
        $encoded_pass = (new Md5PasswordEncoder)->encode($password);
        (new User())->addUser($login,$encoded_pass);
        return "redirect:/main/login";
    }
}
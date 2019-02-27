<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 11.02.2019
 * Time: 19:35
 */
namespace app\controllers;
use app\Services\MainService;
use app\models\Post;
use app\models\Comment;
use core\auth\Auth;
use core\base\Controller;
use core\base\TemplateView;
class Main extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("main","templates/def");
        $view->user_name=MainService::instance()->activUser();
        $view->user_roles = MainService::instance()->activUserRole();
        $view->posts=MainService::instance()->getPosts($this->getParam("caturl"));
        $view->menu_cat=MainService::instance()->getCategories();
        $view->error=MainService::instance()->getError();
        Auth::instance()->delError();
        return $view;
    }

    public function actionShowpost(){
        $post_id = $this->getParam("postid");
        $view = new TemplateView("post","templates/def");
        $view->post = Post::where("post_id",$post_id)->first();
        $view->post_id = $post_id;
        $view->comments = Comment::where("post_id",$post_id)->get();
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
        $view->error=MainService::instance()->getError();
        return $view;
    }
    public function actionLogin(){
        $view = new TemplateView("login","templates/def");
        $view->error=MainService::instance()->getError();
        return $view;
    }
    public function actionLoginhandle(){
        $login =$_POST["pass"];
        $password = $_POST["pass"];
        MainService::instance()->loginProcess($login,$password);
        return "redirect:/";
    }
    public function actionRegisterhandle(){
        $login = $_POST["login"];
        $password = $_POST["pass"];
        MainService::instance()->registerProcess($login,$password);
        return "redirect:/";
    }
}
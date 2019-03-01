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
        isset($_GET["page"])?$page=$_GET["page"]:$page=1;
        $view = new TemplateView("main","templates/def");
        $view->user=MainService::instance()->activUser();
        $view->user_roles = MainService::instance()->activUserRole();
        $view->number_of_posts =MainService::instance()->postsCount($this->getParam("caturl"));
        $view->posts_per_page = MainService::POSTS_PER_PAGE;
        $view->posts=MainService::instance()->getPosts($this->getParam("caturl"),$page);
        $view->menu_cat=MainService::instance()->getCategories();
        $view->error=MainService::instance()->getError();
        Auth::instance()->delError();
        return $view;
    }

    public function actionShowpost(){
        $post_id = $this->getParam("postid");
        $view = new TemplateView("post","templates/def");
        $view->user_roles = MainService::instance()->activUserRole();
        $view->post = Post::where("post_id",$post_id)->first();
        $view->post_id = $post_id;
        $view->comments = Comment::where("post_id",$post_id)->get();
        $view->user=MainService::instance()->activUser();
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
}
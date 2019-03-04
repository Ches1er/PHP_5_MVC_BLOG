<?php
/**
 * Created by PhpStorm.
 * Author: Ivan
 * Date: 26.02.2019
 * Time: 14:40
 */

namespace app\controllers;

use app\models\Category;
use app\models\Post;
use app\Services\MainService;
use core\base\Controller;
use core\base\TemplateView;

class Author extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("author","templates/def");
        $view->posts = Post::where("user_id",self::getUserId())->get();
        $view->categories = Category::get();
        $view->user=MainService::instance()->activUser();
        return $view;
    }
    public function actionAddpost(){
        $category_id = $_POST["category_name"];
        $data = date('l jS \of F Y h:i:s A',time());
        $post_name = $_POST["post_name"];
        $post_full = $_POST["post_full"];
        $post_desc = substr($post_full,0,100);
        (new Post())->addPost(self::getUserId(),$category_id,$data,$post_name,$post_desc,$post_full);
        return "redirect:\myposts";

    }
    public function actionDeletepost(){
        $post_id = self::getParam("postid");
        (new Post)->delete($post_id);
        return "redirect:\myposts";
    }

}
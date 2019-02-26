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
use app\models\User;
use core\base\Controller;
use core\base\TemplateView;
use core\auth\Auth;

class Author extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("author","templates/def");
        $view->posts = Post::where("user_id",self::getId())->get();
        $view->categories = Category::get();
        return $view;
    }
    public function actionAddpost(){
        $category_id = $_POST["category_name"];
        $data = date('l jS \of F Y h:i:s A',time());
        $post_name = $_POST["post_name"];
        $post_desc = $_POST["post_desc"];
        (new Post())->addPost(self::getId(),$category_id,$data,$post_name,$post_desc);
        return "redirect:\user";

    }
    public function actionProfile(){
        $view = new TemplateView("profile","templates/def");
        return $view;
    }
}
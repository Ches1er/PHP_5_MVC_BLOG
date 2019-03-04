<?php
/**
 * Created by PhpStorm.
 * Author: Ivan
 * Date: 26.02.2019
 * Time: 12:06
 */

namespace app\controllers;


use app\models\Category;
use app\Services\AdminService;
use app\Services\MainService;
use core\auth\Auth;
use core\base\Controller;
use core\base\TemplateView;

class Admin extends Controller
{
    public function actionIndex(){
        empty($_GET["login"])?$login=null:$login=$_GET["login"];
        $view = new TemplateView("admin","templates/def");
        $view->categories = Category::get();
        $view->user=MainService::instance()->activUser();
        $view->finduser=AdminService::instance()->findUser($login);
        return $view;
    }
    public function actionAddcategory(){
        $category_name = $_POST["category_name"];
        (new Category())->addCategory($category_name);
        return "redirect:/admin";
    }
    public function actionChangeuser(){
        if(empty($_POST["new_login"])){
            Auth::instance()->errorMessageToSession("Поле 'логин' не может быть пустым");
            return "redirect:/admin";
        }
        else{
            $new_login=$_POST["new_login"];
            $sign=$_POST["new_sign"];
            $old_login = $_POST["old_login"];
            AdminService::instance()->changeUser($old_login,$new_login,$sign);
            return "redirect:/admin";
        }
    }
}
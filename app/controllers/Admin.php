<?php
/**
 * Created by PhpStorm.
 * Author: Ivan
 * Date: 26.02.2019
 * Time: 12:06
 */

namespace app\controllers;


use app\models\Category;
use core\base\Controller;
use core\base\TemplateView;

class Admin extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("admin","templates/def");
        $view->categories = Category::get();
        return $view;
    }
    public function actionAddcategory(){
        $category_name = $_POST["category_name"];
        (new Category())->addCategory($category_name);
        return "redirect:/main/admin";
    }
}
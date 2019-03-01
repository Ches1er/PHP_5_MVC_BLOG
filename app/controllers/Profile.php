<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 16:58
 */

namespace app\controllers;


use app\models\Upic;
use app\Services\MainService;
use core\auth\Auth;
use core\base\Controller;
use app\Services\ProfileService;
use core\base\TemplateView;

class Profile extends Controller
{
    public function actionIndex(){
        $view = new TemplateView("profile","templates/def");
        $view->user = MainService::instance()->activUser();
        return $view;
    }
    public function actionAddpic()
    {
        $uploaddir = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        $login = Auth::instance()->getCredentials()->getLogin();
        ProfileService::addPicProcess($login,$uploadfile);
        return "redirect:/profile";
    }
    public function actionChangesign(){
        $sign = $_POST["sign"];
        $login = Auth::instance()->getCredentials()->getLogin();
        ProfileService::changesignProcess($login,$sign);
        return "redirect:/profile";
    }
}
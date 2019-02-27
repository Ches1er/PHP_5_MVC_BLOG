<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 16:58
 */

namespace app\controllers;


use app\models\Upic;
use core\auth\Auth;
use core\base\Controller;
use app\Services\ProfileService;

class Profile extends Controller
{
    public function actionAddpic()
    {
        $uploaddir = 'img/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        ProfileService::addPicProcess($uploadfile);
        return "redirect:/profile";
    }
    public function actionChangesign(){
        $sign = $_POST["sign"];
        $login = Auth::instance()->getCredentials()->getLogin();
        ProfileService::changesignProcess($login,$sign);
        return "redirect:/profile";
    }
}
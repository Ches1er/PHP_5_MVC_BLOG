<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28.02.2019
 * Time: 13:50
 */

namespace app\controllers;


use app\Services\LoginRegistrService;
use core\base\Controller;

class Login_registr extends Controller
{
    public function actionLoginhandle(){
        $login =$_POST["pass"];
        $password = $_POST["pass"];
        LoginRegistrService::instance()->loginProcess($login,$password);
        return "redirect:/";
    }
    public function actionRegisterhandle(){
        $login = $_POST["login"];
        $password = $_POST["pass"];
        $email = $_POST["email"];
        LoginRegistrService::instance()->registerProcess($login,$password,$email);
        return "redirect:/";
    }
}
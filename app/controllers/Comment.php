<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 15:05
 */

namespace app\controllers;


use core\auth\Auth;
use core\base\Controller;
use core\base\Model;

class Comment extends Controller
{
    public function actionNew(){
        $comment = $_POST["comment"];
        $user_id=self::getUserId();
        $post_id = $_POST["post_id"];
        (new \app\models\Comment())->addComment($user_id,$comment,$post_id);
        return "redirect:/";
    }
}
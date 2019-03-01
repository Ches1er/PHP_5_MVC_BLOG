<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 17:15
 */

namespace app\Services;
use app\models\Upic;
use app\models\User;
use core\auth\Auth;


class ProfileService
{
    public static function addPicProcess($login,$path){

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) {
            $pic_id=(new Upic())->addPic($path);
            (new User())->changeAvatar($login,$pic_id);
            return "";
        } else {
            Auth::instance()->errorMessageToSession("Picture wasnt loaded");
            return "";
        }
    }

    public static function changesignProcess($id, $sign)
    {
        (new User())->changeSign($id,$sign);
        return "";
    }
}
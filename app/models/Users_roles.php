<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.02.2019
 * Time: 16:53
 */

namespace app\models;


use core\base\Model;

class Users_roles extends Model
{
    public $user_id;
    public $role_id;

    protected static $table = "users_roles";

    public function addUserRole($user_id){
        $this->addData(["user_id"=>$user_id,"role_id"=>2]);
        return true;
    }
}
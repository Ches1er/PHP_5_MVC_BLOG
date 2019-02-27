<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 18.02.2019
 * Time: 20:16
 */
namespace app\models;
use core\base\Model;
class User extends Model
{
    protected static $table = "users";
    public $id;
    public $login;
    public $pass;
    public function posts(){
        return $this->hasMany(Post::class,"user_id")->get();
    }
    public function addUser($login,$password):void{
        $last_id=$this->addData(["login"=>$login,"password"=>$password]);
        (new Users_roles())->addData(["user_id"=>$last_id,"role_id"=>2]);
    }
    public function changeSign($login,$sign):void{
        $this->updateData(["sign"=>$sign],["login",$login]);
    }
    public function getUserIdByLogin($login){
        return ($this->getId("user_id","login",$login))["user_id"];
    }

}
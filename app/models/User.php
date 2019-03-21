<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 18.02.2019
 * Time: 20:16
 */
namespace app\models;
use core\base\Model;
use app\Services\FinalRegisterMailService;
class User extends Model
{
    protected static $table = "users";
    public $id;
    public $login;
    public $pass;
    public function posts(){
        return $this->hasMany(Post::class,"user_id")->get();
    }

    /*
     * Upic_id по умолчанию ставится 4!
     * Role_id по умолчанию 2, т.е. простой юзер.
     * */

    private function isLoginEngaged(string $login){
        return ((new User())::where("login",$login)->one());
    }

    public function addUser($login,$password,$email,$sign="Here is my sign",$upic_id=4){
        if($this->isLoginEngaged($login)) {
            return false;
        }
        $last_id=$this->addData(["login"=>$login,"password"=>$password,"sign"=>$sign,"upic_id"=>$upic_id,"email"=>$email]);
        $token = rand(0,1000);
        (new Token())->addData(["token"=>$token,"user_id"=>$last_id]);
        (new FinalRegisterMailService($email,$token))->sendMail();
        return true;
    }
    public function changeSign($login,$sign):void{
        $this->updateData(["sign"=>$sign],["login",$login]);
    }
    public function changeLogin($old_login,$new_login):void{
        $this->updateData(["login"=>$new_login],["login",$old_login]);
    }
    public function changeAvatar($login,$upic_id):void{
        $this->updateData(["upic_id"=>$upic_id],["login",$login]);
    }
    public function getUserIdByLogin($login){
        return ($this->getId("user_id","login",$login))["user_id"];
    }
    public function getPicture(){
        return $this->belongsTo(Upic::class,"upic_id","upic_id");
    }

}
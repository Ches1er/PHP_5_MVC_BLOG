<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 11.02.2019
 * Time: 19:34
 */

namespace core\base;


use core\router\Route;
use core\auth\Auth;
use app\models\User;

abstract class Controller
{
    private $route;
    public function execAction(string $action){
        $data = $this->$action();

        if($this->workInstruction($data)){
            return "";
        }

        return $data;
    }

    /**
     * @return Route
     */
    public function getRoute(): Route
    {
        return $this->route;
    }

    /**
     * @param Route $route
     */
    public function setRoute(Route $route)
    {
        $this->route = $route;
    }

    public function getParam(string $name,$def = null){
        return $this->getRoute()->getParam($name,$def);
    }

    const REDIRECT_INSTRUCTION = "redirect:";

    private function workInstruction($data)
    {
        if(!is_string($data)) return false;
        if(self::REDIRECT_INSTRUCTION === substr($data,0,strlen(self::REDIRECT_INSTRUCTION))){
            $url = substr($data,strlen(self::REDIRECT_INSTRUCTION));
            if($url === "back") $this->header(self::HEADER_LOCATION,$_SERVER["HTTP_REFERER"]);
            else $this->header(self::HEADER_LOCATION,$url);
            return true;
        }

    }


    const HEADER_LOCATION = "Location";
    const HEADER_CONTENT_TYPE = "Content-Type";

    public function header($name,$value){
        header("$name:$value");
    }

    public function redirect404(){
        $this->header(self::HEADER_LOCATION,"/404");
    }

    public static function getUserId(){
        $user_name = Auth::instance()->getCredentials()->getLogin();
        return ((new User)->getUserIdByLogin($user_name));
    }

}
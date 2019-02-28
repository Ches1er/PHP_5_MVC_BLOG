<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 20.02.2019
 * Time: 19:11
 */

namespace core\auth\implementation\authprovider;


use core\auth\contracts\AuthProvider;
use core\db\DBQueryBuilder;
use core\auth\Credential;

class InDBAuthProvider implements AuthProvider
{

    public function __construct()
    {
    }

    function getCredentials(string $login): ?Credential
    {
        $credential = DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)
            ->from("users")->where("login",$login)->one();
        if (!empty($credential)){
            $roles = array_map(function($f){
                return $f["role_name"];
            },$this->getRoles($credential["user_id"]));
            return new Credential($credential["login"],$credential["password"],$roles);
        }
        else return null;
    }

    private function getRoles($id):?array{
            return DBQueryBuilder::create(DBQueryBuilder::DEF_CONFIG_NAME)
                ->select(["roles.role_name"])->from("roles")->join("inner","users_roles",
                    ["role_id","role_id"],["users","user_id","users_roles","user_id"])
                ->where("users.user_id",$id)->all();
    }
}
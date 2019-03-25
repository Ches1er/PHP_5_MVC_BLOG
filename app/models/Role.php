<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 25.03.2019
 * Time: 17:09
 */

namespace app\models;


use core\base\Model;

class Role extends Model
{
    protected static $table = "roles";
    public $role_id;
    public $role_name;
}
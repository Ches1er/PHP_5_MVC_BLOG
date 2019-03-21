<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 20.03.2019
 * Time: 20:31
 */

namespace app\models;


use core\base\Model;

class Token extends Model
{
  protected static $table = "token";

  public $id;
  public $token;
  public $user_id;

}
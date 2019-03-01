<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 17:03
 */

namespace app\models;


use core\base\Model;

class Upic extends Model
{
    public $upic_id;
    public $path;

    protected static $table="upic";

    public function addPic($path){
        return $this->addData(["path"=>$path]);
    }
}
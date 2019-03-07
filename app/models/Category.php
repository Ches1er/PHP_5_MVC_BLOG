<?php
/**
 * Created by PhpStorm.
 * Author: Ivan
 * Date: 26.02.2019
 * Time: 12:14
 */

namespace app\models;


class Category extends \core\base\Model
{
    public $category_id;
    public $category_name;
    protected static $table = "categories";

    public function addCategory($cat_name){
        $this->addData(["category_name"=>$cat_name]);
    }
    public function posts($postPerPage,$offset){
        return $this->hasMany(Post::class,"category_id","category_id")
            ->orderBy("data","desc")->limit($postPerPage,$offset)->get();
    }
}
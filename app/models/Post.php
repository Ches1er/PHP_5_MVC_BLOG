<?php
/**
 * Created by PhpStorm.
 * Author: Ivan
 * Date: 26.02.2019
 * Time: 14:31
 */

namespace app\models;

use core\base\Model;

class Post extends Model
{
    public $post_id;
    public $user_id;
    public $category_id;
    public $data;
    public $post_name;
    public $post_desc;

    protected static $table="posts";

    public function addPost($user_id,$category_id,$data,$post_name,$post_desc){
        $this->addData(["user_id"=>$user_id,"category_id"=>$category_id,
            "data"=>$data,"post_name"=>$post_name,"post_desc"=>$post_desc]);
    }
    public function author(){
        return $this->belongsTo(User::class,"user_id","user_id");
    }
}
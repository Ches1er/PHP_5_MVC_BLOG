<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.02.2019
 * Time: 14:57
 */

namespace app\models;


class Comment extends \core\base\Model
{
    public $comment_id;
    public $user_id;
    public $comment_desc;
    public $post_id;

    protected static $table = "comments";

    public function author(){
        return $this->belongsTo(User::class,"user_id","user_id");
    }
    public function addComment($user_id,$comment_desc,$post_id){
        $this->addData(["user_id"=>$user_id,"comment_desc"=>$comment_desc,"post_id"=>$post_id]);
}
}
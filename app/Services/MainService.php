<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 26.02.2019
 * Time: 17:33
 */
namespace app\Services;
use app\models\Category;
use app\models\Post;
use app\models\User;
use core\auth\Auth;

class MainService
{
    private static $ins = null;
    const POSTS_PER_PAGE = 5;

    public static function instance()
    {
        return self::$ins === null ? self::$ins = new self() : self::$ins;
    }
    private function __construct()
    {

    }
    public function activUser(){
        if(Auth::instance()->isAuth()){
            $login=Auth::instance()->getCredentials()->getLogin();
            $user = User::where("login",$login)->first();
            return $user;
        }
        else return null;
    }
    public function activUserRole()
    {
        if (Auth::instance()->isAuth()) {
            return Auth::instance()->getCredentials()->getRoles();
        }
        return null;
    }

    public function getCategories(){
        $cat = Category::get();
        if (!empty($cat))return $cat;
        return [];
    }

    /*Считаем кол-во постов для пагинации: для главной, считаем все,
        если приезжает категория, то другим методом, для категорий
    */
    public function postsCount($category_url){
        if ($category_url===null||$category_url==="all")return (integer)(new Post())->hasAmountPostsAll();
        return (integer)(new Post())->hasAmountPostsCategory($category_url);
    }

    /*
     * Получаем посты. Кол-во постов на странице задаем в константу POSTS_PER_PAGE
     * Получаем страницу, основываясь на значении константы,
     * получаем список постов.
     */
    public function getPosts($category_url,$page){
        $page===1?$offset = 0:$offset=$page*self::POSTS_PER_PAGE-self::POSTS_PER_PAGE;
        $postPerPage = self::POSTS_PER_PAGE;
        if ($category_url===null||$category_url==="all") return Post::getWithOffset($postPerPage,$offset);
        return Category::where("category_url",$category_url)->first()->posts($postPerPage,$offset);
    }
    public function getPostsSort($category_url,$page,$sort_criteria){
        $page===1?$offset = 0:$offset=$page*self::POSTS_PER_PAGE-self::POSTS_PER_PAGE;
        $postPerPage = self::POSTS_PER_PAGE;
        if ($category_url===null) return Post::getWithOffsetSort($postPerPage,$offset,"data",$sort_criteria);
        return Category::where("category_url",$category_url)->first()->posts($postPerPage,$offset);
    }

    public function getError(){
        if (isset($_SESSION["error"]))return $_SESSION["error"];
        return null;
    }

}
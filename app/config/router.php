<?php

use core\router\Route;

return [
    'routes' => [
        new Route("", [
            "controller" => "main",
            "action" => "index",
        ]),
        new Route("showcat/{caturl}", [
            "controller" => "main",
            "action" => "index",
        ]),
        new Route("todo/{x}",[
            "controller"=>"api",
            "action"=>"todo",
        ]),
        new Route("admin",[
            "controller" => "admin",
            "action" => "index",
        ],[
            "secure"=>true,
            "role"=>"admin"
        ]),
        new Route("main/sort/{criteria}", [
            "controller" => "main",
            "action" => "index",
        ]),


        //LOGIN and REGISTER

        new Route("main/login",[
            "controller" => "main",
            "action" => "login",
        ]),
        new Route("main/loginhandle",[
            "controller" => "login_registr",
            "action" => "loginhandle",
        ]),
        new Route("main/logout",[
            "controller" => "main",
            "action" => "logout",
        ]),
        new Route("main/register",[
            "controller" => "main",
            "action" => "register",
        ]),
        new Route("main/registerhandle",[
            "controller" => "login_registr",
            "action" => "registerhandle",
        ]),
        new Route("activate/{token}",[
            "controller" => "login_registr",
            "action" => "activateuser",
        ]),

        //Admin action

        new Route("admin/addcategory",[
            "controller" => "admin",
            "action" => "addcategory",
        ],[
            "secure"=>true,
            "role"=>"admin"
        ]),
        new Route("admin/finduser",[
            "controller" => "admin",
            "action" => "finduser",
        ],[
            "secure"=>true,
            "role"=>"admin"
        ]),
        new Route("admin/changeuser",[
            "controller" => "admin",
            "action" => "changeuser",
        ],[
            "secure"=>true,
            "role"=>"admin"
        ]),

            //Author action

        //Posts

        new Route("myposts",[
            "controller" => "author",
            "action" => "index",
        ],[
            "secure"=>true,
            "role"=>"user"
        ]),

        new Route("myposts/addpost",[
            "controller" => "author",
            "action" => "addpost",
        ],[
            "secure"=>true,
            "role"=>"user"
        ]),
        new Route("myposts/delpost/{postid}",[
            "controller" => "author",
            "action" => "deletepost",
        ],[
            "secure"=>true,
            "role"=>"user"
        ]),


        //Profile

        new Route("profile",[
            "controller" => "profile",
            "action" => "index",
        ]),
        new Route("addpic",[
            "controller" => "profile",
            "action" => "addpic",
        ],[
            "secure"=>true,
            "role"=>"user"
        ]),
        new Route("changesign",[
            "controller" => "profile",
            "action" => "changesign",
        ],[
            "secure"=>true,
            "role"=>"user"
        ]),


        //Show posts

        new Route("post/{postid}",[
            "controller" => "main",
            "action" => "showpost",
        ]),

        //Comments
        new Route("comment/new",[
            "controller" => "comment",
            "action" => "new",
        ]),
        new Route("post/commentdel/{commentid}",[
            "controller" => "comment",
            "action" => "delete",
        ]),

    ]
];
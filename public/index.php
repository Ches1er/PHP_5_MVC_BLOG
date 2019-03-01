<?php

use core\Application;

define("ROOT_DIR",__DIR__."/../");
define("CORE_DIR",ROOT_DIR."core/");
define("APP_DIR",ROOT_DIR."app/");
define("DOC_ROOT",$_SERVER["DOCUMENT_ROOT"]."/");
define("PUBLIC_DIR",DOC_ROOT."public/");

define("EXT",".php");

function handle_error($errno, $errstr, $errfile, $errline){
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("handle_error");

spl_autoload_register(function ($classname){
    $path = ROOT_DIR.str_replace("\\","/",$classname).EXT;
    if(file_exists($path)){
        include $path;
    }
});


Application::run();
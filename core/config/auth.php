<?php
/**
 * Created by PhpStorm.
 * Author: mamedov
 * Date: 20.02.2019
 * Time: 19:08
 */

use core\auth\implementation\authprovider\InMemoryAuthProvider;
use core\auth\implementation\authprovider\InDBAuthProvider;
use core\auth\implementation\encoders\Md5PasswordEncoder;
use core\auth\implementation\session\DefaultPhpSession;

return [
    "passwordEncoder"=>new Md5PasswordEncoder(),
    "session"=>DefaultPhpSession::instance(),
    "authProvider"=>new InDBAuthProvider()
];
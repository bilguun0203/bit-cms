<?php
include_once __DIR__.'/../core/connection.php';

if(isset($_GET['name']) && isset($_GET['password'])){
    $name = $_GET['name'];
    $password = $_GET['password'];
    $remember = 0;
    if(isset($_GET['remember'])){
        $remember = 1;
    }
    if($func->userLogin($name,$password,$remember)==1){
        $func->redirect($config['url']."?p=index");
    }
    else if($func->userLogin($name,$password,$remember)==2){
        $func->redirect($config['url']."bit-bend/?p=login&error=2");
    }
    else {
        $func->redirect($config['url']."bit-bend/?p=login&error=1");
    }
}
$func->redirect($config['url']."bit-bend/?p=login&error=1");
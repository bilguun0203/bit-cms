<?php
include_once __DIR__.'/../core/connection.php';
if($func->logout()){
    $func->redirect($config['url']."bit-bend/?p=login");
}
$func->redirect($config['url']."bit-bend/?p=login");
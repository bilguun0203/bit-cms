<?php

include_once __DIR__.'/../core/connection.php';

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    if($msg == 0){
        $func->redirect($func->config['url']."bit-bend/?p=posts&del=0");
    }
    else {
        $func->redirect($func->config['url']."bit-bend/?p=posts&del=1");
    }
}


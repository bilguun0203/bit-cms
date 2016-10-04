<?php

include_once __DIR__.'/core/connection.php';

if($db_connection == 1){
    if(isset($_GET['p'])){

    }
    else {
//        loadView("frontend/index");
        include_once __DIR__ . "/views/frontend/index.php";
    }
}
else {
    redirect("install");
}
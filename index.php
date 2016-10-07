<?php


include_once __DIR__.'/core/connection.php';
if($db_connection == 1){
    $data = array();
    if(isset($_GET['p'])){
        $page = $_GET['p'];
        if($func->checkView("frontend/template/bw/".$page)){
            $data['title'] = "BitCMS - " . $page;
            $func->loadView("frontend/template/bw/".$page,$data);
        }
        else {
            $data['title'] = "BitCMS - ERROR 404";
            $func->loadView("frontend/template/bw/404",$data);
        }
    }
    else {
        $data['title'] = "BitCMS";
        $func->loadView("frontend/template/bw/index",$data);
    }
}
else {
    echo "<br/><hr><br>Database connection failed. Please check your <code>config.php</code> file<br/>OR<br/>If you don't installed cms, please click Install.<br/>";
    echo "<a href='install'>INSTALL</a>";
}
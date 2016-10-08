<?php

include_once __DIR__.'/../core/connection.php';
if($db_connection == 1 && $dbc->checkAllTable($config['db_name'],$config['db_table_prefix'])){
    $data = array();
    if($dbc->select($config['db_table_prefix']."options", "value", "name = 'frontend_template'")){
        $template = $dbc->select($config['db_table_prefix']."options", "value", "name = 'frontend_template'");
    }
    else {
        $template['value'] = "bw";
    }
    if(isset($_GET['p'])){
        $page = $_GET['p'];
        if($func->checkView("backend/template/standard/".$page)){
            $data['title'] = "BitCMS Backend - " . $page;
            $data['page'] = $page;
            $func->loadView("backend/template/standard/".$page,$data);
        }
        else {
            $data['title'] = "BitCMS Backend - ERROR 404";
            $data['page'] = "404";
            $func->loadView("backend/template/standard/404",$data);
        }
    }
    else {
        $data['title'] = "BitCMS Backend";
        $data['page'] = "index";
        $func->loadView("backend/template/standard/index",$data);
    }
}
else {
    echo "<br/><hr><br>Database connection failed. Please check your <code>config.php</code> file<br/>OR<br/>If you don't installed cms, please click Install.<br/>";
    echo "<a href='install'>INSTALL</a>";
}
<?php


include_once __DIR__.'/core/connection.php';
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
        if($func->checkView("frontend/template/".$template['value']."/".$page)){
            $data['title'] = "BitCMS - " . $page;
            $func->loadView("frontend/template/".$template['value']."/".$page,$data);
        }
        else {
            $data['title'] = "BitCMS - ERROR 404";
            $func->loadView("frontend/template/".$template['value']."/404",$data);
        }
    }
    else {
        $data['title'] = "BitCMS";
        $func->loadView("frontend/template/".$template['value']."/index",$data);
    }
}
else {
    echo "<br/><hr><br>Database connection failed. Please check your <code>config.php</code> file<br/>OR<br/>If you don't installed cms, please click Install.<br/>";
    echo "<a href='install'>INSTALL</a>";
}
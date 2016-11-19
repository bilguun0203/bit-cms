<?php

include_once __DIR__.'/../core/connection.php';
if($db_connection == 1 && $dbc->checkAllTable($config['db_name'],$config['db_table_prefix'])){
    $data = array();
    if(isset($_GET['p'])){
        $page = $_GET['p'];
        if($func->checkView("backend/template/standard/".$page)){
            if($func->is_loggedin()) {
                $data['user'] = $func->getUserData();
                $data['title'] = "BitCMS Backend - " . $page;
                $data['page'] = $page;

                // PAGE: POSTS
                if($page == "posts"){
                    $result = $dbc->select($config['db_table_prefix']."posts","*");
                    if($result!=0){
                        if(is_array($result[0]))
                            $data['posts'] = $result;
                        else $data['posts'][0] = $result;
                    }
                    else {
                        $data['posts'] = 0;
                    }
                }

                // PAGE: EDIT
                if($page == "edit_post"){
                    if(isset($_GET['method'])){ // TODO : EDIT hiih bolomjtoi esehiig shalgah
                        if($_GET['method'] == "edit" && isset($_GET['id'])){
                            $result = $dbc->select($config['db_table_prefix']."posts","*","id = " . $_GET['id'],"","LIMIT 1");
                            if($result!=0){
                                $data['method'] = "edit";
                                $data['post'] = $result;
                            }
                            else {
                                $data['method'] = "add";
                            }
                        }
                        else $data['method'] = "add";
                    }
                    else {
                        $data['method'] = "add";
                    }
                }

                $func->loadView("backend/template/standard/" . $page, $data);
            }
            elseif ($page!="login") {
                $func->redirect($config['url']."bit-bend/?p=login");
            }
            if($page=="login"){
                $func->loadView("backend/template/standard/login", $data);
            }
        }
        else {
            $data['title'] = "BitCMS Backend - ERROR 404";
            $data['page'] = "404";
            $func->loadView("backend/template/standard/404",$data);
        }
    }
    else {
        if($func->is_loggedin()) {
            $data['title'] = "BitCMS Backend";
            $data['page'] = "index";
            $func->loadView("backend/template/standard/index", $data);
        }
        else {
            $func->redirect($config['url']."bit-bend/?p=login");
        }
    }
}
else {
    echo "<br/><hr><br>Database connection failed. Please check your <code>config.php</code> file<br/>OR<br/>If you don't installed cms, please click Install.<br/>";
    echo "<a href='../install'>INSTALL</a>";
}
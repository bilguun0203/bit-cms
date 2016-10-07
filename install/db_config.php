<?php

$method = $_GET['method'];
if($method=="db") {
    $host = $_GET['db_host'];
    $name = $_GET['db_name'];
    $user = $_GET['db_user'];
    if (isset($_GET['db_password']) || $_GET['db_password'] == "") {
        $password = $_GET['db_password'];
    } else {
        $password = "";
    }
    if (isset($_GET['db_prefix']) || $_GET['db_prefix'] == "") {
        $prefix = $_GET['db_prefix'];
    } else {
        $prefix = "";
    }

    try {
        $conn = new PDO("mysql:host=$host;dbname=$name", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db_connection = 1;
        echo "Database connection OK<br/>";
    } catch (PDOException $e) {
        header("Location: index.php?error=1");
        $db_connection = 0;
    }

    if ($db_connection == 1) {
        $confile = fopen(__DIR__ . "/../config.php", "w") or die("Unable to open file!");
        $txt = '
    <?php
    /*--------------------------------------------------------
    
    Bit CMS Configuration File
    
    --------------------------------------------------------*/
    
    $config = array();
    
    ini_set("display_errors", true);
    
    // Database configuration
    $config[\'db_host\'] = "' . $host . '";
    $config[\'db_user\'] = "' . $user . '";
    $config[\'db_password\'] = "' . $password . '";
    $config[\'db_name\'] = "' . $name . '";
    $config[\'db_table_prefix\'] = "' . $prefix . '";
    
    $config[\'url\'] = "http://' . $_SERVER['HTTP_HOST'] . '";';
        fwrite($confile, $txt);
        fclose($confile);

        include_once __DIR__ . "/../core/connection.php";

        $columns1 = array(
            'id' => "int(6) NOT NULL AUTO_INCREMENT",
            'title' => "varchar(128) NOT NULL",
            'link' => "varchar(128) NOT NULL",
            'image' => "varchar(128) DEFAULT NULL",
            'body' => "mediumtext NOT NULL",
            'category' => "varchar(128) NOT NULL DEFAULT 'uncategorized'",
            'tags' => "varchar(256) DEFAULT NULL",
            'created' => "datetime NOT NULL",
            'modified' => "datetime NOT NULL",
            'pubdate' => "datetime NOT NULL",
            'author' => "varchar(64) NOT NULL",
            'parent' => "int(6) NOT NULL DEFAULT '0'",
            'visibility' => "int(1) NOT NULL DEFAULT '0'",
            'comments_allowed' => "int(1) NOT NULL DEFAULT '1'",
            'comments_count' => "int(6) NOT NULL DEFAULT '0'"
        );

        $columns2 = array(
            'id' => "int(6) NOT NULL AUTO_INCREMENT",
            'title' => "varchar(128) NOT NULL",
            'link' => "varchar(128) NOT NULL",
            'image' => "varchar(128) DEFAULT NULL",
            'body' => "mediumtext NOT NULL",
            'type' => "varchar(32) NOT NULL DEFAULT 'normal'",
            'category' => "varchar(128) NOT NULL DEFAULT 'uncategorized'",
            'tags' => "varchar(256) DEFAULT NULL",
            'created' => "datetime NOT NULL",
            'modified' => "datetime NOT NULL",
            'pubdate' => "datetime NOT NULL",
            'author' => "varchar(64) NOT NULL",
            'parent' => "int(6) NOT NULL DEFAULT '0'",
            'visibility' => "int(1) NOT NULL DEFAULT '0'",
            'comments_allowed' => "int(1) NOT NULL DEFAULT '1'",
            'comments_count' => "int(6) NOT NULL DEFAULT '0'"
        );

        $columns3 = array(
            'uuid' => "varchar(32) NOT NULL",
            'first_name' => "varchar(64) DEFAULT NULL",
            'last_name' => "varchar(64) DEFAULT NULL",
            'username' => "varchar(64) NOT NULL",
            'email' => "varchar(128) NOT NULL",
            'password' => "varchar(255) NOT NULL",
            'role' => "varchar(32) DEFAULT 'subscriber'",
            'status' => "int(2) DEFAULT '1'",
            'display_name' => "varchar(150) NOT NULL",
            'avatar' => "varchar(128) NULL",
        );
        if(
            $dbc->createTable($prefix."posts", $columns1, "id")==1 &&
            $dbc->createTable($prefix."pages", $columns2, "id")==1 &&
            $dbc->createTable($prefix."users", $columns3, "uuid")==1
        ){
            header("Location: index.php?step=2");
        }
        else {
            header("Location: index.php?step=1&error=2&msg1=".$dbc->createTable($prefix."posts", $columns1, "id")."&msg2=".$dbc->createTable($prefix."pages", $columns2, "id")."&msg3=".$dbc->createTable($prefix."users", $columns3, "uuid"));
        }
    }
}

elseif ($method=="user"){
    if(isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['confirm_password']) && $_GET['password'] == $_GET['confirm_password']){
        include_once __DIR__ . "/../core/connection.php";
        $username = $_GET['username'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        if($func->createUser($username,$email,$password,"admin")==1)
            header("Location: index.php?step=3");
        else
            header("Location: index.php?step=2&error=1&msg=".$func->createUser($username,$email,$password,"admin"));
    }
    else {
        header("Location: index.php?step=2&error=1");
    }
}
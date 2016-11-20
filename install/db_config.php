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
        $conn->exec('SET time_zone = "+08:00";');
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
date_default_timezone_set("Asia/Ulaanbaatar");
ini_set("display_errors", true);

// Database configuration
$config[\'db_host\'] = "' . $host . '";
$config[\'db_user\'] = "' . $user . '";
$config[\'db_password\'] = "' . $password . '";
$config[\'db_name\'] = "' . $name . '";
$config[\'db_table_prefix\'] = "' . $prefix . '";

$config[\'url\'] = "http://' . $_SERVER['HTTP_HOST'] . '/";
$config[\'file_path_fend\'] = "../views/frontend/template/";
$config[\'file_path_bend\'] = "../views/backend/template/";
';
        fwrite($confile, $txt);
        fclose($confile);

        include_once __DIR__ . "/../core/connection.php";

        $posts = array(
            'id' => "int(6) NOT NULL AUTO_INCREMENT",
            'title' => "varchar(128) NOT NULL",
            'link' => "varchar(128) NOT NULL",
            'image' => "varchar(128) DEFAULT NULL",
            'body' => "mediumtext NOT NULL",
            'category' => "varchar(128) NOT NULL DEFAULT 'uncategorized'",
            'tags' => "varchar(256) DEFAULT NULL",
            'created' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'modified' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
            'pubdate' => "datetime NOT NULL",
            'author' => "varchar(64) NOT NULL",
            'parent' => "int(6) NOT NULL DEFAULT '0'",
            'visibility' => "int(1) NOT NULL DEFAULT '0'",
            'comments_allowed' => "int(1) NOT NULL DEFAULT '1'",
            'comments_count' => "int(6) NOT NULL DEFAULT '0'"
        );

        $pages = array(
            'id' => "int(6) NOT NULL AUTO_INCREMENT",
            'title' => "varchar(128) NOT NULL",
            'link' => "varchar(128) NOT NULL",
            'image' => "varchar(128) DEFAULT NULL",
            'body' => "mediumtext NOT NULL",
            'type' => "varchar(32) NOT NULL DEFAULT 'normal'",
            'category' => "varchar(128) NOT NULL DEFAULT 'uncategorized'",
            'tags' => "varchar(256) DEFAULT NULL",
            'created' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'modified' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
            'pubdate' => "datetime NOT NULL",
            'author' => "varchar(64) NOT NULL",
            'parent' => "int(6) NOT NULL DEFAULT '0'",
            'visibility' => "int(1) NOT NULL DEFAULT '0'",
            'comments_allowed' => "int(1) NOT NULL DEFAULT '1'",
            'comments_count' => "int(6) NOT NULL DEFAULT '0'"
        );

        $users = array(
            'uuid' => "varchar(32) NOT NULL",
            'first_name' => "varchar(64) DEFAULT NULL",
            'last_name' => "varchar(64) DEFAULT NULL",
            'username' => "varchar(64) NOT NULL",
            'email' => "varchar(128) NOT NULL",
            'password' => "varchar(255) NOT NULL",
            'role' => "varchar(32) DEFAULT 'subscriber'",
            'status' => "int(2) DEFAULT '1'",
            'display_name' => "varchar(150) NOT NULL",
            'avatar' => "varchar(128) DEFAULT NULL",
            'about' => "TEXT DEFAULT NULL",
        );
        $options = array(
            'id' => "int(8) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(64) NOT NULL",
            'value' => "varchar(64) DEFAULT NULL"
        );
        $values1 = array(
            'name' => "frontend_template",
            'value' => "bw"
        );
        $values2 = array(
            'name' => "post_per_page",
            'value' => "10"
        );
        $values3 = array(
            'name' => "site_name",
            'value' => "BitCMS"
        );
        $values4 = array(
            'name' => "site_tagline",
            'value' => "Bit sized CMS"
        );
        $menu = array(
            'id' => "int(8) NOT NULL AUTO_INCREMENT",
            'order' => "int(4) NOT NULL",
            'name' => "varchar(64) NOT NULL",
            'value' => "varchar(255) NOT NULL"

        );
        $comments = array(
            'id' => "int(8) NOT NULL AUTO_INCREMENT",
            'name' => "varchar(64) NOT NULL",
            'email' => "varchar(128) NOT NULL",
            'comment' => "text NOT NULL",
            'location' => "int(8) NOT NULL",
            'locationT' => "varchar(32) NOT NULL",
            'parent' => "int(8) DEFAULT 0",
            'ip' => "varchar(16) NOT NULL",
            'useragent' => "varchar(256) NOT NULL",
            'date' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'password' => "varchar(64) NOT NULL",
            'visibility' => "int(4) DEFAULT 2",
        );
        $files = array(
            'id' => "varchar(16) NOT NULL",
            'name' => "varchar(64) NOT NULL",
            'ext' => "varchar(32) NOT NULL",
            'size' => "varchar(32) NOT NULL",
            'download_count' => "int(8) NOT NULL",
            'author' => "varchar(32) DEFAULT 0",
            'created' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP",
            'modified' => "datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
            'pubdate' => "datetime NOT NULL",
            'location' => "varchar(255) NOT NULL",
            'visibility' => "int(4) NOT NULL"
        );
        if($dbc->checkTable($name,$prefix."posts")==1)
            $dbc->dropTable($prefix."posts");
        if($dbc->checkTable($name,$prefix."pages")==1)
            $dbc->dropTable($prefix."pages");
        if($dbc->checkTable($name,$prefix."users")==1)
            $dbc->dropTable($prefix."users");
        if($dbc->checkTable($name,$prefix."options")==1)
            $dbc->dropTable($prefix."options");
        if($dbc->checkTable($name,$prefix."menu")==1)
            $dbc->dropTable($prefix."menu");
        if($dbc->checkTable($name,$prefix."comments")==1)
            $dbc->dropTable($prefix."comments");
        if($dbc->checkTable($name,$prefix."files")==1)
            $dbc->dropTable($prefix."files");
        $msg[0] = $dbc->createTable($prefix."posts", $posts, "id");
        $msg[1] = $dbc->createTable($prefix."pages", $pages, "id");
        $msg[2] = $dbc->createTable($prefix."users", $users, "uuid");
        $msg[3] = $dbc->createTable($prefix."options", $options, "id");
        $msg[4] = $dbc->createTable($prefix."menu", $menu, "id");
        $msg[5] = $dbc->createTable($prefix."comments", $comments, "id");
        $msg[6] = $dbc->createTable($prefix."files", $files, "id");
        $msg[7] = $dbc->insert($prefix."options", $values1);
        $msg[8] = $dbc->insert($prefix."options", $values2);
        $msg[9] = $dbc->insert($prefix."options", $values3);
        $msg[10] = $dbc->insert($prefix."options", $values4);
        if($msg[0] == 1 && $msg[1] == 1 && $msg[2] == 1 && $msg[3] == 1 && $msg[4] == 1 && $msg[5] == 1 && $msg[6] == 1 && $msg[7] == 1 && $msg[8] == 1 && $msg[9] == 1 && $msg[10] == 1){
            header("Location: index.php?step=2");
        }
        else {
            header("Location: index.php?step=1&error=2&msg1=".$msg[0]."&msg2=".$msg[1]."&msg3=".$msg[2]."&msg4=".$msg[3]."&msg5=".$msg[4]."&msg6=".$msg[5]."&msg7=".$msg[6]."&msg8=".$msg[7]."&msg9=".$msg[8]."&msg10=".$msg[9]."&msg11=".$msg[10]);
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
        header("Location: index.php?step=2&error=1&msg=Оруулсан өгөгдлөө шалгана уу.");
    }
}
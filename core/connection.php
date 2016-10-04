<?php
/*--------------------------------------------------------

Database Connection and Function

--------------------------------------------------------*/
$db_connection = 0;
include_once 'func_db.php';
include_once 'func_main.php';
if(file_exists(__DIR__ . "/../config.php")){
    include_once __DIR__ . "/../config.php";

//    $conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
//    if (!$conn) {
//        die("ERROR >> Connection failed: " . mysqli_connect_error());
//        $db_connection = 0;
//    }
//    else {
//        echo "MSG >> Connected successfully";
//        $db_connection = 1;
//        $dbc = new func_db($conn);
//    }
    try {
        $conn = new PDO("mysql:host=".$config['db_host'].";dbname=".$config['db_name'], $config['db_user'], $config['db_password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "MSG >> Connected successfully";
        $db_connection = 1;
        $dbc = new func_db($conn);
    }
    catch(PDOException $e)
    {
        echo "ERROR >> Connection failed: " . $e->getMessage();
        $db_connection = 0;
    }
}
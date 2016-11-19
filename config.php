
<?php
/*--------------------------------------------------------

Bit CMS Configuration File

--------------------------------------------------------*/

$config = array();
date_default_timezone_set("Asia/Ulaanbaatar");
ini_set("display_errors", true);

// Database configuration
$config['db_host'] = "localhost";
$config['db_user'] = "root";
$config['db_password'] = "toor";
$config['db_name'] = "bitcms";
$config['db_table_prefix'] = "bit_";

$config['url'] = "http://bit.cms/";
$config['file_path_fend'] = "../views/frontend/template/";
$config['file_path_bend'] = "../views/backend/template/";

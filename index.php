<?php

include_once __DIR__.'/core/connection.php';

if($db_connection == 1){
    echo "Success";
}
else {
    redirect("install");
}
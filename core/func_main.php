<?php

// Main Functions

function redirect($url){
    header("Location: " . __DIR__ . "/" . $url);
}

//function loadView($view){
//    include_once __DIR__ . "/../views/" . $view . ".php";
//}
<?php

// Main Functions

function redirect($url){
    header("Location: " . __DIR__ . "/" . $url);
}
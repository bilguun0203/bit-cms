<?php

// Main Functions
class MainFunctions {

    private $db;
    private $config = array();

    public function __construct($config="",$dbc)
    {
        $this->config = $config;
        $this->db = $dbc;
    }

    public function redirect($url){
        header("Location: " . __DIR__ . "/" . $url);
    }

    public function checkView($view){
        if(file_exists(__DIR__ . "/../views/" . $view . ".php")) {
            return 1;
        }
        else {
            return 0;
        }
    }
    public function loadView($view,$data){
        if($this->checkView($view)) {
            include_once __DIR__ . "/../views/" . $view . ".php";
            return 1;
        }
        else {
            return 0;
        }
    }
}
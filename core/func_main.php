<?php

// Main Functions
class MainFunctions {

    private $db;
    private $config = array();

    public function __construct($config="",$dbc="")
    {
        $this->config = $config;
        $this->db = $dbc;
    }

    public function randomString($length, $cstr=""){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = "";
        if($cstr!=""){
            $length = $length - strlen($cstr);
        }
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString .= $cstr;
        return $randomString;
    }

    public function redirect($url){
        header("Location: " . $url);
    }

    public function checkView($view){
        if(file_exists(__DIR__ . "/../views/" . $view . ".php")) {
            return true;
        }
        else {
            return false;
        }
    }
    public function loadView($view,$data){
        if($this->checkView($view)) {
            include_once __DIR__ . "/../views/" . $view . ".php";
            return true;
        }
        else {
            return false;
        }
    }

    // Data functions

    public function createPost($title){}

    public function createUser($username, $email, $password, $role="subscriber", $status=1, $fname=NULL, $lname=NULL, $display_name=NULL, $avatar=NULL){
        $password = password_hash($password, PASSWORD_DEFAULT);
        if ($display_name == "username"){
            $display_name = $username;
        }
        elseif ($display_name == "lname"){
            $display_name = $lname;
        }
        elseif ($display_name == "fname"){
            $display_name = $fname;
        }
        elseif ($display_name == "fullname"){
            $display_name = $fname . " " . $lname;
        }
        elseif ($display_name == "fullname2"){
            $display_name = $lname . " " . $fname;
        }
        elseif ($display_name == "lfname"){
            $display_name = $lname[0] . "." . $fname;
        }
        else {
            $display_name = $username;
        }
        $columns = array(
            'uuid' => $this->randomString(32,date('His')),
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'status' => $status,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $display_name,
            'avatar' => $avatar
        );
        if($this->db->insert($this->config['db_table_prefix']."users",$columns)==1){
            return 1;
        }
        else {
            return $this->db->insert($this->config['db_table_prefix']."users",$columns);
        }
    }

    public function is_loggedin(){
        if(isset($_SESSION['uuid'])){
            $uuid = $_SESSION['uuid'];
            $result = $this->db->select($this->config['db_table_prefix']."users","*","uuid = '".$uuid."'","","LIMIT 1");
            if($result != 0){
                return true;
            }
            else return false;
        }
        else return false;
    }
    public function logout(){
        if($this->is_loggedin()){
            session_destroy();
            unset($_SESSION['uuid']);
            return true;
        }
        return false;
    }
    public function userLogin($name,$password,$remember){
        $result = $this->db->select($this->config['db_table_prefix'] . "users", "*", "email = '$name' OR username = '$name'", "", "LIMIT 1");
        if (isset($result['uuid'])) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['uuid'] = $result['uuid'];
                if($remember==1){
                    $cookie_name = "bit_username";
                    $cookie_value = $name;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                }
                return 1;
            } else return 0;
        }
        else return 0;
    }
    public function getUserData(){
        if($this->is_loggedin()){
            $result = $this->db->select($this->config['db_table_prefix']."users","*","uuid = '".$_SESSION['uuid']."'","","LIMIT 1");
            if($result != 0){
                return $result;
            }
            else return false;
        }
        else return false;
    }
}
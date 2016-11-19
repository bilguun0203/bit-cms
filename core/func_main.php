<?php

// Main Functions
class MainFunctions {

    private $db;
    public $config = array();

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
    // TODO: createPost updatePost deletePost createComment updateComment deleteComment shalgah
    public function createPost($title,$link="",$body,$category="uncategorized",$tags="",$parent=0,$image="media/default.png",$visibility=1,$comment=1,$pubdate){
        $author = $this->getUserData();
        $dateC = date("Y-m-d H:i:s");
        $dateM = date("Y-m-d H:i:s");
        $values = array(
            'title' => $title,
            'link' => $link,
            'image' => $image,
            'body' => $body,
            'category' => $category,
            'tags' => $tags,
            'pubdate' => $pubdate,
            'author' => $author['uuid'],
            'parent' => $parent,
            'visibility' => $visibility,
            'comments_allowed' => $comment,
            'created' => $dateC,
            'modified' => $dateM
        );
        if($this->db->insert($this->config['db_table_prefix']."posts",$values)){
            return true;
        }
        else return false;
    }
    public function updatePost($id,$title,$link="",$body,$category="uncategorized",$tags="",$parent=0,$image="media/default.png",$visibility=1,$comment=1,$pubdate){
        $date = date("Y-m-d H:i:s");
        $values = array(
            'title' => $title,
            'link' => $link,
            'image' => $image,
            'body' => $body,
            'category' => $category,
            'tags' => $tags,
            'pubdate' => $pubdate,
            'parent' => $parent,
            'visibility' => $visibility,
            'comments_allowed' => $comment,
            'modified' => $date
        );
        if($this->db->update($this->config['db_table_prefix']."posts",$values,"id = '".$id."'")){
            return true;
        }
        else return false;
    }
    public function togglePostVisibility($id, $_value){
        $value = array(
            'visibility' => $_value
        );
        if($this->db->update($this->config['db_table_prefix']."posts",$value,"id = '".$id."'")){
            return true;
        }
        else return false;
    }
    public function togglePostComment($id, $_value){
        $value = array(
            'comments_allowed' => $_value
        );
        if($this->db->update($this->config['db_table_prefix']."posts",$value,"id = '".$id."'")){
            return true;
        }
        else return false;
    }
    public function deletePost($id){
        if($this->db->select($this->config['db_table_prefix']."posts","*","id = '".$id."'") != 0) {
            $comments = $this->db->select($this->config['db_table_prefix'] . "comments", "*", "location = '" . $id . "'");
            if ($comments != 0) {
                foreach ($comments as $comment) {
                    $this->deleteComment($comment['id']);
                }
            }
            if ($this->db->delete($this->config['db_table_prefix'] . "posts", "id = '" . $id . "'") == 1) {
                return true;
            } else return false;
        }
        else return false;
    }

    public function createComment($name,$email,$comment,$location,$parent,$ip,$useragent,$password,$visibility=2){
        $date = date("Y-m-d H:i:s");
        $values = array(
            'name' => $name,
            'email' => $email,
            'comment' => $comment,
            'location' => $location,
            'parent' => $parent,
            'ip' => $ip,
            'useragent' => $useragent,
            'date' => $date,
            'password' => $password,
            'visibility' => $visibility
        );
        if($this->db->insert($this->config['db_table_prefix']."comments",$values)){
            return true;
        }
        else return false;
    }
    public function updateComment($id,$name,$email,$comment,$password,$visibility){
        $values = array(
            'name' => $name,
            'email' => $email,
            'comment' => $comment,
            'password' => $password,
            'visibility' => $visibility
        );
        if($this->db->update($this->config['db_table_prefix']."comments",$values,"id = '".$id."'")){
            return true;
        }
        else return false;
    }
    public function deleteComment($id){
        $comments = $this->db->select($this->config['db_table_prefix']."comments","*","parent = '".$id."'");
        if($comments!=0) {
            foreach ($comments as $comment) {
                $this->deleteComment($comment['id']);
            }
        }
        if ($this->db->delete($this->config['db_table_prefix'] . "posts", "id = '" . $id . "'") == 1) {
            return true;
        } else return false;
    }

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
    public function getUserData($id = ""){
        if($id != ""){
            $result = $this->db->select($this->config['db_table_prefix']."users","*","uuid = '".$id."'","","LIMIT 1");
            if($result != 0){
                return $result;
            }
            else return false;
        }
        else if($this->is_loggedin()){
            $result = $this->db->select($this->config['db_table_prefix']."users","*","uuid = '".$_SESSION['uuid']."'","","LIMIT 1");
            if($result != 0){
                return $result;
            }
            else return false;
        }
        else return false;
    }

//    public function uploadFile($)

    public function tableItem($string, $attributes){
        return "<td $attributes>".$string."</td>";
    }
}
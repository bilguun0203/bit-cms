<?php

include_once __DIR__.'/../core/connection.php';
if($func->is_loggedin()){
    // Add or Edit user
    if(isset($_POST['btn-edit'])){
        $method = $_POST['method'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $display = $_POST['display'];
        $imgsource = $_POST['imgSource'];
        $about = $_POST['about'];
        if($imgsource == "url"){
            $imgsource = $_POST['imgS'];
        }
        elseif ($imgsource == "file"){
            $imgsource = "";
        }
        else {
            $imgsource = NULL;
        }
        if($method == "edit"){
            $id = $_POST['id'];
            $temp = $func->getUserDataName($uname);
            if($temp != false){
                if($temp['uuid'] != $id) {
                    $func->redirect($func->config['url'] . "bit-bend/?p=edit_user&method=edit&id=" . $id . "&update=0&error=name");
                    return 0;
                }
            }
            $temp = $func->getUserDataEmail($email);
            if($temp != false){
                if($temp['uuid'] != $id) {
                    $func->redirect($func->config['url'] . "bit-bend/?p=edit_user&method=edit&id=" . $id . "&update=0&error=email");
                    return 0;
                }
            }
            $id = $_POST['id'];
            if($func->updateUser($id,$uname,$email,$password,$role,$status,$fname,$lname,$display,$imgsource,$about)){
//                echo $func->updateUser($id,$uname,$email,$password,$role,$status,$fname,$lname,$display,$imgsource,$about);
                $func->redirect($func->config['url']."bit-bend/?p=edit_user&method=edit&id=".$id."&update=1");
            }
            else {
                $func->redirect($func->config['url']."bit-bend/?p=edit_user&method=edit&id=".$id."&update=0");
            }
        }
        else if($method == "add"){
            if($func->getUserDataName($uname)!=false){
                echo "name";
                $func->redirect($func->config['url']."bit-bend/?p=edit_user&method=add&error=name");
            }
            else if($func->getUserDataEmail($email)!=false){
                echo "email";
                $func->redirect($func->config['url']."bit-bend/?p=edit_user&method=add&error=email");
            }
            else if($func->createUser($uname,$email,$password,$role,$status,$fname,$lname,$display,$imgsource,$about)==1){
                echo 1;
                $func->redirect($func->config['url']."bit-bend/?p=users&create=1");
                return 1;
            }
            else {
                echo 0;
                $func->redirect($func->config['url']."bit-bend/?p=users&create=0");
            }
        }
        else {
            $func->redirect($func->config['url']."bit-bend/?p=users");
        }
    }
    // Set user allowed
    if(isset($_POST['btn-allowed'])){
        if (isset($_POST['users']) && count($_POST['users']) > 0) {
            foreach ($_POST['users'] as $user) {
                $func->toggleUserStatus($user, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=users&allowed=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=users&allowed=0");
        }
    }
    // Set user blocked
    if(isset($_POST['btn-blocked'])){
        if (isset($_POST['users']) && count($_POST['users']) > 0) {
            foreach ($_POST['users'] as $user) {
                $func->toggleUserStatus($user, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=users&blocked=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&blocked=0");
        }
    }
    // Delete post
    if(isset($_POST['btn-delete'])){
        if (isset($_POST['users']) && count($_POST['users']) > 0) {
            foreach ($_POST['users'] as $user) {
                $func->deleteUser($user);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=users&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=users&delete=0");
        }
    }
    if(isset($_GET['delete'])){
        if($func->deleteUser($_GET['delete'])){
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=users&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=users&delete=0");
        }
    }
//    $func->redirect($func->config['url']."bit-bend/?p=users");
}
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
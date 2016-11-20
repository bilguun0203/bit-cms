<?php

include_once __DIR__.'/../core/connection.php';

if($func->is_loggedin()){
    // Add or Edit comment
    if(isset($_POST['btn-edit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $comment = preg_replace('/\s\s+/', ' ', $comment);
        $password = $_POST['password'];
        $visibility = $_POST['visibility'];
        $id = $_POST['id'];
        if($func->updateComment($id,$name,$email,$comment,$password,$visibility)){
            $func->redirect($func->config['url']."bit-bend/?p=edit_comment&method=edit&id=".$id."&update=1");
        }
        else {
            $func->redirect($func->config['url']."bit-bend/?p=edit_comment&method=edit&id=".$id."&update=0");
        }
    }
    // Set comment published
    if(isset($_POST['btn-published'])){
        if (isset($_POST['comments']) && count($_POST['comments']) > 0) {
            foreach ($_POST['comments'] as $comment) {
                $func->toggleCommentVisibility($comment, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=comments&published=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=comments&published=0");
        }
    }
    // Set comment draft
    if(isset($_POST['btn-draft'])){
        if (isset($_POST['comments']) && count($_POST['comments']) > 0) {
            foreach ($_POST['comments'] as $comment) {
                $func->toggleCommentVisibility($comment, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=comments&draft=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=comments&draft=0");
        }
    }
    // Set comment waiting
    if(isset($_POST['btn-waiting'])){
        if (isset($_POST['comments']) && count($_POST['comments']) > 0) {
            foreach ($_POST['comments'] as $comment) {
                $func->toggleCommentVisibility($comment, 2);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=comments&waiting=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=comments&waiting=0");
        }
    }
    // Delete comment
    if(isset($_POST['btn-delete'])){
        if (isset($_POST['comments']) && count($_POST['comments']) > 0) {
            foreach ($_POST['comments'] as $comment) {
                $func->deleteComment($comment);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=comments&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=comments&delete=0");
        }
    }
    if(isset($_GET['delete'])){
        if($func->deleteComment($_GET['delete'])){
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=comments&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=comments&delete=0");
        }
    }
//    $func->redirect($func->config['url']."bit-bend/?p=comments");
}
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
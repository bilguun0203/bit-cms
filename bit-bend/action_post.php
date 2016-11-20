<?php

include_once __DIR__.'/../core/connection.php';

if($func->is_loggedin()){
    // Add or Edit post
    if(isset($_POST['btn-edit'])){
        $method = $_POST['method'];
        $title = $_POST['title'];
        $link = $_POST['link'];
        $body = $_POST['body'];
        $category = $_POST['category'];
        $tags = $_POST['tags'];
        $parent = $_POST['parent'];
        $imgsource = $_POST['imgSource'];
        $visibility = $_POST['visibility'];
        $comment = $_POST['comment'];
        $pubdate = $_POST['pubdate'];
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
            if($func->updatePost($id,$title,$link,$body,$category,$tags,$parent,$imgsource,$visibility,$comment,$pubdate)){
                $func->redirect($func->config['url']."bit-bend/?p=edit_post&method=edit&id=".$id."&update=1");
            }
            else {
                $func->redirect($func->config['url']."bit-bend/?p=edit_post&method=edit&id=".$id."&update=0");
            }
        }
        else if($method == "add"){
            if($func->createPost($title,$link,$body,$category,$tags,$parent,$imgsource,$visibility,$comment,$pubdate)){
                $func->redirect($func->config['url']."bit-bend/?p=posts&create=1");
            }
            else {
                $func->redirect($func->config['url']."bit-bend/?p=posts&create=0");
            }
        }
        else {
            $func->redirect($func->config['url']."bit-bend/?p=posts");
        }
    }
    // Set post published
    if(isset($_POST['btn-published'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->togglePostVisibility($post, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&published=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&published=0");
        }
    }
    // Set post draft
    if(isset($_POST['btn-draft'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->togglePostVisibility($post, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&draft=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&draft=0");
        }
    }
    // Set post waiting
    if(isset($_POST['btn-waiting'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->togglePostVisibility($post, 2);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&waiting=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&waiting=0");
        }
    }
    // Allow comments on post
    if(isset($_POST['btn-com-allow'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->togglePostComment($post, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&comallow=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&comallow=0");
        }
    }
    // Not allowed to write comments on post
    if(isset($_POST['btn-com-deny'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->togglePostComment($post, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&comdeny=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&comdeny=0");
        }
    }
    // Delete post
    if(isset($_POST['btn-delete'])){
        if (isset($_POST['posts']) && count($_POST['posts']) > 0) {
            foreach ($_POST['posts'] as $post) {
                $func->deletePost($post);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&delete=0");
        }
    }
    if(isset($_GET['delete'])){
        if($func->deletePost($_GET['delete'])){
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=posts&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=posts&delete=0");
        }
    }
    $func->redirect($func->config['url']."bit-bend/?p=posts");
}
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
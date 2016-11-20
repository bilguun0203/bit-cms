<?php

include_once __DIR__.'/../core/connection.php';

if($func->is_loggedin()){
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
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
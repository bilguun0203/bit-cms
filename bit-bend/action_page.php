<?php

include_once __DIR__.'/../core/connection.php';

if($func->is_loggedin()){
    if(isset($_POST['btn-edit'])){
        $method = $_POST['method'];
        $title = $_POST['title'];
        $link = $_POST['link'];
        $body = $_POST['body'];
        $type = $_POST['type'];
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
            if($func->updatePage($id,$title,$link,$body,$type,$category,$tags,$parent,$imgsource,$visibility,$comment,$pubdate)){
                $func->redirect($func->config['url']."bit-bend/?p=edit_page&method=edit&id=".$id."&update=1");
            }
            else {
                $func->redirect($func->config['url']."bit-bend/?p=edit_page&method=edit&id=".$id."&update=0");
            }
        }
        else if($method == "add"){
            if($func->createPage($title,$link,$body,$type,$category,$tags,$parent,$imgsource,$visibility,$comment,$pubdate)){
                $func->redirect($func->config['url']."bit-bend/?p=pages&create=1");
            }
            else {
                $func->redirect($func->config['url']."bit-bend/?p=pages&create=0");
            }
        }
        else {
            $func->redirect($func->config['url']."bit-bend/?p=pages");
        }
    }
    // Set page published
    if(isset($_POST['btn-published'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->togglePageVisibility($page, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&published=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&published=0");
        }
    }
    // Set page draft
    if(isset($_POST['btn-draft'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->togglePageVisibility($page, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&draft=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&draft=0");
        }
    }
    // Set page waiting
    if(isset($_POST['btn-waiting'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->togglePageVisibility($page, 2);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&waiting=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&waiting=0");
        }
    }
    // Allow comments on page
    if(isset($_POST['btn-com-allow'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->togglePageComment($page, 1);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&comallow=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&comallow=0");
        }
    }
    // Not allowed to write comments on page
    if(isset($_POST['btn-com-deny'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->togglePageComment($page, 0);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&comdeny=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&comdeny=0");
        }
    }
    // Delete page
    if(isset($_POST['btn-delete'])){
        if (isset($_POST['pages']) && count($_POST['pages']) > 0) {
            foreach ($_POST['pages'] as $page) {
                $func->deletePage($page);
            }
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&delete=0");
        }
    }
    if(isset($_GET['delete'])){
        if($func->deletePage($_GET['delete'])){
            echo 1;
            $func->redirect($func->config['url']."bit-bend/?p=pages&delete=1");
        } else {
            echo 0;
            $func->redirect($func->config['url']."bit-bend/?p=pages&delete=0");
        }
    }
    $func->redirect($func->config['url']."bit-bend/?p=pages");
}
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
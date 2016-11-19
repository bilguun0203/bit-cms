<?php

include_once __DIR__.'/../core/connection.php';

if($func->is_loggedin()){
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
}
else {
    $func->redirect($func->config['url']."bit-bend/?p=login");
}
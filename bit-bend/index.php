<?php

include_once __DIR__.'/../core/connection.php';
if($db_connection == 1 && $dbc->checkAllTable($config['db_name'],$config['db_table_prefix'])){
    $data = array();
    if($func->is_loggedin()) {
        $data['user'] = $func->getUserData();
        if (isset($_GET['p'])) {
            $page = $_GET['p'];
            if ($func->checkView("backend/template/standard/" . $page)) {
                $data['title'] = "BitCMS Backend - " . $page;
                $data['page'] = $page;

                // PAGE: POSTS
                if ($page == "posts") {
                    $result = $dbc->select($config['db_table_prefix'] . "posts", "*");
                    if ($result != 0) {
                        if (is_array($result[0]))
                            $data['posts'] = $result;
                        else $data['posts'][0] = $result;
                    } else {
                        $data['posts'] = 0;
                    }
                }

                // PAGE: EDIT POST
                if ($page == "edit_post") {
                    if (isset($_GET['method'])) {
                        if ($_GET['method'] == "edit" && isset($_GET['id'])) {
                            $result = $dbc->select($config['db_table_prefix'] . "posts", "*", "id = " . $_GET['id'], "", "LIMIT 1");
                            if ($result != 0) {
                                $data['method'] = "edit";
                                $data['post'] = $result;
                            } else {
                                $data['method'] = "add";
                            }
                        } else $data['method'] = "add";
                    } else {
                        $data['method'] = "add";
                    }
                }

                // PAGE: PAGES
                if ($page == "pages") {
                    $result = $dbc->select($config['db_table_prefix'] . "pages", "*");
                    if ($result != 0) {
                        if (is_array($result[0]))
                            $data['pages'] = $result;
                        else $data['pages'][0] = $result;
                    } else {
                        $data['pages'] = 0;
                    }
                }

                // PAGE: EDIT PAGE
                if ($page == "edit_page") {
                    if (isset($_GET['method'])) {
                        if ($_GET['method'] == "edit" && isset($_GET['id'])) {
                            $result = $dbc->select($config['db_table_prefix'] . "pages", "*", "id = " . $_GET['id'], "", "LIMIT 1");
                            if ($result != 0) {
                                $data['method'] = "edit";
                                $data['page'] = $result;
                            } else {
                                $data['method'] = "add";
                            }
                        } else $data['method'] = "add";
                    } else {
                        $data['method'] = "add";
                    }
                }

                // PAGE: COMMENTS
                if ($page == "comments") {
                    $result = $dbc->select($config['db_table_prefix'] . "comments", "*");
                    if ($result != 0) {
                        if (is_array($result[0]))
                            $data['comments'] = $result;
                        else $data['comments'][0] = $result;
                    } else {
                        $data['comments'] = 0;
                    }
                }

                // PAGE: EDIT COMMENT
                if ($page == "edit_comment") {
                    if (isset($_GET['method'])) {
                        if ($_GET['method'] == "edit" && isset($_GET['id'])) {
                            $result = $dbc->select($config['db_table_prefix'] . "comments", "*", "id = " . $_GET['id'], "", "LIMIT 1");
                            if ($result != 0) {
                                $data['method'] = "edit";
                                $data['comment'] = $result;
                            } else {
                                $func->redirect($config['url'] . "bit-bend/?p=comments&error=1");
                            }
                        } else $func->redirect($config['url'] . "bit-bend/?p=comments&error=1");
                    } else {
                        $func->redirect($config['url'] . "bit-bend/?p=comments&error=1");
                    }
                }

                // PAGE: USERS
                if ($page == "users") {
                    $result = $dbc->select($config['db_table_prefix'] . "users", "*");
                    if ($result != 0) {
                        if (is_array($result[0]))
                            $data['users'] = $result;
                        else $data['users'][0] = $result;
                    } else {
                        $data['users'] = 0;
                    }
                }

                // PAGE: EDIT USER
                if ($page == "edit_user") {
                    if (isset($_GET['method'])) {
                        if ($_GET['method'] == "edit" && isset($_GET['id'])) {
                            $result = $dbc->select($config['db_table_prefix'] . "users", "*", "id = " . $_GET['id'], "", "LIMIT 1");
                            if ($result != 0) {
                                $data['method'] = "edit";
                                $data['user'] = $result;
                            } else {
                                $data['method'] = "add";
                            }
                        } else $data['method'] = "add";
                    } else {
                        $data['method'] = "add";
                    }
                }

                $func->loadView("backend/template/standard/" . $page, $data);
            } else {
                $data['title'] = "BitCMS Backend - ERROR 404";
                $data['page'] = "404";
                $func->loadView("backend/template/standard/404", $data);
            }
        } else {
            $data['title'] = "BitCMS Backend";
            $data['page'] = "index";
            $func->loadView("backend/template/standard/index", $data);
        }
    }
    else {
        if(isset($_GET['p']) == "login"){
            $func->loadView("backend/template/standard/login", $data);
        }
        else {
            $func->redirect($config['url'] . "bit-bend/?p=login");
        }
    }
}
else {
    echo "<br/><hr><br>Database connection failed. Please check your <code>config.php</code> file<br/>OR<br/>If you don't installed cms, please click Install.<br/>";
    echo "<a href='../install'>INSTALL</a>";
}
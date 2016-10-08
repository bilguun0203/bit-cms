<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $data['title']; ?></title>
    <!-- Bootstrap -->
    <link href="../views/backend/template/standard/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/customBT.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/style.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/libs/DataTables/jquery.dataTables.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/libs/DataTables/extensions/dataTables.colVis.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/libs/DataTables/extensions/dataTables.tableTools.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/libs/datepicker.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/libs/morris/morris.core.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../views/backend/template/standard/assets/js/core/jquery-1.12.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../views/backend/template/standard/assets/js/core/bootstrap.min.js"></script>
    <script src="../views/backend/template/standard/assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
    <script src="../views/backend/template/standard/assets/js/core/backend.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse dashboard navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-navicon" style="color: #EEEEEE;" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="#">BitCode CMS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo $this->config['url']; ?>" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> Сайтаа үзэх</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Билгүүн<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?p=account"><i class="fa fa-edit text-info" aria-hidden="true"></i> Бүртгэл</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?p=login"><i class="fa fa-power-off text-danger" aria-hidden="true"></i> Гарах</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="wrapper" class="active">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
            <li class="sidebar-brand"><a id="menu-toggle" href="#">Цэс <i id="main_icon" class="fa fa-navicon" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
            <li><a href="?p=index"<?php if($data['page']=="index"){ echo ' class="active"';} ?>>Нүүр хуудас <i class="sub_icon fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="?p=articles"<?php if($data['page']=="articles"){ echo ' class="active"';} ?>>Нийтлэл <i class="sub_icon fa fa-edit" aria-hidden="true"></i></a></li>
            <li><a href="?p=pages"<?php if($data['page']=="pages"){ echo ' class="active"';} ?>>Хуудас <i class="sub_icon fa fa-list-alt" aria-hidden="true"></i></a></li>
            <li><a href="?p=comments"<?php if($data['page']=="comments"){ echo ' class="active"';} ?>>Сэтгэгдэл <i class="sub_icon fa fa-comments-o" aria-hidden="true"></i></a></li>
            <li><a href="?p=users"<?php if($data['page']=="users"){ echo ' class="active"'; }?>>Хэрэглэгчид <i class="sub_icon fa fa-users" aria-hidden="true"></i></a></li>
            <li><a href="?p=files"<?php if($data['page']=="files"){ echo ' class="active"'; }?>>Файлууд <i class="sub_icon fa fa-files-o" aria-hidden="true"></i></a></li>
            <li><a href="?p=personalize"<?php if($data['page']=="personalize"){ echo ' class="active"';} ?>>Загвар <i class="sub_icon fa fa-object-group" aria-hidden="true"></i></a></li>
            <li><a href="?p=statistics"<?php if($data['page']=="statistics"){ echo ' class="active"';} ?>>Статистик <i class="sub_icon fa fa-line-chart" aria-hidden="true"></i></a></li>
            <li><a href="?p=settings"<?php if($data['page']=="options"){ echo ' class="active"'; }?>>Тохиргоо <i class="sub_icon fa fa-cogs" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <!-- Page content -->
    <div id="page-content-wrapper">
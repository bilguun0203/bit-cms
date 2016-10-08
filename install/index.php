<?php

include_once __DIR__ . "/../core/connection.php";

if(isset($_GET['error'])){
    $error = $_GET['error'];
}
else {
    $error = 0;
}
if(isset($_GET['step'])){
    $step = $_GET['step'];
}
else {
    $step = 1;
}
if($db_connection==1 && $step==1){
//    header("Location: index.php?step=2&host=".$config['db_host']."&name=".$config['db_name']."&user=".$config['db_user']."&pwd=".$config['db_password']."&prefix=".$config['db_table_prefix']);
}
$status = 100/3-$step;
?>
<!DOCTYPE HTML>
<html lang="en" style="background-color: #222222;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/customBT.css">
    <link rel="stylesheet" href="style.css">
    <title>BitCMS Installation</title>
</head>
<body style="background-color: #222222;">
<div class="modal-dialog">
    <div class="modal-content">
        <form action="db_config.php" method="get" role="form">
            <div class="modal-header">
                <h4 class="modal-title">BitCMS Installation</h4>
            </div>
            <div class="modal-body">
                <div class="row steps">
                    <div class="col-sm-4 step <?php if($step==1) echo "active"; ?>">
                        <h3>1</h3>
                        <p>Өгөгдлийн сан</p>
                    </div>
                    <div class="col-sm-4 step <?php if($step==2) echo "active"; ?>">
                        <h3>2</h3>
                        <p>Хэрэглэгч үүсгэх</p>
                    </div>
                    <div class="col-sm-4 step <?php if($step==3) echo "active"; ?>">
                        <h3>3</h3>
                        <p>Дуусгах</p>
                    </div>
                </div>
                <?php if($step==1){ ?>
                <h3>Өгөгдлийн сангийн тохиргоо</h3>
                <?php
                    if($error == 1){
                ?>
                <div class="alert alert-danger">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<strong>Алдаа!</strong> Өгөгдлийн сантай холбогдож чадсангүй. Оруулсан өгөгдлөө шалгана уу.
                </div>
                <?php
                    }
                if($error == 2){
                    ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><strong>Алдаа!</strong> Хүснэгт үүсгэхэд ямар нэгэн алдаа гарлаа.</p>
                    </div>
                    <div class="alert alert-warning">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <p><strong>Мэдэгдэл 1:</strong> <?php if(isset($_GET['msg1'])) echo $_GET['msg1']; ?></p>
                        <p><strong>Мэдэгдэл 2:</strong> <?php if(isset($_GET['msg2'])) echo $_GET['msg2']; ?></p>
                        <p><strong>Мэдэгдэл 3:</strong> <?php if(isset($_GET['msg3'])) echo $_GET['msg3']; ?></p>
                        <p><strong>Мэдэгдэл 4:</strong> <?php if(isset($_GET['msg4'])) echo $_GET['msg4']; ?></p>
                        <p><strong>Мэдэгдэл 5:</strong> <?php if(isset($_GET['msg5'])) echo $_GET['msg5']; ?></p>
                        <p><strong>Мэдэгдэл 6:</strong> <?php if(isset($_GET['msg6'])) echo $_GET['msg6']; ?></p>
                        <p><strong>Мэдэгдэл 7:</strong> <?php if(isset($_GET['msg7'])) echo $_GET['msg7']; ?></p>
                        <p><strong>Мэдэгдэл 8:</strong> <?php if(isset($_GET['msg8'])) echo $_GET['msg8']; ?></p>
                        <p><strong>Мэдэгдэл 9:</strong> <?php if(isset($_GET['msg9'])) echo $_GET['msg9']; ?></p>
                    </div>
                    <?php
                }
                ?>
                    <input type="text" name="method" value="db" hidden/>
                    <hr>
                    <div class="form-group">
                        <label>Байршил</label>
                        <input type="text" class="form-control" name="db_host" id="db_host" value="<?php echo $config['db_host']; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>ӨС нэр</label>
                        <input type="text" class="form-control" name="db_name" id="db_name" value="<?php echo $config['db_name']; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Хэрэглэгчийн нэр</label>
                        <input type="text" class="form-control" name="db_user" id="db_user" value="<?php echo $config['db_user']; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label>Хүснэгтийн эхлэл</label>
                        <input type="text" class="form-control" name="db_prefix" id="db_prefix" value="<?php echo $config['db_table_prefix']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Нууц үг</label>
                        <input type="text" class="form-control" name="db_password" id="db_password" value="<?php echo $config['db_password']; ?>" />
                    </div>
                <?php
                }
                if($step==2){
                ?>
                    <h3>Админ үүсгэх</h3>
                    <?php
                    if($error == 1){
                        ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Алдаа!</strong> Хэрэглэгч үүсгэж чадсангүй. Нууц үг, ц-шуудангаа зөв оруулсан эсэхийг шалгана уу.
                        </div>
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <p><strong>Мэдэгдэл 1:</strong> <?php if(isset($_GET['msg'])) echo $_GET['msg']; ?></p>
                        </div>
                        <?php
                    }
                    ?>
                    <input type="text" name="method" value="user" hidden/>
                    <hr>
                    <div class="form-group">
                        <label>Хэрэглэгчийн нэр</label>
                        <input type="text" class="form-control" name="username" value="admin" required />
                    </div>
                    <div class="form-group">
                        <label>Цахим шуудан</label>
                        <input type="email" class="form-control" name="email" required />
                    </div>
                    <div class="form-group">
                        <label>Нууц үг</label>
                        <input type="password" class="form-control" name="password" required />
                    </div>
                    <div class="form-group">
                        <label>Нууц үг давтах</label>
                        <input type="password" class="form-control" name="confirm_password" required />
                    </div>
                <?php
                }
                if($step==3){
                    ?>
                    <h3>Суурилуулалт дууслаа</h3>
                    <p>Bit АУС амжилттай суурилууллаа. Одоо та цахим хуудасны эхлэл хэсэгт очих эсвэл удирдах хэсэгт очиж болно.</p>
                    <p class="text-muted">Хэрвээ та доор байгаа товчны аль нэгэн дээр дарахад аюулгүй байдлын үүднээс энэ хавтас буюу <code>/install/</code> хавтсыг устах болно.</p>
                    <a href="../index.php" class="btn btn-success">Цахим хуудсандаа зочлох</a> <a href="../bit-bend" class="btn btn-primary">Удирдах хэсэгт нэвтрэх</a>
                    <?php
                }
                ?>
            </div>
            <div class="modal-footer">
                <?php if($step!=3){ ?><button type="submit" name="submit" id="submit" class="btn btn-primary">Цааш</button><?php } ?>
            </div>
        </form>
    </div>
</div>
<script src="../lib/js/core/jquery-1.12.3.min.js"></script>
<script src="../lib/js/core/bootstrap.min.js"></script>
<?php if($step==2){ ?>
<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            if()
        });
    });
</script>
<?php } ?>
</body>
</html>
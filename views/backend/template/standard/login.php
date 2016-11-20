<?php
if($this->is_loggedin()){
    $this->redirect($config['url']."?p=index");
}

$error = "";
if(isset($_GET['error'])){
    $error = $_GET['error'];
    if($error==1)
        $error = "Таны оруулсан өгөгдөл буруу байна.";
    else if ($error==2)
        $error = "Таны бүртгэл идэвхгүй байна.";
}
$cookie = "";
if(isset($_COOKIE["bit_username"])){
    $cookie = $_COOKIE["bit_username"];
}

?>
<!DOCTYPE html>
<html lang="en" style="background-color: #212121;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if(isset($data['title'])) echo $data['title']; else echo "BitCMS Login" ?></title>
    <!-- Bootstrap -->
    <link href="../views/backend/template/standard/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/customBT.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/style.css" rel="stylesheet">
    <link href="../views/backend/template/standard/assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background-color: #212121;">
<br class="hidden-sm hidden-xs"><br class="hidden-xs"><br>
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <form action="login.php" method="get" role="form">
            <div class="modal-header">
                <h4 class="modal-title">Нэвтрэх</h4>
            </div>
            <div class="modal-body">
                <?php if($error == 1){ ?>
                <div class="alert alert-danger">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<strong>Анхаар!</strong> <?php echo $error; ?>
                </div>
                <?php } ?>
                <div class="form-group">
                    <label for="name">Хэрэглэгчийн нэр/Цахим шуудан</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $cookie; ?>" required>
                </div>
                <div class="form-group">
                    <label for="pass">Нууц үг</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        Намайг сана
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Нууц үг мартсан?</button>
                <button type="submit" name="btn-login" class="btn btn-primary">Нэвтрэх</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<p class="text-center"><a href="<?php echo $this->config['url']; ?>" class="btn btn-link"><i class="fa fa-arrow-left"></i> Эхлэл хуудас руу буцах</a></p>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../views/backend/template/standard/assets/js/core/jquery-1.12.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../views/backend/template/standard/assets/js/core/bootstrap.min.js"></script>
</body>
</html>
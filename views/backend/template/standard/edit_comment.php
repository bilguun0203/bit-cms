<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/datepicker.css" rel="stylesheet">
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/jquery-ui.min.css" rel="stylesheet">
<?php include_once 'elements/header_end.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <form method="post" action="action_comment.php" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">

                                Сэтгэгдэл засах
                            </div>
                            <div class="panel-body">

                                <input id="method" name="method" type="text" value="<?php echo $data['method']; ?>" hidden>
                                <input id="id" name="id" type="text" value="<?php echo $data['comment']['id'] ?>" hidden>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Нэр</label>
                                        <input class="form-control" id="name" name="name" type="text" value="<?php echo $data['comment']['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Ц-шуудан</label>
                                        <input class="form-control" id="email" name="email" type="text" value="<?php echo $data['comment']['email']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="editor">Сэтгэгдэл</label>
                                    <textarea class="form-control" id="editor" name="comment" required><?php echo $data['comment']['comment']; ?></textarea>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="?p=comments" class="btn btn-info"><i class="fa fa-arrow-left"></i> Буцах</a>
                                <button type="submit" name="btn-edit" class="btn btn-success"><i class="fa fa-save"></i> Хадгалах</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Тохиргоо
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label" for="password">Нууц үг</label>
                                    <input class="form-control" id="password" name="password" type="text" value="<?php echo $data['comment']['password']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Харагдалт</label>
                                    <div class="radio radio-success">
                                        <input type="radio" name="visibility" id="v1" value="1" <?php if($data['comment']['visibility']==1) echo "checked"; else echo "checked"; ?>>
                                        <label for="v1">
                                            Нийтлэгдэнэ
                                        </label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="visibility" id="v2" value="0" <?php if($data['comment']['visibility']==0) echo "checked"; ?>>
                                        <label for="v2">
                                            Нуугдсан
                                        </label>
                                    </div>
                                    <div class="radio radio-warning">
                                        <input type="radio" name="visibility" id="v3" value="2" <?php if($data['comment']['visibility']==2) echo "checked"; ?>>
                                        <label for="v3">
                                            Хүлээлгэнд
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php include_once 'elements/js.php'; ?>
<script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/core/jquery-ui.min.js"></script>
<?php include_once 'elements/js_end.php'; ?>
<?php include_once 'elements/footer.php'; ?>
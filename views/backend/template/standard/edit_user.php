<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/datepicker.css" rel="stylesheet">
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/jquery-ui.min.css" rel="stylesheet">
<?php include_once 'elements/header_end.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <form method="post" action="action_user.php" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">

                                Хэрэглэгч <?php if($data['method']=="edit") echo "засах"; else echo "нэмэх"; ?>
                            </div>
                            <div class="panel-body">
                                <input id="method" name="method" type="text" value="<?php echo $data['method']; ?>" hidden>
                                <input id="id" name="id" type="text" value="<?php echo $data['edituser']['uuid'] ?>" hidden>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="fname">Нэр</label>
                                        <input class="form-control" id="fname" name="fname" type="text" value="<?php if($data['method']=="edit") echo $data['edituser']['first_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="lname">Овог</label>
                                        <input class="form-control" id="lname" name="lname" type="text" value="<?php if($data['method']=="edit") echo $data['edituser']['last_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="uname">Хэрэглэгчийн нэр</label>
                                        <input class="form-control" id="uname" name="uname" type="text" value="<?php if($data['method']=="edit") echo $data['edituser']['username']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Ц-шуудан</label>
                                        <input class="form-control" id="email" name="email" type="email" value="<?php if($data['method']=="edit") echo $data['edituser']['email']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="editor">Агуулга</label>
                                    <textarea class="form-control" id="editor" name="about" required>
                                    <?php if($data['method']=="edit") echo $data['edituser']['about']; ?>
                                </textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="password">Нууц үг</label>
                                        <input class="form-control" id="password" name="password" type="password" value="" <?php if($data['method']=="add") echo "required"; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="submit" name="btn-edit" class="btn btn-success"><i class="fa fa-<?php if($data['method']=="edit") echo "save"; else echo "plus"; ?>"></i> <?php if($data['method']=="edit") echo "Хадгалах"; else echo "Нэмэх"; ?></button>
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
                                    <label for="display" class="control-label">Харагдах нэр</label>
                                    <select class="form-control" id="display" name="display">
                                        <option value="username"><?php if($data['method']=="edit") echo $data['edituser']['username']; else echo "username"; ?></option>
                                        <option value="fname"><?php if($data['method']=="edit"){ if($data['edituser']['first_name'] != "" && $data['edituser']['last_name'] != "") echo $data['edituser']['first_name'];else echo "[first_name]";} else echo "[first_name]"; ?></option>
                                        <option value="lname"><?php if($data['method']=="edit"){ if($data['edituser']['first_name'] != "" && $data['edituser']['last_name'] != "") echo $data['edituser']['last_name'];else echo "[last_name]";} else echo "[last_name]"; ?></option>
                                        <option value="fullname"><?php if($data['method']=="edit"){ if($data['edituser']['first_name'] != "" && $data['edituser']['last_name'] != "") echo $data['edituser']['first_name']." ".$data['edituser']['last_name'];else echo "[first last]";} else echo "[first last]"; ?></option>
                                        <option value="fullname2"><?php if($data['method']=="edit"){ if($data['edituser']['first_name'] != "" && $data['edituser']['last_name'] != "") echo $data['edituser']['last_name']." ".$data['edituser']['first_name'];else echo "[last first]";} else echo "[last first]"; ?></option>
                                        <option value="lfname2"><?php if($data['method']=="edit"){ if($data['edituser']['first_name'] != "" && $data['edituser']['last_name'] != "") echo $data['edituser']['last_name'][0].".".$data['edituser']['first_name'];else echo "[l.first]";} else echo "[l.first]"; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="control-label">Эрх</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="subscriber" <?php if($data['method']=="edit" && $data['edituser']['role']=="subscriber") echo "selected"; else echo "selected"; ?>>subscriber</option>
                                        <option value="admin" <?php if($data['method']=="edit" && $data['edituser']['role']=="admin") echo "selected"; ?>>admin</option>
                                    </select>
                                </div>
                                <!-- FEATURED IMAGE -->
                                <div class="alert alert-primary">
                                    <div class="form-group">
                                        <label for="imgSource" class="control-label">Зураг оруулах <i id="imgLabelURL">| <i class="fa fa-link"></i> Холбоос</i><i id="imgLabelFile">| <i class="fa fa-file-image-o"></i> Файл</i></label>
                                        <select class="form-control" id="imgSource" name="imgSource">
                                            <option value="none"><i class="fa fa-ban"></i> Зураггүй</option>
                                            <option value="url" <?php if($data['method']=="edit" && ($data['edituser']['avatar']!="" || $data['edituser']['avatar']!=NULL)) echo "selected"; ?>>Холбоос</option>
                                            <option value="file">Хуулах</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="imgURL">
                                        <label class="control-label" for="imgS">Хаяг</label>
                                        <input class="form-control" id="imgS" name="imgS" type="text" placeholder="http://" value="<?php if($data['method']=="edit") echo $data['edituser']['avatar']; ?>">
                                    </div>
                                    <div class="form-group" id="imgFile">
                                        <i class="text-muted">Одоогоор ажиллагаагүй</i>
                                        <label for="img" class="control-label">Зураг</label>
                                        <input type="file" name="img" id="img">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Төлөв</label>
                                    <div class="radio radio-success">
                                        <input type="radio" name="status" id="v1" value="1" <?php if($data['method']=="edit" && $data['edituser']['status']==1) echo "checked"; else echo "checked"; ?>>
                                        <label for="v1">
                                            Иэдвхтэй
                                        </label>
                                    </div>
                                    <div class="radio radio-danger">
                                        <input type="radio" name="status" id="v2" value="0" <?php if($data['method']=="edit" && $data['edituser']['status']==0) echo "checked"; ?>>
                                        <label for="v2">
                                            Идэвхгүй
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
    <script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/libs/ckeditor/ckeditor.js"></script>
    <script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<?php include_once 'elements/js_end.php'; ?>
<script>
    var imgu = document.getElementById('imgURL');
    var imgf = document.getElementById('imgFile');
    $('#imgSource').change(function () {
        var method = document.getElementById('imgSource').value;
        console.log("Method: "+method);
        if(method == "none"){
            $('#imgURL').slideUp();
            $('#imgFile').slideUp();
            $('#imgLabelURL').fadeOut(100);
            $('#imgLabelFile').fadeOut(100);
            return 0;
        }
        if(method == "url"){
            $('#imgURL').slideDown();
            $('#imgFile').slideUp();
            $('#imgLabelURL').fadeIn(100);
            $('#imgLabelFile').fadeOut(100);
        }
        if (method == "file"){
            $('#imgURL').slideUp();
            $('#imgFile').slideDown();
            $('#imgLabelURL').fadeOut(100);
            $('#imgLabelFile').fadeIn(100);
        }
    });

    CKEDITOR.replace('editor', {
        language: 'mn',
        skin: 'office2013',
        extraPlugins: 'imageuploader',
        "filebrowserImageUploadUrl": "js/libs/ckeditor/plugins/imgupload.php",
        on: {
            instanceReady: function() {
                this.dataProcessor.htmlFilter.addRules( {
                    elements: {
                        img: function( el ) {
                            el.addClass( 'img-responsive auto-width' );
                        }
                    }
                } );
            }
        }
    });
</script>
<?php include_once 'elements/footer.php'; ?>
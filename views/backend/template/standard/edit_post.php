<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/datepicker.css" rel="stylesheet">
<link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="<?php echo $this->config['file_path_bend']; ?>standard/assets/css/jquery-ui.min.css" rel="stylesheet">
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <form method="post" action="action_post.php" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">

                            Нийтлэл бичих <?php echo $data['method']; ?>
                        </div>
                        <div class="panel-body">

                            <input id="method" name="method" type="text" value="<?php echo $data['method']; ?>" hidden>
                            <input id="id" name="id" type="text" value="<?php echo $data['post']['id'] ?>" hidden>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="title">Гарчиг</label>
                                    <input class="form-control" id="title" name="title" type="text" value="<?php if($data['method']=="edit") echo $data['post']['title']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="link">Хаяг</label>
                                    <input class="form-control" id="link" name="link" type="text" value="<?php if($data['method']=="edit") echo $data['post']['link']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="editor">Агуулга</label>
                                <textarea class="form-control" id="editor" name="body" required><?php if($data['method']=="edit") echo $data['post']['body']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category" class="control-label">Ангилал</label>
<!--                                <select class="form-control" id="category" name="category">-->
<!--                                    <option value="uncategorized">Ангилалгүй</option>-->
<!--                                    <option>2</option>-->
<!--                                    <option>3</option>-->
<!--                                    <option>4</option>-->
<!--                                    <option>5</option>-->
<!--                                </select>-->
                                <input class="form-control" id="category" name="category" type="text" value="<?php if($data['method']=="edit") echo $data['post']['category']; else echo "Ангилалгүй"; ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="tags">Шошго</label>
                                <input class="form-control" id="tags" name="tags" type="text" data-role="tagsinput" value="<?php if($data['method']=="edit") echo $data['post']['tags']; ?>">
                            </div>

                        </div>
                        <div class="panel-footer">
                            <a href="?p=posts" class="btn btn-info"><i class="fa fa-arrow-left"></i> Буцах</a>
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
                                <label for="parent" class="control-label">Эх нийтлэл</label>
                                <select class="form-control" name="parent" id="parent">
                                    <option value="0" <?php if($data['post']['parent'] == 0) echo "selected"; ?>>Байхгүй</option>
                                    <?php if($data['parent'] != 0){ foreach ($data['parent'] as $item){ if($item['id']!=$data['post']['id']) { ?>
                                        <option value="<?php echo $item['id']; ?>" <?php if($data['post']['parent'] == $item['id']) echo "selected"; ?>><?php echo $item['title']; ?></option>
                                    <?php } } } ?>
                                </select>
                            </div>
                            <!-- FEATURED IMAGE -->
                            <div class="alert alert-primary">
                                <div class="form-group">
                                    <label for="imgSource" class="control-label">Зураг оруулах <i id="imgLabelURL">| <i class="fa fa-link"></i> Холбоос</i><i id="imgLabelFile">| <i class="fa fa-file-image-o"></i> Файл</i></label>
                                    <select class="form-control" id="imgSource" name="imgSource">
                                        <option value="none"><i class="fa fa-ban"></i> Зураггүй</option>
                                        <option value="url" <?php if($data['method']=="edit" && ($data['post']['image']!="" || $data['post']['image']!=NULL)) echo "selected"; ?>>Холбоос</option>
                                        <option value="file">Хуулах</option>
                                    </select>
                                </div>
                                <div class="form-group" id="imgURL">
                                    <label class="control-label" for="imgS">Хаяг</label>
                                    <input class="form-control" id="imgS" name="imgS" type="text" placeholder="http://" value="<?php if($data['method']=="edit") echo $data['post']['image']; ?>">
                                </div>
                                <div class="form-group" id="imgFile">
                                    <i class="text-muted">Одоогоор ажиллагаагүй</i>
                                    <label for="img" class="control-label">Зураг</label>
                                    <input type="file" name="img" id="img">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Харагдалт</label>
                                <div class="radio radio-success">
                                    <input type="radio" name="visibility" id="v1" value="1" <?php if($data['method']=="edit" && $data['post']['visibility']==1) echo "checked"; else echo "checked"; ?>>
                                    <label for="v1">
                                        Нийтлэгдэнэ
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" name="visibility" id="v2" value="0" <?php if($data['method']=="edit" && $data['post']['visibility']==0) echo "checked"; ?>>
                                    <label for="v2">
                                        Ноорог
                                    </label>
                                </div>
                                <div class="radio radio-warning">
                                    <input type="radio" name="visibility" id="v3" value="2" <?php if($data['method']=="edit" && $data['post']['visibility']==2) echo "checked"; ?>>
                                    <label for="v3">
                                        Хүлээлгэнд
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Сэтгэгдэл</label>
                                <div class="radio radio-success">
                                    <input type="radio" name="comment" id="c1" value="1" <?php if($data['method']=="edit" && $data['post']['comments_allowed']==1) echo "checked"; else echo "checked"; ?>>
                                    <label for="c1">
                                        Зөвшөөрнө
                                    </label>
                                </div>
                                <div class="radio radio-danger">
                                    <input type="radio" name="comment" id="c2" value="0" <?php if($data['method']=="edit" && $data['post']['comments_allowed']==0) echo "checked"; ?>>
                                    <label for="c2">
                                        Зөвшөөрөхгүй
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="pubdate">Нийтлэгдэх огноо</label>
                                <input class="form-control datepicker" name="pubdate" id="pubdate" type="text"  value="<?php if($data['method']=="edit") echo $data['post']['pubdate']; ?>">
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

    var date = new Date();
    var month = date.getMonth();
    month++;
    if(month < 10){
        month = "0"+month;
    }
    var pubdate = date.getFullYear()+"-"+month+"-"+date.getDate();
    document.getElementById('pubdate').value = pubdate;

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
    $(function () {
        $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
    });
</script>
<?php include_once 'elements/footer.php'; ?>
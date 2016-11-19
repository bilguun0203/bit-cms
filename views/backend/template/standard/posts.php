<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/css_dataTables.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="action_post.php">
                <h1>Нийтлэлүүд</h1>
                <hr>
                <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                    <a href="<?php echo $this->config['url']."bit-bend/?p=edit_post&method=add"; ?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Нэмэх</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Харагдалт өөрчлөх <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" class="btn btn-link" name="btn-published"><i class="fa fa-check text-success"></i> Нийтлэгдсэн</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-draft"><i class="fa fa-edit text-danger"></i> Ноорог</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-waiting"><i class="fa fa-hourglass-half text-warning"></i> Хүлээлгэнд</button></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comments-o"></i> Сэтгэгдэл <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" class="btn btn-link" name="btn-com-allow"><i class="fa fa-check text-success"></i> Зөвшөөрнө</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-com-deny"><i class="fa fa-remove text-danger"></i> Зөвшөөрөхгүй</button></li>
                        </ul>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-remove" aria-hidden="true"></i></button>
                                <h4 class="modal-title" id="myModalLabel">Устгах уу?</h4>
                            </div>
                            <div class="modal-body">
                                Сонгосон нийтлэл(үүд)ийг устгахдаа итгэлтэй байна
                                уу?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="btn-delete" name="btn-delete" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i> Итгэлтэй байна</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Цуцлах</button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <table class="table table-hover" id="datatable">
                    <thead>
                    <tr>
                        <th class="no-sort">
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </div>
                        </th>
                        <th class="sort-numeric">#</i></th>
                        <th class="sort-alpha">Гарчиг</th>
                        <th><i class="fa fa-user"></i></th>
                        <th><i class="fa fa-tag"></th>
                        <th class="sort-numeric"><i class="fa fa-comments-o"></i></th>
                        <th><i class="fa fa-calendar-plus-o"></th>
                        <th><i class="fa fa-calendar-minus-o"></th>
                        <th><i class="fa fa-calendar-check-o"></th>
                        <th><i class="fa fa-level-up"></th>
                        <th class="no-sort"><i class="fa fa-check"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($data['posts'] != 0) {foreach ($data['posts'] as $post){   ?>
                    <tr class="<?php switch ($post['visibility']) {
                        case 0: echo "danger";break;
                        case 1: echo "success";break;
                        case 2: echo "warning";break;
                    } ?>">
                        <th scope="row">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox-<?php echo $post['id']; ?>" name="posts[]" value="<?php echo $post['id']; ?>" class="table-row">
                                <label for="checkbox-<?php echo $post['id']; ?>"></label>
                            </div>
                        </th>
                        <th scope="row"><?php echo $post['id']; ?></th>
                        <td><?php echo $post['title']; ?><p><small class="text-muted"><?php echo $post['link']; ?></small></p></td>
                        <td><?php $author = $this->getUserData($post['author']); echo $author['username']; ?></td>
                        <td><?php echo $post['category']; ?></td>
                        <td><div class="label label-<?php if($post['comments_allowed']==1)echo 'success'; else echo 'danger'; ?>"><?php echo $post['comments_count']; ?></div></td>
                        <td><small><?php echo $post['created']; ?></small></td>
                        <td><small><?php echo $post['modified']; ?></small></td>
                        <td><small><?php echo $post['pubdate']; ?></small></td>
                        <td><?php echo $post['parent']; ?></td>
                        <td class="action">
                            <a href="?p=edit_post&method=edit&id=<?php echo $post['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a><br>
                            <a href="action_post.php?delete=<?php echo $post['id']; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a><br>
                            <a href="<?php echo $this->config['url'] ?>?p=blog&id=<?php echo $post['id']; ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                        </td>
                    </tr>
                    <?php } }?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include_once 'elements/js.php'; ?>
<?php include_once 'elements/js_end.php'; ?>
<?php include_once 'elements/footer.php'; ?>
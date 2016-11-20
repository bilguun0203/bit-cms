<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/css_dataTables.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <form method="post" action="action_comment.php">
                <h1>Сэтгэгдлүүд</h1>
                <hr>
                <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Харагдалт өөрчлөх <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" class="btn btn-link" name="btn-published"><i class="fa fa-check text-success"></i> Нийтлэгдсэн</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-draft"><i class="fa fa-ban text-danger"></i> Нуух</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-waiting"><i class="fa fa-hourglass-half text-warning"></i> Хүлээлгэнд</button></li>
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
                                Сонгосон сэтгэгдлийг устгахдаа итгэлтэй байна уу?
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
                        <th class="sort-numeric">#</th>
                        <th>Нийтлэгч</th>
                        <th>Байрлал</th>
                        <th>IP</th>
                        <th>Огноо</th>
                        <th class="no-sort">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if($data['comments'] != 0) {foreach ($data['comments'] as $comment){   ?>
                        <tr class="<?php switch ($comment['visibility']) {
                            case 0: echo "danger";break;
                            case 1: echo "success";break;
                            case 2: echo "warning";break;
                        } ?>">
                        <th scope="row">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox-<?php echo $comment['id']; ?>" name="comments[]" value="<?php echo $comment['id']; ?>" class="table-row">
                                <label for="checkbox-<?php echo $comment['id']; ?>"></label>
                            </div>
                        </th>
                        <th scope="row"><?php echo $comment['id']; ?></th>
                        <td><?php echo $comment['name']; ?></td>
                        <td><?php if($comment['locationT'] == "post") {
                                $parent = $this->getPostData($comment['location']);
                                if($parent != false) echo "Н-".$parent['title'];
                            } else if($comment['locationT'] == "page"){
                                $parent = $this->getPageData($comment['location']);
                                if($parent != false) echo "Х-".$parent['title'];
                            } ?></td>
                        <td><small><?php echo $comment['ip']; ?></small></td>
                        <td><small><?php echo $comment['date']; ?></small></td>
                        <td class="action">
                            <a href="?p=edit_comment&method=edit&id=<?php echo $comment['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a><br>
                            <a href="action_comment.php?delete=<?php echo $comment['id']; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a><br>
                            <a href="<?php echo $this->config['url'] ?>?p=blog&id=<?php echo $comment['id']; ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                        </td>
                    </tr>
                    <?php }} ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</div>
<?php include_once 'elements/js.php'; ?>
<?php include_once 'elements/js_end.php'; ?>
<?php include_once 'elements/footer.php'; ?>
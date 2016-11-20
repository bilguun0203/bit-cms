<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/css_dataTables.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="action_user.php">
                <h1>Хэрэглэгчид</h1>
                <hr>
                <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                    <a href="<?php echo $this->config['url']."bit-bend/?p=edit_user&method=add"; ?>" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Нэмэх</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Төлөв өөрчлөх <i class="fa fa-angle-down"></i></button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" class="btn btn-link" name="btn-allowed"><i class="fa fa-check text-success"></i> Идэвхтэй</button></li>
                            <li><button type="submit" class="btn btn-link" name="btn-blocked"><i class="fa fa-ban text-danger"></i> Идэвхгүй</button></li>
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
                                Сонгосон хэрэглэгчийг устгахдаа итгэлтэй байна уу?
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
                        <th>#</th>
                        <th>Нэр</th>
                        <th>Э-шуудан</th>
                        <th>Эрх</th>
                        <th class="no-sort">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($data['users'] != 0) {foreach ($data['users'] as $user){   ?>
                    <tr class="<?php switch ($user['status']) {
                        case 0: echo "danger";break;
                        case 1: echo "success";break;
                    } ?>">
                        <th scope="row">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox-<?php echo $user['uuid']; ?>" name="users[]" value="<?php echo $user['uuid']; ?>" class="table-row">
                                <label for="checkbox-<?php echo $user['id']; ?>"></label>
                            </div>
                        </th>
                        <td><?php echo $user['uuid']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td class="action">
                            <a href="?p=edit_user&method=edit&id=<?php echo $user['uuid']; ?>" class="action"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                            <a href="action_user.php?delete=<?php echo $user['uuid']; ?>"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                            <a href="frontend/user.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
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
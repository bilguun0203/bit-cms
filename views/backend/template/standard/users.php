<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/css_dataTables.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <h1>Хэрэглэгчид</h1>
            <hr>
            <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Нэмэх</button>
                <button type="button" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Зөвшөөрөгдсөн байдал <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-check text-success"></i> Зөвшөөрөгдсөн</a></li>
                        <li><a href="#"><i class="fa fa-ban text-danger"></i> Зөвшөөрөгдөөгүй</a></li>
                        <li><a href="#"><i class="fa fa-hourglass-half text-warning"></i> Хүлээлгэнд</a></li>
                    </ul>
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
                    <th>Нэр</th>
                    <th>Э-шуудан</th>
                    <th>Эрх</th>
                    <th class="no-sort">Үйлдэл</th>
                </tr>
                </thead>
                <tbody>
                <tr class="success">
                    <th scope="row">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="table-row">
                            <label for="checkbox1"></label>
                        </div>
                    </th>
                    <th scope="row">1</th>
                    <td>Bilguun</td>
                    <td>bilguun0203@gmail.com</td>
                    <td>100</td>
                    <td class="action">
                        <a href="edit_user.html" class="action"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/user.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                <tr class="warning">
                    <th scope="row">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="table-row">
                            <label for="checkbox1"></label>
                        </div>
                    </th>
                    <th scope="row">2</th>
                    <td>Bilguun O</td>
                    <td>bilguun_och@yahoo.com</td>
                    <td>50</td>
                    <td class="action">
                        <a href="edit_user.html" class="action"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/user.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                <tr class="danger">
                    <th scope="row">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox1" class="table-row">
                            <label for="checkbox1"></label>
                        </div>
                    </th>
                    <th scope="row">3</th>
                    <td>Bilguun Och</td>
                    <td>bil_och@gogo.mn</td>
                    <td>0</td>
                    <td class="action">
                        <a href="edit_user.html"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/user.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php include_once 'elements/js.php'; ?>
<?php include_once 'elements/js_end.php'; ?>
<?php include_once 'elements/footer.php'; ?>
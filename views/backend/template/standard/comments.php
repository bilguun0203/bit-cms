<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/css_dataTables.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <h1>Сэтгэгдлүүд</h1>
            <hr>
            <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                <button type="button" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Харагдалт өөрчлөх <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-check text-success"></i> Нийтлэгдсэн</a></li>
                        <li><a href="#"><i class="fa fa-ban text-danger"></i> Нуух</a></li>
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
                    <th>Нийтлэгч</th>
                    <th>Байрлал</th>
                    <th>Огноо</th>
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
                    <td>Be unpreparedс</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td class="action">
                        <a href="edit_page.html" class="action"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/page.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
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
                    <td>Bilguun</td>
                    <td>Accentors potusс</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td class="action">
                        <a href="edit_page.html" class="action"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/page.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
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
                    <td>Bilguun</td>
                    <td>Grogs hobble with riddleс</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td class="action">
                        <a href="edit_page.html"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a>
                        <a href="frontend/page.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                </tbody>
            </table>

            <ul class="pagination center-block">
                <li class="disabled">
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                    </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
<?php include_once 'elements/js.php'; ?>
<?php include_once 'elements/js_end.php'; ?>
<?php include_once 'elements/footer.php'; ?>
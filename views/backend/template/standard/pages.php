<?php include_once 'elements/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <h1>Хуудсууд</h1>
            <hr>
            <div class="btn-group" role="group" aria-label="Үйлдлүүд">
                <a href="edit_page.html" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Нэмэх</a>
                <button type="button" class="btn btn-danger"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-toggle-on"></i> Харагдалт өөрчлөх <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-check text-success"></i> Нийтлэгдсэн</a></li>
                        <li><a href="#"><i class="fa fa-edit text-primary"></i> Ноорог</a></li>
                        <li><a href="#"><i class="fa fa-hourglass-half text-warning"></i> Хүлээлгэнд</a></li>
                    </ul>
                </div>
                <a href="personalize.html#pageOrder" class="btn btn-info"><i class="fa fa-navicon" aria-hidden="true"></i> Хуудасны дараалал</a>
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
                    <th class="sort-alpha">Нэр</th>
                    <th>Нийтлэгч</th>
                    <th>Төрөл</th>
                    <th>Үүсгэсэн</th>
                    <th>Зассан</th>
                    <th>Нийтлэгдсэн</th>
                    <th>Эх хуудас</th>
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
                    <td>Нүүр хуудас<p><small class="text-muted">/</small></p></td>
                    <td>Bilguun</td>
                    <td>Нүүр хуудас</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td><small>2016-08-05 23:31:33</small></td>
                    <td><small>2016-08-09</small></td>
                    <td>0</td>
                    <td class="action">
                        <a href="edit_page.html"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a><br>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a><br>
                        <a href="frontend/page.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                <tr class="success">
                    <th scope="row">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox2" class="table-row">
                            <label for="checkbox2"></label>
                        </div>
                    </th>
                    <th scope="row">2</th>
                    <td>Тухай<p><small class="text-muted">about</small></p></td>
                    <td>Bilguun</td>
                    <td>Хуудас</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td><small>2016-08-05 23:31:33</small></td>
                    <td><small>2016-08-09</small></td>
                    <td>0</td>
                    <td class="action">
                        <a href="edit_page.html"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a><br>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a><br>
                        <a href="frontend/page.html" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Харах</a>
                    </td>
                </tr>
                <tr class="success">
                    <th scope="row">
                        <div class="checkbox">
                            <input type="checkbox" id="checkbox3" class="table-row">
                            <label for="checkbox3"></label>
                        </div>
                    </th>
                    <th scope="row">3</th>
                    <td>Холбоо барих<p><small class="text-muted">contact</small></p></td>
                    <td>Bilguun</td>
                    <td>Хуудас</td>
                    <td><small>2016-08-04 14:55:44</small></td>
                    <td><small>2016-08-05 23:31:33</small></td>
                    <td><small>2016-08-09</small></td>
                    <td>2</td>
                    <td class="action">
                        <a href="edit_page.html"><i class="fa fa-edit" aria-hidden="true"></i> Засах</a><br>
                        <a href="delete.html"><i class="fa fa-remove" aria-hidden="true"></i> Устгах</a><br>
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
<?php include_once 'elements/footer.php'; ?>
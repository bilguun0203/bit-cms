<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <section id="pageOrder">
                <h2>Цэсний хэлбэр</h2>
                <hr>
                <ol class="sortable">
                    <li id="list_1"><div>Нүүр хуудас</div></li>
                    <li id="list_8">
                        <div>Тухай</div>
                        <ol>
                            <li id="list_7"><div>Холбоо барих</div></li>
                        </ol>
                    </li>
                </ol>
                <button type="button" class="btn btn-primary">Хадгалах</button>
                <hr>
            </section>
        </div>
    </div>
</div>
<?php include_once 'elements/js.php'; ?>
<script src="../views/backend/template/standard/assets/js/libs/nestedSortable/jquery.mjs.nestedSortable.js"></script>
<?php include_once 'elements/js_end.php'; ?>
<script>
    $(document).ready(function(){
        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 2
        });
    });
</script>
<?php include_once 'elements/footer.php'; ?>
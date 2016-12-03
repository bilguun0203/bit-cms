<?php include_once 'elements/header.php'; ?>
<?php include_once 'elements/css.php'; ?>
<?php include_once 'elements/header_end.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <section id="pageOrder">
                <h2>Цэсний хэлбэр <i id="loading" style="display: none" class="fa fa-refresh fa-spin fa-fw"></i> <span id="loading" style="display: none" class="sr-only">Loading...</span></h2>
                <hr>
                <div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                	<strong>Санамж!</strong> Хулганаар чирж байрлалыг өөрчилнө үү.

                    <div >


                    </div>
                </div>
                <div id="orderResult"></div>
                <button type="button" id="save" class="btn btn-primary">Хадгалах</button>
                <hr>
            </section>
        </div>
    </div>
</div>
<?php include_once 'elements/js.php'; ?>
<script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/core/jquery-ui.min.js"></script>
<script src="<?php echo $this->config['file_path_bend']; ?>standard/assets/js/libs/nestedSortable/jquery.mjs.nestedSortable.js"></script>
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
<script>
    $(function () {

        $.post('<?php echo "order_page.php"; ?>', {}, function (data) {
            $('#orderResult').html(data);
        });

        $('#save').click(function(){
            var oSortable = $('.sortable').nestedSortable('toArray');

            $('#loading').fadeIn(100);
            $('#orderResult').slideUp(function () {
                console.log(oSortable);
                $.post('<?php echo "order_page.php"; ?>', { sortable: oSortable }, function (data) {
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                    $('#loading').fadeOut(100);
                });
            });

        });

    });
</script>
<?php include_once 'elements/footer.php'; ?>
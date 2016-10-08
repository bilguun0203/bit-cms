<?php include_once 'elements/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" id="settingsPanel">
                <div class="panel-heading">
                    <h3 class="panel-title">Тохиргоо</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Өнгөний сонголт</label>
                        <div class="radio radio-default">
                            <input type="radio" name="panelColor" id="default" value="default">
                            <label for="c1">
                                Default
                            </label>
                        </div>
                        <div class="radio radio-primary">
                            <input type="radio" name="panelColor" id="primary" value="primary" checked>
                            <label for="c2">
                                Primary
                            </label>
                        </div>
                        <div class="radio radio-success">
                            <input type="radio" name="panelColor" id="success" value="success">
                            <label for="c3">
                                Success
                            </label>
                        </div>
                        <div class="radio radio-warning">
                            <input type="radio" name="panelColor" id="warning" value="warning">
                            <label for="c4">
                                Warning
                            </label>
                        </div>
                        <div class="radio radio-danger">
                            <input type="radio" name="panelColor" id="danger" value="danger">
                            <label for="c5">
                                Danger
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $( "input" ).on( "click", function() {
        var val = $( "input:checked" ).val();
        $('#settingsPanel').removeClass('panel-default');
        $('#settingsPanel').removeClass('panel-primary');
        $('#settingsPanel').removeClass('panel-success');
        $('#settingsPanel').removeClass('panel-warning');
        $('#settingsPanel').removeClass('panel-danger');
        $('#settingsPanel').addClass('panel-'+val);
        document.cookie = "color="+val;
    });
</script>
<?php include_once 'elements/footer.php'; ?>
<?php include_once 'elements/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <h1>Статистик</h1>
            <hr>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <select id="selectType" name="selectType" class="form-control">
                                    <option value="all_time">Бүх</option>
                                    <option value="year">Жил</option>
                                    <option value="month">Сар</option>
                                    <option value="day">Өдөр</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-3 displayNone" id="yearDiv">
                                <select id="selectYear" name="selectYear" class="form-control">
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-3 displayNone" id="monthDiv">
                                <select id="selectMonth" name="selectYear" class="form-control">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-3 displayNone" id="ymdDiv">
                                <input type="text" class="form-control datepicker" id="ymd" name="ymd">
                            </div>
                            <div class="col-xs-6 col-sm-3 col-md-2">
                                <button type="button" class="btn btn-primary" id="showChart">Харах</button>
                            </div>
                        </div>
                    </div>
                    <div id="visitors" class="height-12" data-colors="#9C27B0"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Үйлдлийн систем</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-donut-graph1" class="height-6" data-colors="#0077C8,#2196F3,#0aa89e,#FF9800"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Интернэт хөтөч</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-donut-graph2" class="height-6" data-colors="#0077C8,#2196F3,#0aa89e,#FF9800"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-danger">
                    <div class="panel-heading"><h3 class="panel-title">Сүүлийн 100 хандалт</h3></div>
                    <div class="panel-body">
                        <table class="table table-hover" id="datatable">
                            <thead>
                            <tr>
                                <th class="sort-numeric">#</th>
                                <th>Огноо</th>
                                <th>IP Хаяг</th>
                                <th>Үйлдлийн систем</th>
                                <th>Интернэт хөтөч</th>
                                <th>Хандсан байрлал</th>
                                <th>User Agent</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="success">
                                <th scope="row">1</th>
                                <td><small>2016-08-05 23:31:33</small></td>
                                <td><i class="fa fa-map-signs"></i> 192.168.1.2</td>
                                <td><i class="fa fa-windows"></i> Windows 10</td>
                                <td><i class="fa fa-chrome"></i> Chrome 52.0</td>
                                <td><i class="fa fa-map-marker"></i> Statistics.html</td>
                                <td><i class="fa fa-user-secret"></i> Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="../views/backend/template/standard/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../views/backend/template/standard/assets/js/libs/raphael/raphael-min.js"></script>
<script src="../views/backend/template/standard/assets/js/libs/morris.js/morris.min.js"></script>
<script>
    var date = new Date();
    var month = date.getMonth();
    month++;
    if(month < 10){
        month = "0"+month;
    }
    var pubdate = date.getFullYear()+"-"+month+"-"+date.getDate();
    document.getElementById('ymd').value = pubdate;

    $("#selectAll").change(function(){
        $(".table-row").prop('checked', $(this).prop("checked"));
    });

    var chartType = "all";
    $("#selectType").change(function () {
        var type = document.getElementById("selectType").value;
        switch (type) {
            case "all_time":
                $("#yearDiv").fadeOut();
                $("#monthDiv").fadeOut();
                $("#ymdDiv").fadeOut();
                chartType = "all";
                break;
            case "year":
                $("#yearDiv").fadeIn();
                $("#monthDiv").fadeOut();
                $("#ymdDiv").fadeOut();
                chartType = "year";
                break;
            case "month":
                $("#yearDiv").fadeIn();
                $("#monthDiv").fadeIn();
                $("#ymdDiv").fadeOut();
                chartType = "month";
                break;
            case "day":
                $("#yearDiv").fadeOut();
                $("#monthDiv").fadeOut();
                $("#ymdDiv").fadeIn();
                chartType = "day";
                break;
        }
    });

    $("#showChart").click(function () {
        var chartDate;
        var chartData = [];
        switch (chartType) {
            case "all":
                chartDate = 0;
                chartData = [
                    {x: '2015-12', y: 34},
                    {x: '2016-03', y: 65},
                    {x: '2016-06', y: 43},
                    {x: '2016-09', y: 76},
                    {x: '2016-12', y: 32}
                ];
                break;
            case "year":
                chartDate = document.getElementById("selectYear").value;
                chartData = [
                    {x: '2016-01', y: 54},
                    {x: '2016-02', y: 60},
                    {x: '2016-03', y: 65},
                    {x: '2016-04', y: 54},
                    {x: '2016-05', y: 50},
                    {x: '2016-06', y: 43},
                    {x: '2016-07', y: 47},
                    {x: '2016-08', y: 55},
                    {x: '2016-09', y: 76},
                    {x: '2016-10', y: 76},
                    {x: '2016-11', y: 65},
                    {x: '2016-12', y: 32}
                ];
                break;
            case "month":
                chartDate = document.getElementById("selectYear").value + "-" + document.getElementById("selectMonth").value;
                chartData = [
                    {x: '01', y: 5},
                    {x: '02', y: 4},
                    {x: '03', y: 2},
                    {x: '04', y: 0},
                    {x: '05', y: 1},
                    {x: '06', y: 2},
                    {x: '07', y: 2},
                    {x: '08', y: 2},
                    {x: '09', y: 4},
                    {x: '10', y: 4},
                    {x: '11', y: 6},
                    {x: '12', y: 6},
                    {x: '13', y: 1},
                    {x: '14', y: 1},
                    {x: '15', y: 1},
                    {x: '16', y: 1},
                    {x: '17', y: 0},
                    {x: '18', y: 0},
                    {x: '19', y: 1},
                    {x: '20', y: 1},
                    {x: '21', y: 1},
                    {x: '22', y: 2},
                    {x: '23', y: 1},
                    {x: '24', y: 0},
                    {x: '25', y: 2},
                    {x: '26', y: 0},
                    {x: '27', y: 4},
                    {x: '28', y: 4},
                    {x: '29', y: 0},
                    {x: '30', y: 2},
                ];
                break;
            case "day":
                chartDate = document.getElementById("ymd").value;
                chartData = [
                    {x: '00:00', y: 0},
                    {x: '04:00', y: 1},
                    {x: '08:00', y: 0},
                    {x: '12:00', y: 2},
                    {x: '16:00', y: 1},
                    {x: '20:00', y: 0},
                    {x: '24:00', y: 1},
                ];
                break;
        }
//        console.log(chartData);
        var labelColor = $('#visitors').css('color');
//        var lineColors = $('#visitors').data('colors').split(',');
        Morris.Area({
            element: 'visitors',
            behaveLikeLine: true,
            data: chartData,
            xkey: 'x',
            ykeys: ['y'],
            labels: ['Y'],
            gridTextColor: labelColor,
            lineColors: $('#visitors').data('colors').split(',')
        });
//        console.log(chartData);
//        $.post('areaChart.php?data='+chartData+'&label='+labelColor+'&line='+lineColors, {}, function (data) {
//            $('#visitors').html(data);
//        });
    });

    Morris.Donut({
        element: 'morris-donut-graph1',
        data: [
            {value: 50, label: 'Windows', formatted: '50%'},
            {value: 20, label: 'Mac OS', formatted: '20%'},
            {value: 10, label: 'Linux', formatted: '10%'},
            {value: 5, label: 'Unix', formatted: '5%'},
            {value: 5, label: 'Android', formatted: '5%'},
            {value: 3, label: 'IOS', formatted: '3%'},
            {value: 2, label: 'Other', formatted: '2%'},
        ],
        colors: $('#morris-donut-graph1').data('colors').split(','),
        formatter: function (x, data) {
            return data.formatted;
        }
    });
    Morris.Donut({
        element: 'morris-donut-graph2',
        data: [
            {value: 50, label: 'Google Chrome', formatted: '50%'},
            {value: 5, label: 'Internet Explorer', formatted: '5%'},
            {value: 12, label: 'Microsoft Edge', formatted: '12%'},
            {value: 6, label: 'Opera', formatted: '6%'},
            {value: 15, label: 'Mozilla Firefox', formatted: '15%'},
            {value: 6, label: 'Safari', formatted: '6%'},
            {value: 6, label: 'Other', formatted: '6%'},
        ],
        colors: $('#morris-donut-graph2').data('colors').split(','),
        formatter: function (x, data) {
            return data.formatted;
        }
    });

    $(function () {
        $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
    });
</script>
<?php include_once 'elements/footer.php'; ?>
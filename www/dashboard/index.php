<?php
include_once('../common.php');


$_is_dashboard = true;

include_once(G5_THEME_PATH.'/head.php');
?>

<style>

#wrapper {
    background: linear-gradient(rgb(219, 228, 236) 16.51%, rgb(255, 255, 255) 80.07%) no-repeat;
}

#container_title{
    display:none;
}
</style>

<div class="dash_board">
    <div class="dash_board_box">
        <div class="dash_board_box_hd open_box">온도</div>
        <!--
        <div id="Line_Controls_Chart">
            <div id="lineChartArea" style="padding:0px 20px 0px 0px;"></div>
        
            <div id="controlsArea" style="padding:0px 20px 0px 0px;"></div>
        </div>
        -->
        <div id="dash_board_box_chart_1">

        </div>
    </div>
    <div class="dash_board_box">
        <div class="dash_board_box_hd">습도</div>
        <div id="dash_board_box_chart_2">

        </div>
    </div>
    <div class="dash_board_box">
        <div class="dash_board_box_hd">풍속1</div>
        <div id="dash_board_box_chart_3">

        </div>
    </div>
    <div class="dash_board_box">
        <div class="dash_board_box_hd">풍량</div>
        <div id="dash_board_box_chart_5">

        </div>
    </div>
    <div class="dash_board_box">
        <div class="dash_board_box_hd">압력</div>
        <div id="dash_board_box_chart_4">

        </div>
    </div>

    <div class="dash_board_box">
        <div class="dash_board_box_hd">풍속2</div>
        <div id="dash_board_box_chart_6">

        </div>
    </div>
</div>



<script>


function drawChart1() {
    var data = google.visualization.arrayToDataTable([
        ['시간', '온도', '경보 최고온도', '경보 최저온도'],
        ['17:01',  60, 80, -30],
        ['17:02',  62, 80, -30],
        ['17:03',  60, 80, -30],
        ['17:04',  -20, 80, -30],
        ['17:05',  50, 80, -30],
        ['17:06',  70, 80, -30],
        ['17:07',  80, 80, -30],
        ['17:08',  90, 80, -30],
        ['17:09',  50, 80, -30]
    ]);

    var options = {
        title: '',
        curveType: 'function',
        legend: { position: 'bottom' },
        height          : 300,
    };

    var chart = new google.visualization.LineChart(document.getElementById('dash_board_box_chart_1'));
    chart.draw(data, options);
}

function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['시간', '습도', '경보 습도'],
        ['17:01',  60, 90],
        ['17:02',  62, 90],
        ['17:03',  60, 90],
        ['17:04',  80, 90],
        ['17:05',  50, 90],
        ['17:06',  70, 90],
        ['17:07',  80, 90],
        ['17:08',  90, 90],
        ['17:09',  50, 90]
    ]);

    var options = {
        title: '',
        curveType: 'function',
        legend: { position: 'bottom' },
        height          : 300,
    };

    var chart = new google.visualization.LineChart(document.getElementById('dash_board_box_chart_2'));
    chart.draw(data, options);
}

function drawChart3() {
    var data = google.visualization.arrayToDataTable([
        ['시간', '풍속1', '경보 풍속'],
        ['17:01',  10, 15],
        ['17:02',  9, 15],
        ['17:03',  9, 15],
        ['17:04',  10, 15],
        ['17:05',  12, 15],
        ['17:06',  10, 15],
        ['17:07',  7, 15],
        ['17:08',  5, 15],
        ['17:09',  10, 15]
    ]);

    var options = {
        title: '',
        curveType: 'function',
        legend: { position: 'bottom' },
        height          : 300,

    };

    var chart = new google.visualization.LineChart(document.getElementById('dash_board_box_chart_3'));
    chart.draw(data, options);
}


function drawChart5() {
    var data = google.visualization.arrayToDataTable([
        ['시간', '풍량'],
        ['17:01',  10],
        ['17:02',  9],
        ['17:03',  9],
        ['17:04',  10],
        ['17:05',  12],
        ['17:06',  10],
        ['17:07',  7],
        ['17:08',  5],
        ['17:09',  10]
    ]);

    var options = {
        title: '',
        curveType: 'function',
        legend: { position: 'bottom' },
        height          : 300,

    };

    var chart = new google.visualization.AreaChart(document.getElementById('dash_board_box_chart_5'));
    chart.draw(data, options);
}

function drawChart6() {
    var data = google.visualization.arrayToDataTable([
        ['시간', '풍속2', '경보 풍속'],
        ['17:01',  10, 15],
        ['17:02',  9, 15],
        ['17:03',  9, 15],
        ['17:04',  10, 15],
        ['17:05',  12, 15],
        ['17:06',  10, 15],
        ['17:07',  7, 15],
        ['17:08',  5, 15],
        ['17:09',  10, 15]
    ]);

    var options = {
        title: '',
        curveType: 'function',
        legend: { position: 'bottom' },
        height          : 300,

    };

    var chart = new google.visualization.LineChart(document.getElementById('dash_board_box_chart_6'));
    chart.draw(data, options);
}

function drawChart4() {
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['압력',  5]
    ]);

    var options = {
        title: '',
        minorTicks: 1,
        height          : 300,
        width:300,
        redFrom: 10, 
        redTo: 12,
        yellowFrom:8, 
        yellowTo: 10,
        max:15
    };

    var chart = new google.visualization.Gauge(document.getElementById('dash_board_box_chart_4'));
    chart.draw(data, options);

    setInterval(function() {
        data.setValue(0, 1, Math.round(10 * Math.random()));
        chart.draw(data, options);
    }, 3000);
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart1);
google.charts.setOnLoadCallback(drawChart2);
google.charts.setOnLoadCallback(drawChart3);
google.charts.setOnLoadCallback(drawChart6);
google.charts.setOnLoadCallback(drawChart5);

google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawChart4);
 /*
  var chartDrowFun = {
 
    chartDrow : function(){
        var chartData = '';
 
        //날짜형식 변경하고 싶으시면 이 부분 수정하세요.
        var chartDateformat     = 'yyyy년MM월dd일';
        //라인차트의 라인 수
        var chartLineCount    = 10;
        //컨트롤러 바 차트의 라인 수
        var controlLineCount    = 10;
 
 
        function drawDashboard() {
 
          var data = new google.visualization.DataTable();
          //그래프에 표시할 컬럼 추가
          data.addColumn('datetime' , '날짜');
          data.addColumn('number'   , '남성');
          data.addColumn('number'   , '여성');
          data.addColumn('number'   , '전체');
 
          //그래프에 표시할 데이터
          var dataRow = [];
 
          for(var i = 0; i <= 29; i++){ //랜덤 데이터 생성
            var total   = Math.floor(Math.random() * 300) + 1;
            var man     = Math.floor(Math.random() * total) + 1;
            var woman   = total - man;
 
            dataRow = [new Date('2017', '09', i , '10'), man, woman , total];
            data.addRow(dataRow);
          }
 
 
            var chart = new google.visualization.ChartWrapper({
              chartType   : 'LineChart',
              containerId : 'lineChartArea', //라인 차트 생성할 영역
              options     : {
                isStacked   : 'percent',
                focusTarget : 'category',
                height          : 300,
                width           : '100%',
                legend          : { position: "top", textStyle: ""},
                pointSize       : 5,
                tooltip         : "", 
                showColorCode : true,
                trigger: 'both',
                hAxis : "",
                months: "",
                days  : "",
                hours : "",
                textStyle: "",
                vAxis: "",
                gridlines: "",
                textStyle: "",
                animation        : "",
                annotations    : ""       
              }
            });
 
            var control = new google.visualization.ControlWrapper({
              controlType: 'ChartRangeFilter',
              containerId: 'controlsArea',  //control bar를 생성할 영역
              options: {
                  ui:{
                        chartType: 'LineChart',
                        chartOptions: {
                        chartArea: {'width': '60%','height' : 80},
                          hAxis: {'baselineColor': 'none', format: chartDateformat, textStyle: "",
                            gridlines:"",
                                  months: "",
                                  days  : "",
                                  hours : ""}
                        }
                  },
                    filterColumnIndex: 0
                }
            });
 
            var date_formatter = new google.visualization.DateFormat({ pattern: chartDateformat});
            date_formatter.format(data, 0);
 
            var dashboard = new google.visualization.Dashboard(document.getElementById('Line_Controls_Chart'));
            window.addEventListener('resize', function() { dashboard.draw(data); }, false); //화면 크기에 따라 그래프 크기 변경
            dashboard.bind([control], [chart]);
            dashboard.draw(data);
 
        }
          google.charts.setOnLoadCallback(drawDashboard);
 
      }
    }
 
    $(document).ready(function(){
    google.charts.load('current', {'packages':['line','controls']});
    chartDrowFun.chartDrow(); //chartDrow() 실행
    });
*/
</script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
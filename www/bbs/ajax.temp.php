<?php
include_once('./_common.php');

?>

<div class="ajax_pop_up">
    <h1 class="ajax_pop_up_title">TEMP. CONTROL</h1>
    <div class="ajax_pop_up_temp_box">
        <span class="material-icons">device_thermostat</span>
        <span>50.5&#8451;</span>
    </div>

    <div class="ajax_pop_up_control_box">
        <div class="ajax_pop_up_control_box_row">
            <div class="ajax_pop_up_control_box_1">
                <div class="ajax_pop_up_control_box_1_1">
                    <span class="material-icons">mode_fan_off</span>
                    <span>팬 속도</span>
                </div>
                <div class="ajax_pop_up_control_box_1_2">
                    <button type="button" class=""><span class="material-icons">remove</span></button>
                    <div class="ajax_pop_up_control_box_1_2_input">
                        <span>37</span>
                    </div>
                    <button type="button" class=""><span class="material-icons">add</span></button>
                </div>
            </div>
        </div>
        <div class="ajax_pop_up_control_box_row">
            <div class="ajax_pop_up_control_box_1">
                <div class="ajax_pop_up_control_box_1_1">
                <span class="material-icons">error</span>
                    <span>경보 설정</span>
                </div>
                <div class="ajax_pop_up_control_box_1_2">
                    <button type="button" class=""><span class="material-icons">remove</span></button>
                    <div class="ajax_pop_up_control_box_1_2_input">
                        <span>80</span>
                    </div>
                    <button type="button" class=""><span class="material-icons">add</span></button>
                </div>
            </div>
        </div>
        <div class="ajax_pop_up_control_box_row">
            <div class="ajax_pop_up_control_box_1">
                <div class="ajax_pop_up_control_box_1_1">
                <span class="material-icons">notifications_active</span>
                    <span>알람 설정</span>
                </div>
                <div class="ajax_pop_up_control_box_1_2">
                    <button type="button" class=""><span class="material-icons">remove</span></button>
                    <div class="ajax_pop_up_control_box_1_2_input">
                        <span>100</span>
                    </div>
                    <button type="button" class=""><span class="material-icons">add</span></button>
                </div>
            </div>
        </div>
        <div class="ajax_pop_up_control_box_row">
            <button type="button" class="save_btn">저장</button>
        </div>
    </div>

    <div id="ajax_pop_up_box_chart_1">

    </div>
</div>

<script>
function pop_drawChart1() {
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

    var chart = new google.visualization.LineChart(document.getElementById('ajax_pop_up_box_chart_1'));
    chart.draw(data, options);
}

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(pop_drawChart1);

</script>
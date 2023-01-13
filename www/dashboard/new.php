<?php
include_once('../common.php');

include_once(G5_THEME_PATH.'/head.php');


$result = sql_query("select * from g5_info");

$info = array();

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $info[$row["gr_id"]] = $row;
}

?>

<style>
#hd_wrapper, #aside{display:none}
#container{margin:0}
#wrapper{padding:0}
</style>
<script src="/js/gauge.min.js"></script>


<style>
.col-xl-4{
    padding:0;
    height: calc(50% - 10px);
    flex: 0 0 calc(33% - 8px);
}

.col-xl-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 calc(25% - 15px);
    max-width: 25%;
    padding: 0;
    height: calc(50% - 10px);
}

.card{
    height: 100%;margin: 0;
}

.card .card-header{
    border-bottom: 1px solid rgba(26, 54, 126, 0.125)
}

.card-header.card-header-tab .card-header-title{grid-gap: 5px;    justify-content: center;}

.card .card-block {
    padding: 1.25rem;
    height: 100%;
    overflow: hidden;
}

@media ( min-height: 1040px ) {
    .widget-numbers{font-size:11vh}
}
</style>

<div class="dash_board">
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">thermostat</span> 온도 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_1">0</font><sup>&#8451;</sup></span></div>
                <canvas id="temp-chart" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">opacity</span> 습도 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_2">0</font><sup>%</sup></span></div>
                <canvas id="temp-chart2" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">wind_power</span> 풍속 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_3">0</font><sup>m/sec</sup></span></div>
                <canvas id="temp-chart3" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">air</span> 풍량 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_4">0</font><sup>m³/sec</sup></span></div>
                <canvas id="temp-chart4" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">speed</span> 팬속도 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_5">0</font><sup>RPM</sup></span></div>
                <canvas id="temp-chart5" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-4">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><span class="material-icons">compress</span> 차압 </div>
            </div>
            <div class="card-block">
                <div class="widget-numbers"><span style="color:#007bff"><font id="ga_6">0</font><sup>Pa</sup></span></div>
                <canvas id="temp-chart6" class="" style="width:100%"></canvas>
            </div>
        </div>
    </div>
</div>

<script>

var opts = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[1]["gr_alarm_min"]?>, <?=$info[1]["gr_alert_min"]?>, <?=$info[1]["gr_alert_max"]?>, <?=$info[1]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
    {strokeStyle: "#dc3545", min: -20, max: <?=$info[1]["gr_alarm_min"]?>}, // Red from 100 to 130
    {strokeStyle: "#ffc107", min: <?=$info[1]["gr_alarm_min"]?>, max: <?=$info[1]["gr_alert_min"]?>}, // Yellow
    {strokeStyle: "#007bff", min: <?=$info[1]["gr_alert_min"]?>, max: <?=$info[1]["gr_alert_max"]?>}, // Green
    {strokeStyle: "#ffc107", min: <?=$info[1]["gr_alert_max"]?>, max: <?=$info[1]["gr_alarm_max"]?>}, // Yellow
    {strokeStyle: "#dc3545", min: <?=$info[1]["gr_alarm_max"]?>, max: 80}  // Red
    ],
  
};
var target = document.getElementById('temp-chart'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 80; // set max gauge value
gauge.setMinValue(-20);  // Prefer setter over gauge.minValue = 0
gauge.animationSpeed = 32; // set animation speed (32 is default value)
gauge.set(0); // set actual value


var opts2 = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[2]["gr_alarm_min"]?>, <?=$info[2]["gr_alert_min"]?>, <?=$info[2]["gr_alert_max"]?>, <?=$info[2]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
    {strokeStyle: "#dc3545", min: 0, max: <?=$info[2]["gr_alarm_min"]?>}, // Red from 100 to 130
    {strokeStyle: "#ffc107", min: <?=$info[2]["gr_alarm_min"]?>, max: <?=$info[2]["gr_alert_min"]?>}, // Yellow
    {strokeStyle: "#007bff", min: <?=$info[2]["gr_alert_min"]?>, max: <?=$info[2]["gr_alert_max"]?>}, // Green
    {strokeStyle: "#ffc107", min: <?=$info[2]["gr_alert_max"]?>, max: <?=$info[2]["gr_alarm_max"]?>}, // Yellow
    {strokeStyle: "#dc3545", min: <?=$info[2]["gr_alarm_max"]?>, max: 100}  // Red
    ],
  
};
var target2 = document.getElementById('temp-chart2'); // your canvas element
var gauge2 = new Gauge(target2).setOptions(opts2); // create sexy gauge!
gauge2.maxValue = 100; // set max gauge value
gauge2.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge2.animationSpeed = 32; // set animation speed (32 is default value)
gauge2.set(0); // set actual value


var opts3 = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[3]["gr_alarm_min"]?>, <?=$info[3]["gr_alert_min"]?>, <?=$info[3]["gr_alert_max"]?>, <?=$info[3]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
   {strokeStyle: "#dc3545", min: 0, max: <?=$info[3]["gr_alarm_min"]?>}, // Red from 100 to 130
   {strokeStyle: "#ffc107", min: <?=$info[3]["gr_alarm_min"]?>, max: <?=$info[3]["gr_alert_min"]?>}, // Yellow
   {strokeStyle: "#007bff", min: <?=$info[3]["gr_alert_min"]?>, max: <?=$info[3]["gr_alert_max"]?>}, // Green
   {strokeStyle: "#ffc107", min: <?=$info[3]["gr_alert_max"]?>, max: <?=$info[3]["gr_alarm_max"]?>}, // Yellow
   {strokeStyle: "#dc3545", min: <?=$info[3]["gr_alarm_max"]?>, max: 30}  // Red
],
  
};
var target3 = document.getElementById('temp-chart3'); // your canvas element
var gauge3 = new Gauge(target3).setOptions(opts3); // create sexy gauge!
gauge3.maxValue = 30; // set max gauge value
gauge3.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge3.animationSpeed = 32; // set animation speed (32 is default value)
gauge3.set(0); // set actual value


var opts4 = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[4]["gr_alarm_min"]?>, <?=$info[4]["gr_alert_min"]?>, <?=$info[4]["gr_alert_max"]?>, <?=$info[4]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
   {strokeStyle: "#dc3545", min: 0, max: <?=$info[4]["gr_alarm_min"]?>}, // Red from 100 to 130
   {strokeStyle: "#ffc107", min: <?=$info[4]["gr_alarm_min"]?>, max: <?=$info[4]["gr_alert_min"]?>}, // Yellow
   {strokeStyle: "#007bff", min: <?=$info[4]["gr_alert_min"]?>, max: <?=$info[4]["gr_alert_max"]?>}, // Green
   {strokeStyle: "#ffc107", min: <?=$info[4]["gr_alert_max"]?>, max: <?=$info[4]["gr_alarm_max"]?>}, // Yellow
   {strokeStyle: "#dc3545", min: <?=$info[4]["gr_alarm_max"]?>, max: 999}  // Red
],
  
};
var target4 = document.getElementById('temp-chart4'); // your canvas element
var gauge4 = new Gauge(target4).setOptions(opts4); // create sexy gauge!
gauge4.maxValue = 999; // set max gauge value
gauge4.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge4.animationSpeed = 32; // set animation speed (32 is default value)
gauge4.set(0); // set actual value


var opts5 = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[5]["gr_alarm_min"]?>, <?=$info[5]["gr_alert_min"]?>, <?=$info[5]["gr_alert_max"]?>, <?=$info[5]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
   {strokeStyle: "#dc3545", min: 0, max: <?=$info[5]["gr_alarm_min"]?>}, // Red from 100 to 130
   {strokeStyle: "#ffc107", min: <?=$info[5]["gr_alarm_min"]?>, max: <?=$info[5]["gr_alert_min"]?>}, // Yellow
   {strokeStyle: "#007bff", min: <?=$info[5]["gr_alert_min"]?>, max: <?=$info[5]["gr_alert_max"]?>}, // Green
   {strokeStyle: "#ffc107", min: <?=$info[5]["gr_alert_max"]?>, max: <?=$info[5]["gr_alarm_max"]?>}, // Yellow
   {strokeStyle: "#dc3545", min: <?=$info[5]["gr_alarm_max"]?>, max: 800}  // Red
],
  
};
var target5 = document.getElementById('temp-chart5'); // your canvas element
var gauge5 = new Gauge(target5).setOptions(opts5); // create sexy gauge!
gauge5.maxValue = 800; // set max gauge value
gauge5.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge5.animationSpeed = 32; // set animation speed (32 is default value)
gauge5.set(0); // set actual value


var opts6 = {
  angle: 0, // The span of the gauge arc
  lineWidth: 0.44, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
    length: 0.6, // // Relative to gauge radius
    strokeWidth: 0.035, // The thickness
    color: '#343a40' // Fill color
  },
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  staticLabels: {
    font: "16px Pretendard",  // Specifies font
    labels: [<?=$info[6]["gr_alarm_min"]?>, <?=$info[6]["gr_alert_min"]?>, <?=$info[6]["gr_alert_max"]?>, <?=$info[6]["gr_alarm_max"]?>],  // Print labels at these values
    color: "#000000",  // Optional: Label text color
    fractionDigits: 0  // Optional: Numerical precision. 0=round off.
    },

    staticZones: [
   {strokeStyle: "#dc3545", min: -250, max: <?=$info[6]["gr_alarm_min"]?>}, // Red from 100 to 130
   {strokeStyle: "#ffc107", min: <?=$info[6]["gr_alarm_min"]?>, max: <?=$info[6]["gr_alert_min"]?>}, // Yellow
   {strokeStyle: "#007bff", min: <?=$info[6]["gr_alert_min"]?>, max: <?=$info[6]["gr_alert_max"]?>}, // Green
   {strokeStyle: "#ffc107", min: <?=$info[6]["gr_alert_max"]?>, max: <?=$info[6]["gr_alarm_max"]?>}, // Yellow
   {strokeStyle: "#dc3545", min: <?=$info[6]["gr_alarm_max"]?>, max: 250}  // Red
],
  
};
var target6 = document.getElementById('temp-chart6'); // your canvas element
var gauge6 = new Gauge(target6).setOptions(opts6); // create sexy gauge!
gauge6.maxValue = 250; // set max gauge value
gauge6.setMinValue(-250);  // Prefer setter over gauge.minValue = 0
gauge6.animationSpeed = 32; // set animation speed (32 is default value)
gauge6.set(0); // set actual value



$(function() {

    timer = setInterval( function () {

        $.ajax ({
            "url" : "/bbs/ajax.data.php",
            cache : false,
            dataType: "json",
            success : function (data) {
                gauge.set(data.val1);
                $("#ga_1").text(data.val1);

                gauge2.set(data.val2);
                $("#ga_2").text(data.val2);

                gauge3.set(data.val3);
                $("#ga_3").text(data.val3);

                gauge4.set(data.val4);
                $("#ga_4").text(data.val4);

                gauge5.set(data.val5);
                $("#ga_5").text(data.val5);

                gauge6.set(data.val6);
                $("#ga_6").text(data.val6);
            }
        });

    }, 1000);

});

</script>


<?php
include_once(G5_THEME_PATH.'/tail.php');
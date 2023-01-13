<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

require_once('Util.php');

$datetime = $_REQUEST['datetime'];
if($datetime != '') {
    $thisDate = date('Y-m-d', strtotime($datetime));
} else {
    $thisDate = date('Y-m-d');
}

$thisDateArray = explode('-', $thisDate);
$startYoil = Util::getStartDayToWeek(date('Y-m-d', strtotime($thisDate)), 'number');
$endYoil = Util::getEndDayToWeek(date('Y-m-d', strtotime($thisDate)), 'number');

$thisCalendarStartDate = date('Y-m-d', strtotime(date('Y-m-01', strtotime($thisDate)) . '-'. $startYoil .' days'));
$nextCalendarStartDate = date('Y-m-d', strtotime(date('Y-m-t', strtotime($thisDate)) . '+' . (7-$endYoil) . ' days'));

$diff = Util::dateDiff($calendarStartDate, $calendarEndDate, 'days');

$sql = <<<EOF
SELECT wr_id, date_format(wr_1, '%Y-%m-%d') as planStart, date_format(wr_2, '%Y-%m-%d') as planEnd, date_format(wr_1, '%H:%i') as startTime, date_format(wr_2, '%H:%i') as endTime, wr_1, wr_subject, wr_content, ca_name, wr_3
FROM {$write_table} 
WHERE (wr_1 between "$thisCalendarStartDate 00:00:00" AND "$nextCalendarStartDate 00:00:00") OR (wr_2 between "$thisCalendarStartDate 00:00:00" AND "$nextCalendarStartDate 00:00:00")
GROUP BY date_format(wr_1, '%Y-%m-%d'), wr_id
ORDER BY wr_1 ASC;
EOF;

$result = sql_query($sql);
$i = 0;
while ($row = sql_fetch_array($result)) {
    $dateData[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    $i++;
}
$dateHash = Util::arrayToHash($dateData, 'planStart', 'planEnd', 'date');


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$_listVideoPopup = true;
?>
<div class="public--wrap">
<!-- <div class="bo_calendar" style="width: ?php echo $width ? "> -->
<!-- SJM 221101 add public--where -->
<div class="public--where">
    <div class="public--where-before">
        <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
    </div>
    <div class="public--where-now">
        <a href="">편성표</a>
    </div>
</div>
<div class="calendar--title">
    <div class="calendar--title-text01">편성표</div>
    <div class="calendar--title-text02">채널 링크3.0 방송편성시간을 확인해보세요.</div>
</div>
<div class="calendar--colorExp">
    <div class="calendar--colorExpWrap">
        <div class="calendar--colorExp-item calendar--colorExp-item-a"><span></span><p>똑똑 위클리</p></div>
        <div class="calendar--colorExp-item calendar--colorExp-item-b"><span></span><p>링크 컴퍼니</p></div>
        <div class="calendar--colorExp-item calendar--colorExp-item-c"><span></span><p>링크 어워드</p></div>
    </div>
</div>
<div class="bo_calendar">
    <form>
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="sw" value="">


        <?php if ($list_href || $is_checkbox || $write_href) { ?>
            <div class="bo_fx floatR">
                <?php if ($list_href || $write_href) { ?>
                <ul class="btn_bo_user">
                    <?php if ($admin_href) { ?><li class="floatL"><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
                    <?php if ($rss_href) { ?><li class="floatL"><a href="<?php echo $rss_href ?>" class="btn_b01 btn" title="RSS"><i class="fa fa-rss" aria-hidden="true"></i><span class="sound_only">RSS</span></a></li><?php } ?>
                    <?php if ($write_href) { ?><li class="floatL"><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a></li><?php } ?>
                </ul>	
                <?php } ?>
            </div>
        <?php } ?>
        <div class="move_calendar_box">
            <div class="move_calendar">
                <div class="move_calendar_button month"><?php echo ltrim($thisDateArray[0]) . '년 ' . ltrim($thisDateArray[1], '0') . '월' ?></div>
                <div class="move_calendar_button_dayMove">
                    <div class="move_calendar_button"><a href="<?php echo get_pretty_url($bo_table, '', 'datetime=' . date('Y-m-d', strtotime($thisDate . 'first day of - 1 months'))) ?>"><span class="material-symbols-outlined">chevron_left</span></a></div>
                    <div class="move_calendar_button goToStart"><a href="/bbs/board.php?bo_table=calender">오늘</a></div>
                    <div class="move_calendar_button"><a href="<?php echo get_pretty_url($bo_table, '', 'datetime=' . date('Y-m-d', strtotime($thisDate . 'first day of + 1 months')))  ?>"><span class="material-symbols-outlined">chevron_right</span></a></div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <?php
                    $yoil = Util::getDateToWeekTextArray();
                    foreach($yoil as $key => $var) {
                        $text = '<th class=" ';
                        if($key == 0) {
                            $text .= 'red">';
                        } elseif($key == 6) {
                            $text .= 'blue">';
                        } else {
                            $text .= 'black">';
                        }
                        $text .= $var . '</th>';

                        echo $text;
                    }
                ?>
            </thead>
            <tbody>
                <?php
                    $dateArray = Util::dateDiffArray($thisCalendarStartDate, $nextCalendarStartDate);

                    

                    foreach($dateArray as $key => $var) {
                        if($var->format('w') % 7 == 0) {
                            echo '<tr class="">';
                        }

                        if($var->format('w') == 0) {
                            $color = 'red';
                        } elseif($var->format('w') == 6) {
                            $color = 'blue';
                        } else {
                            $color = 'black';
                        }

                        if($thisDateArray[1] > $var->format('m')) {
                            echo '<td class = "calendar_td beforeMonth">';
                        } elseif($thisDateArray[1] < $var->format('m')) {
                            echo '<td class = "calendar_td afterMonth">';
                        } else {
                            echo '<td class = "calendar_td">';
                        }
                        echo '<a><span class="';
                        if($thisDate == $var->format('Y-m-d') && $thisDate == date('Y-m-d')) echo 'thisDate ';
                        echo $color . '">' . ltrim($var->format('d'), '0') . '</span></a>';

                        if(isset($dateHash[$var->format('Y-m-d')]) != false) {
                            //echo '<div class="calendar_menu">' . count($dateHash[$var->format('Y-m-d')]) . '개의 일정</div>';
                            foreach($dateHash[$var->format('Y-m-d')] as $key2 => $var2) {
                                $class_name = "";
                                
                                $vi_id = "";

                                if($var2["wr_3"] != "")
                                {
                                    $vi_url = $var2["wr_3"];
                                    $vi_url = explode("/", $vi_url);
                                    $vi_id = array_pop($vi_url);
                                }
                                
                                // 221104 성재민 조건값 교체
                                if($var2['ca_name'] == "티저영상"){
                                    $class_name = "bg_0";
                                }else if($var2['ca_name'] == "똑똑 위클리"){
                                    $class_name = "bg_1";
                                }else if($var2['ca_name'] == "링크 어워드"){
                                    $class_name = "bg_2";
                                }else if($var2['ca_name'] == "링크 컴퍼니"){
                                    $class_name = "bg_3";
                                }

                                // calendar_menu요소 안에 자식요소p를 만들었습니다.221101 성재민
                                echo '<div class="calendar_menu '.$class_name.'" data-vi_id="'.$vi_id.'"><p>' . $var2['wr_subject'] . '</p></div>';
                            }
                            echo '<div class="plan_box">';
                            echo '<div class="plan_title">';
                            echo '<p>' . $var->format('Y년 m월 d일') . '</p>';
                            echo '</div>';
                            echo '<table class="plan_table">';
                            echo '<colgroup>';
//                            echo '<col width="100px">';
                            echo '<col width="150px">';
                            echo '<col width="*">';
                            echo '</colgroup>';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<td>시간</td>';
                            echo '<td>일정제목</td>';
//                            echo '<td>일정내용</td>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach($dateHash[$var->format('Y-m-d')] as $key2 => $var2) {
                                  echo '<tr>';
                                  if($var2['planStart'] != $var2['planEnd']) {
                                      echo '<td>' . $var2['planStart'] . ' ' . $var2['startTime'] . ' (' . Util::getStartDayToWeek($var2['planStart'], 'text') . ')' . '<br> ~ <br>' . $var2['planEnd'] . ' ' . $var2['endTime'] . ' (' . Util::getStartDayToWeek($var2['planEnd'], 'text') . ')</td>';
                                  } else {
                                      echo '<td>' . $var2['startTime'] . ' ~ ' . $var2['endTime'] . '</td>';
                                  }
                                  echo '<td><a href="' . $var2["href"] . '"><p class="floatL">' . $var2['wr_subject'] . '</p></a></td>';
//                                  echo '<td><p>' . $var2['wr_content'] . '</p></td>';
                                  echo '</tr>';
//                                echo '<li class="more_text">';
//                                echo '<p>';
//                                echo '<span>' . $var2['startTime'] . ' ~ ' . $var2['endTime'] . '</span>';
//                                echo '<span><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
//                                echo '</p>';
//                                echo '<div class="plan_text_list">';
//                                echo '<p class="title_head">제목</p><p class="title_body">' . $var2['wr_subject'] . '</p>';
//                                echo '<p class="content_head">일정</p><p class="content_body">' . $var2['wr_content'] . '</p>';
//                                echo '</div>';
////                                echo '<a href="'. $var2["href"] .'">' . $var2['time'] . ' : ' . $var2['wr_subject'] . '</a>';
//                                echo '</li>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        }

                        echo '</td>';

                        if(($var->format('w') + 1) % 7 == 0) {
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>

        </table>

        <div class="popup">
            

        </div>
    </form>

</div>
</div><!-- public--wrap -->
<script>
    $(function() {
        $(document).click(function (e){
            
            if(!($(e.target).closest('.plan_box').length > 0) && !(e.target.className.indexOf('calendar_menu') > -1 )) {
                $(".plan_box").removeClass('active');
            }
        })

        $(".calendar_menu").click(function(e) {
            
            if(g5_is_admin)
            {
                $(".plan_box").removeClass('active');
                if($(this).siblings('.plan_box').hasClass('active') != true) {
                    $(this).siblings('.plan_box').addClass('active');
                    console.log('add active')
                } else {
                    $(this).siblings('.plan_box').removeClass('active');
                    console.log("remove active")
                }
            }else{
                var vi_id = $(this).data("vi_id");
                if(vi_id == "")
                {
                    // alert("준비중 입니다.");
                    var setTimeTimer = 2000;
                    var setTime = setTimeout(toastPopupClose,setTimeTimer)
                    function toastPopupClose(){
                        $(".header--ToastPopup").removeClass("active")
                    }

                    $(".header--ToastPopup").addClass("active")
                    clearTimeout(setTime)
                    setTime = setTimeout(toastPopupClose,setTimeTimer)
                }else{
                    $("#listVideoPopup_video").attr("src", "https://www.youtube.com/embed/"+vi_id + "?enablejsapi=1&version=3&playerapiid=ytplayer");            
                    $("#listVideoPopup").addClass('show');
                }
            }
            e.stopPropagation();
            // calendar_menu요소에 p자식요소를 추가하여 이벤트버블링을 방지합니다.221101 성재민
        });

        $(".list--videoPopup-bg").click(function(){
            $("#listVideoPopup").removeClass('show')
            $("#listVideoPopup_video")[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
        })

        $(".more_text").click(function() {
            if($(this).find(".plan_text_list").hasClass("active") == false) {
                $(".plan_text_list").removeClass('active');
                $(this).find(".plan_text_list").addClass('active');
            } else {
                $(".plan_text_list").removeClass('active');
            }
        })
    });

</script>
<script>
    // 221101 성재민
    // 헤더의 편성표 메뉴에 불이 들어오기 위해 이 펑션을 추가합니다.
    setTimeout(() => { $(".headerComponent").attr("data-visit","6") }, (50));
</script>


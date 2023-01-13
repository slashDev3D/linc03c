<?
include_once('./_common.php');


$data_sub = "show";


include_once(G5_PATH.'/head2.php');


$sop = "and";
$stx = strip_tags($stx);
$stx = get_search_string($stx); // 특수문자 제거

$list_member = array();

$total_count = 0;

if ($stx) {
    $stx = preg_replace('/\//', '\/', trim($stx));

    $s = explode(' ', strip_tags($stx));

    if( count($s) > 1 ){
        $s = array_slice($s, 0, 2);
        $stx = implode(' ', $s);
    }

    $text_stx = get_text(stripslashes($stx));

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $sfl = "mb_nick||mb_1||mb_2";
    $field = explode('||', trim($sfl));

    $str = '(';
    for ($i=0; $i<count($s); $i++) {
        if (trim($s[$i]) == '') continue;

        $search_str = $s[$i];

        // 인기검색어
        insert_popular($field, $search_str);

        $str .= $op1;
        $str .= "(";

        $op2 = '';
        // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        for ($k=0; $k<count($field); $k++) {
            $str .= $op2;
            switch ($field[$k]) {
                case 'mb_id' :
                case 'wr_name' :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                case 'mb_nick' :
                case 'mb_1' :
                case 'mb_2' :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER({$field[$k]}), LOWER('{$search_str}'))";
                    else
                        $str .= "INSTR({$field[$k]}, '{$search_str}')";
                    break;
                default :
                    $str .= "1=0"; // 항상 거짓
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " {$sop} ";
    }
    $str .= ")";

    $sql_search = $str;

    $sql = " select * from g5_member where {$sql_search} and mb_level = '3' order by mb_no asc limit 12";
    if(!$is_admin)
    {

        $sql = " select * from g5_member where {$sql_search} and mb_level = '3' and mb_id not in('test','test2','monq') order by mb_no asc limit 12";

    }
    $result = sql_query($sql);

    $sql = " select count(*) as cnt from g5_member where {$sql_search} and mb_level = '3' ";
    if(!$is_admin)
    {
        $sql = " select count(*) as cnt from g5_member where {$sql_search} and mb_level = '3' and mb_id not in('test','test2','monq') ";
    }

    $count = sql_fetch($sql);
    if($count['cnt'])
    {
        $total_count += $count['cnt'];
    }



    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list_member[$i] = $row;
    }
    sql_free_result($result);


    // 검색필드를 구분자로 나눈다. 여기서는 +
    $op1 = "";
    $op2 = "";
    $sfl = "a.vi_title||a.vi_content";
    $field = explode('||', trim($sfl));

    $str = '(';
    for ($i=0; $i<count($s); $i++) {
        if (trim($s[$i]) == '') continue;

        $search_str = $s[$i];

        $str .= $op1;
        $str .= "(";

        $op2 = '';
        // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        for ($k=0; $k<count($field); $k++) {
            $str .= $op2;
            switch ($field[$k]) {
                case 'mb_id' :
                case 'wr_name' :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                case 'a.vi_title' :
                case 'a.vi_content' :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER({$field[$k]}), LOWER('{$search_str}'))";
                    else
                        $str .= "INSTR({$field[$k]}, '{$search_str}')";
                    break;
                default :
                    $str .= "1=0"; // 항상 거짓
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " {$sop} ";
    }
    $str .= ")";

    $sql_search = $str;

    $sql = " select a.*, b.* from g5_video a left outer join g5_member b on a.mb_id = b.mb_id where {$sql_search} and a.vi_open = '1' order by a.vi_id desc limit 12";

    if(!$is_admin)
    {
        $sql = " select a.*, b.* from g5_video a left outer join g5_member b on a.mb_id = b.mb_id where {$sql_search} and a.vi_open = '1' and a.mb_id not in('test','test2','monq') order by a.vi_id desc limit 12";
    }

    $result = sql_query($sql);

    $sql = " select count(*) as cnt from g5_video a where {$sql_search} and a.vi_open = '1' ";

    if(!$is_admin)
    {
        $sql = " select count(*) as cnt from g5_video a where {$sql_search} and a.vi_open = '1' and a.mb_id not in('test','test2','monq') ";
    }

    $count = sql_fetch($sql);
    if($count['cnt'])
    {
        $total_count += $count['cnt'];
    }

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list_video[$i] = $row;
    }

    sql_free_result($result);


    // 검색필드를 구분자로 나눈다. 여기서는 +
    $op1 = "";
    $op2 = "";
    $sfl = "wr_subject||wr_content";
    $field = explode('||', trim($sfl));

    $str = '(';
    for ($i=0; $i<count($s); $i++) {
        if (trim($s[$i]) == '') continue;

        $search_str = $s[$i];

        $str .= $op1;
        $str .= "(";

        $op2 = '';
        // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        for ($k=0; $k<count($field); $k++) {
            $str .= $op2;
            switch ($field[$k]) {
                case 'mb_id' :
                case 'wr_name' :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                case 'wr_subject' :
                case 'wr_content' :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER({$field[$k]}), LOWER('{$search_str}'))";
                    else
                        $str .= "INSTR({$field[$k]}, '{$search_str}')";
                    break;
                default :
                    $str .= "1=0"; // 항상 거짓
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " {$sop} ";
    }
    $str .= ")";

    $sql_search = $str;

    $sql = " select * from g5_write_biz_news where {$sql_search} and wr_1 = '1' order by wr_id desc limit 12";

    if(!$is_admin)
    {
        $sql = " select * from g5_write_biz_news where {$sql_search} and wr_1 = '1' and mb_id not in('test','test2','monq') order by wr_id desc limit 12";
    }

    $result = sql_query($sql);

    $sql = " select count(*) as cnt from g5_write_biz_news where {$sql_search} and wr_1 = '1' ";

    if(!$is_admin)
    {
        $sql = " select count(*) as cnt from g5_write_biz_news where {$sql_search} and wr_1 = '1' and mb_id not in('test','test2','monq') ";
    }

    $count = sql_fetch($sql);
    if($count['cnt'])
    {
        $total_count += $count['cnt'];
    }

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list_news[$i] = $row;
    }

    sql_free_result($result);

    $sql = " select * from g5_write_event_info where {$sql_search} and wr_1 = '1' order by wr_id desc limit 12";

    if(!$is_admin)
    {
        $sql = " select * from g5_write_event_info where {$sql_search} and wr_1 = '1' and mb_id not in('test','test2','monq') order by wr_id desc limit 12";
    }

    $result = sql_query($sql);

    $sql = " select count(*) as cnt from g5_write_event_info where {$sql_search} and wr_1 = '1' ";

    if(!$is_admin)
    {
        $sql = " select count(*) as cnt from g5_write_event_info where {$sql_search} and wr_1 = '1' and mb_id not in('test','test2','monq') ";
    }

    $count = sql_fetch($sql);
    if($count['cnt'])
    {
        $total_count += $count['cnt'];
    }

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list_event[$i] = $row;
    }

    sql_free_result($result);


    // 검색필드를 구분자로 나눈다. 여기서는 +
    $op1 = "";
    $op2 = "";
    $sfl = "wr_subject||wr_4";
    $field = explode('||', trim($sfl));

    $str = '(';
    for ($i=0; $i<count($s); $i++) {
        if (trim($s[$i]) == '') continue;

        $search_str = $s[$i];

        $str .= $op1;
        $str .= "(";

        $op2 = '';
        // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        for ($k=0; $k<count($field); $k++) {
            $str .= $op2;
            switch ($field[$k]) {
                case 'mb_id' :
                case 'wr_name' :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                case 'wr_subject' :
                case 'wr_4' :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER({$field[$k]}), LOWER('{$search_str}'))";
                    else
                        $str .= "INSTR({$field[$k]}, '{$search_str}')";
                    break;
                default :
                    $str .= "1=0"; // 항상 거짓
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " {$sop} ";
    }
    $str .= ")";

    $sql_search = $str;


    $sql = " select * from g5_write_calender where {$sql_search} and wr_3 != '' order by wr_id desc limit 12";

    $result = sql_query($sql);

    $sql = " select count(*) as cnt from g5_write_calender where {$sql_search} and wr_3 != '' ";

    $count = sql_fetch($sql);
    if($count['cnt'])
    {
        $total_count += $count['cnt'];
    }

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list_linc[$i] = $row;
    }

    sql_free_result($result);


}


add_stylesheet('<link rel="stylesheet" href="/css/result.css">', 0);
?>

<style>
.result--row-item-thumb{
    cursor: pointer;
}
</style>
<div class="public--wrap">
    <div class="result--contents">
        <div class="result--title">
            <div class="result--title-text01">통합검색</div>
            <div class="result--title-text02">
                <span>'<?=$stx?>'</span>에 대한 <span><?=number_format($total_count)?></span> 개의 검색 결과입니다.
            </div>
        </div>

        <div class="result--row">
            <div class="result--row-head">
                <div class="result--row-title">LINC3.0</div>

                <!-- 결과가 없을 시 더보기 버튼은 출력되지 않게 부탁드립니다.-->
                <a href="/ch-linc.php">더보기</a>
            </div>
            <div class="result--row-itemList">
                <!--
                    검색 결과 중 링크채널3.0 관련 아이템이 result--row-item에 출력되게 부탁드립니다. (최대 12개까지)
                    result--row-item-thumb클릭 시 해당 아이템의 상세페이지로 이동되게 부탁드립니다.
                    result--row-item-thumbImg의 background-image는 아이템 이미지가 출력되게 부탁드립니다.
                -->
                <?php for ($i=0; $i<count($list_linc); $i++) {?>
                <?php

                $row = $list_linc[$i];

                $vi_url = $row["wr_3"];
                $vi_url = explode("/", $vi_url);
                $vi_id = array_pop($vi_url);

                $img_url  = "https://img.youtube.com/vi/".$vi_id."/maxresdefault.jpg";
                $origDate = substr($row["wr_1"],0,10);
                $newDate = date("Y.m.d", strtotime($origDate));

                $thumb = get_list_thumbnail("calender", $row['wr_id'], 412, 232, false, true);

                if($thumb['src']) {
                    $img_url = $thumb['src'];
                }

                ?>
                <div class="result--row-item">
                    <div class="result--row-item-thumb">
                        <div class="result--row-item-thumbImg list--itemThumb-img" style="background-image: url(<?=$img_url?>);" data-vi_id="<?=$vi_id?>" data-wr_id="<?=$row['wr_id']?>"></div>
                    </div>
                    <div class="result--row-item-info">
                        <div class="result--row-item-info01"><?=$row["wr_4"]?></div>
                        <div class="result--row-item-info02">
                            <span><?=$row["ca_name"]?></span>
                        </div>
                    </div>
                </div>
                <?}?>
                <?if($i == 0){?>
                    <div class="result--nocontents">검색 결과가 없습니다.</div>
                <?}?>
            </div>

        </div>


        <div class="result--row">
            <div class="result--row-head">
                <div class="result--row-title">사업단 상세페이지</div>

                <!-- 결과가 없을 시 더보기 버튼은 출력되지 않게 부탁드립니다.-->
                <a href="/business.php">더보기</a>
            </div>
            <div class="result--row-itemList">
                <!--
                    검색 결과 중 링크채널3.0 관련 아이템이 result--row-item에 출력되게 부탁드립니다. (최대 12개까지)
                    result--row-item-thumb클릭 시 해당 아이템의 상세페이지로 이동되게 부탁드립니다.
                    result--row-item-thumbImg의 background-image는 아이템 이미지가 출력되게 부탁드립니다.
                -->
                <?php for ($i=0; $i<count($list_member); $i++) {?>
                <?php

                ?>
                <div class="result--row-item">
                    <div class="result--row-item-thumb">
                        <a href="/businessdetail.php?bi=<?=$list_member[$i]["mb_id"]?>">
                        <div class="result--row-item-thumbImg" style="background-image: url(<?=G5_DATA_URL.'/member_image/'.$list_member[$i]["mb_img"]?>);"></div>
                        </a>
                    </div>
                    <div class="result--row-item-info">
                        <div class="result--row-item-info01"><?=$list_member[$i]["mb_nick"]?></div>
                        <div class="result--row-item-info02">
                            <span><?=$list_member[$i]["mb_8"]?></span>
                            <span><?=$list_member[$i]["mb_2"]?></span>
                            <span><?=$list_member[$i]["mb_1"]?></span>
                        </div>
                    </div>
                </div>
                <?}?>
                <?if($i == 0){?>
                    <div class="result--nocontents">검색 결과가 없습니다.</div>
                <?}?>
            </div>

        </div>

        <div class="result--row">
            <div class="result--row-head">
                <div class="result--row-title">성과영상</div>
                <!-- 결과가 없을 시 더보기 버튼은 출력되지 않게 부탁드립니다.-->
                <a href="/performance.php?mb_1=&mb_2=&sort=&q=<?=$stx?>">더보기</a>
            </div>
            <div class="result--row-itemList">
                <!--
                    검색 결과 중 링크채널3.0 관련 아이템이 result--row-item에 출력되게 부탁드립니다. (최대 12개까지)
                    result--row-item-thumb클릭 시 해당 아이템의 상세페이지로 이동되게 부탁드립니다.
                    result--row-item-thumbImg의 background-image는 아이템 이미지가 출력되게 부탁드립니다.
                -->
                <?php for ($i=0; $i<count($list_video); $i++) {?>
                <div class="result--row-item">
                    <div class="result--row-item-thumb">
                        <a href="/performancedetail.php?vi_id=<?=$list_video[$i]["vi_id"]?>">
                        <div class="result--row-item-thumbImg" style="background-image: url(<?=$list_video[$i]["vi_thumb"]?>);"></div>
                        </a>
                    </div>
                    <div class="result--row-item-info">
                        <div class="result--row-item-info01"><?=$list_video[$i]["vi_title"]?></div>
                        <div class="result--row-item-info02">
                            <span><?=$list_video[$i]["mb_8"]?></span>
                            <span><?=$list_video[$i]["mb_2"]?></span>
                            <span><?=$list_video[$i]["mb_1"]?></span>
                        </div>
                    </div>
                </div>
                <?}?>
                <?if($i == 0){?>
                    <div class="result--nocontents">검색 결과가 없습니다.</div>
                <?}?>
            </div>
        </div>

        <div class="result--row">
            <div class="result--row-head">
                <div class="result--row-title">사업단 소식</div>
                <!-- 결과가 없을 시 더보기 버튼은 출력되지 않게 부탁드립니다.-->
                <a href="/news.php">더보기</a>
            </div>
            <div class="result--row-itemList">
                <!--
                    검색 결과 중 소식지, 행사정보 관련 아이템이 result--row-item에 출력되게 부탁드립니다. (최대 12개까지)
                    result--row-item-thumb클릭 시 해당 아이템의 상세페이지로 이동되게 부탁드립니다.
                    result--row-item-thumbImg의 background-image는 아이템 이미지가 출력되게 부탁드립니다.
                -->
                <?php for ($i=0; $i<count($list_news); $i++) {?>

                <?php
                    $thumb = get_list_thumbnail("biz_news", $list_news[$i]['wr_id'], 197, 245, false, true);

                    $content = strip_tags($list_news[$i]['wr_content']);
                    $content = get_text($content, 1);
                    $content = strip_tags($content);
                    $content = str_replace('&nbsp;', '', $content);
                    $content = cut_str($content, 300, "…");
                ?>

                <div class="result--row-item2">
                    <div class="result--row-item2-thumb">
                        <div class="result--row-item2-thumbImg" style="background-image: url(<?=$thumb["src"]?>);"></div>
                    </div>
                    <div class="result--row-item2-info">
                        <!--<div class="result--row-item2-info01"><span>{게시글타입}</span></div>-->
                        <div class="result--row-item2-info02"><?=$list_news[$i]['wr_subject']?></div>
                        <div class="result--row-item2-info03"><?=$content?></div>
                        <div class="result--row-item2-info04">
                            <span class="material-symbols-outlined">schedule</span><p><?=get_board_date($list_news[$i]['wr_datetime'])?></p>
                        </div>
                    </div>
                </div>
                <?}?>
                <?if($i == 0){?>
                    <div class="result--nocontents">검색 결과가 없습니다.</div>
                <?}?>
            </div>
        </div>

        <div class="result--row">
            <div class="result--row-head">
                <div class="result--row-title">사업단 행사</div>
                <!-- 결과가 없을 시 더보기 버튼은 출력되지 않게 부탁드립니다.-->
                <a href="/news02.php">더보기</a>
            </div>
            <div class="result--row-itemList">
                <!--
                    검색 결과 중 소식지, 행사정보 관련 아이템이 result--row-item에 출력되게 부탁드립니다. (최대 12개까지)
                    result--row-item-thumb클릭 시 해당 아이템의 상세페이지로 이동되게 부탁드립니다.
                    result--row-item-thumbImg의 background-image는 아이템 이미지가 출력되게 부탁드립니다.
                -->
                <?php for ($i=0; $i<count($list_event); $i++) {?>

                <?php
                    $thumb = get_list_thumbnail("event_info", $list_event[$i]['wr_id'], 197, 245, false, true);

                    $content = strip_tags($list_event[$i]['wr_content']);
                    $content = get_text($content, 1);
                    $content = strip_tags($content);
                    $content = str_replace('&nbsp;', '', $content);
                    $content = cut_str($content, 300, "…");
                ?>

                <div class="result--row-item2">
                    <div class="result--row-item2-thumb">
                        <div class="result--row-item2-thumbImg" style="background-image: url(<?=$thumb["src"]?>);"></div>
                    </div>
                    <div class="result--row-item2-info">
                        <!--<div class="result--row-item2-info01"><span>{게시글타입}</span></div>-->
                        <div class="result--row-item2-info02"><?=$list_event[$i]['wr_subject']?></div>
                        <div class="result--row-item2-info03"><?=$content?></div>
                        <div class="result--row-item2-info04">
                            <span class="material-symbols-outlined">schedule</span><p><?=get_board_date($list_event[$i]['wr_datetime'])?></p>
                        </div>
                    </div>
                </div>
                <?}?>
                <?if($i == 0){?>
                    <div class="result--nocontents">검색 결과가 없습니다.</div>
                <?}?>
            </div>
        </div>

    </div>
</div>

<script>

$(function() {
    $(document).on("click", ".list--itemThumb-img", function() {
        var vi_id = $(this).data("vi_id");
        var wr_id = $(this).data("wr_id");

        $.ajax({
            url: g5_bbs_url+"/ajax.view_cnt.php",
            type: "POST",
            data: {
                "wr_id" : wr_id
            },
            dataType: "json",
            async: true,
            cache: false,
            success: function(data) {

            }
        });

        $("#listVideoPopup_video").attr("src", "https://www.youtube.com/embed/"+vi_id+"?enablejsapi=1&version=3&playerapiid=ytplayer");

        $("#listVideoPopup").addClass('show');

    });

    $("#viewMore").click(function() {
        _page = _page + 1;
        list_load(false);
    });


    $(".list--sort-optionValue").click(function(){
        _sort = $(this).data("sort");
        _page = 1;
        list_load(true);
    });
});



</script>

<?php
include_once(G5_PATH.'/tail2.php');
?>

<script>
$(".list--videoPopup-bg").click(function(){
$("#listVideoPopup").removeClass('show')
$("iframe")[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
});
</script>

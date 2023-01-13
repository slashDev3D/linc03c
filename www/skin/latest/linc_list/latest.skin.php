<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 210;
$thumb_height = 150;
$list_count = (is_array($list) && $list) ? count($list) : 0;


?>

<?for ($i=0; $i<$list_count; $i++) {?>

<?php

$vi_url = $list[$i]["wr_3"];
$vi_url = explode("/", $vi_url);
$vi_id = array_pop($vi_url);

$img_url  = "https://img.youtube.com/vi/".$vi_id."/maxresdefault.jpg";
$origDate = substr($list[$i]["wr_1"],0,10);
$newDate = date("Y.m.d", strtotime($origDate));

$thumb = get_list_thumbnail("calender", $list[$i]['wr_id'], 412, 232, false, true);

if($thumb['src']) {
    $img_url = $thumb['src'];
}

$is_new = false;

if ($list[$i]['wr_1'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (168 * 3600)))
{
    $is_new = true;
}

$class_name = "";

if($list[$i]['ca_name'] == "티저영상"){
    $class_name = "";
}else if($list[$i]['ca_name'] == "똑똑 위클리"){
    $class_name = "mainContentSwiper--item-type01";
}else if($list[$i]['ca_name'] == "링크 어워드"){
    $class_name = "mainContentSwiper--item-type02";
}else if($list[$i]['ca_name'] == "링크 컴퍼니"){
    $class_name = "mainContentSwiper--item-type03";
}

?>

<div class="swiper-slide">
    <div class="mainContentSwiper--item-thumb" style="background-image: url(<?=$img_url?>);" data-vi_id="<? echo $vi_id ?>">
        <!-- 곧 전달드릴 기준에 따라 NEW 요소를 출력 부탁드립니다. -->
        <?if($is_new){?>
        <div class="mainContentSwiper--item-thumb-new">NEW</div>
        <?}?>
    </div>
    <div class="mainContentSwiper--item-typeBox">
        <!-- 타입에 따라 하위 요소 중 하나를 출력 부탁드립니다. -->
        <p class="mainContentSwiper--item-type <?=$class_name?>"><?=$list[$i]['ca_name']?></p>
        <!-- <p class="mainContentSwiper--item-type mainContentSwiper--item-type02">링크 어워드</p> -->
        <!-- <p class="mainContentSwiper--item-type mainContentSwiper--item-type03">링크 컴퍼니</p> -->
    </div>
    <div class="mainContentSwiper--item-title">
        <!-- <?=$list[$i]['wr_subject']?> -->
        <?=$list[$i]['wr_4']?>
    </div>
    <span class="mainContentSwiper--item-line"></span>
    <div class="mainContentSwiper--item-date">
        <p><?=$newDate?></p>
    </div>
</div>
<?}?>

<?if($i == 0){?>
    <div class="noContent">
        <img src="/img/beta_item_thumb.png" alt="">
    </div>
<?}?>

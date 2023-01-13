
<?php

include_once('./_common.php');

$page = $_POST['page'];
$total_count = $_POST['total_count'];
$ca_name = $_POST['ca_name'];
$sort = $_POST['sort'];

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$rows = 6;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if ($sort == "new" || $sort == "") $db_sort = "wr_1 desc";
if ($sort == "old") $db_sort = "wr_1 asc";
if ($sort == "hit") $db_sort = "wr_hit desc";

$sql  = " select * from g5_write_calender where ca_name = '".$ca_name."' and wr_id = wr_parent and wr_3 != '' order by $db_sort limit $from_record, $rows ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){

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

    $is_new = false;

    if ($row['wr_1'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (168 * 3600)))
    {
        $is_new = true;
    }


?>
<div class="list--item">
    <div class="list--itemThumb">
        <!-- 등록된지 7일 된 경우 list--itemThumb-iconNew가 출력되게 부탁드립니다. -->
        <?if($is_new){?>
          <div class="list--itemThumb-icon">
            <p class="list--itemThumb-iconNew">NEW</p>
        </div>
        <?}?>
        <!-- list--itemThumb-img의 background-image에 아이템 이미지를 넣어주세요 -->
        <div class="list--itemThumb-img" style="background-image: url(<?=$img_url?>);" data-vi_id="<?=$vi_id?>" data-wr_id="<?=$row['wr_id']?>"></div>
    </div>
    <div class="list--itemInfo">
        <div class="list--itemInfo-text">
            <!-- 영상 타이틀은 list--itemInfo-text02에 출력되게 부탁드립니다.-->
            <div class="list--itemInfo-text01"><p class="knock"><?=$row["ca_name"]?></p></div>
            <div class="list--itemInfo-text02 list--itemInfo-text0201"><?=$row["wr_subject"]?></div>
            <div class="list--itemInfo-text02"><?=$row["wr_4"]?></div>
        </div>
        <div class="list--itemInfo-time">
            <!-- 영상을 등록한 날짜를 하위의 p요소에 YYYY.MM.DD 형식으로 출력되게 부탁드립니다.-->
            <span class="material-symbols-outlined">schedule</span><p><?=$newDate?></p>
        </div>
    </div>
</div>
<?}?>

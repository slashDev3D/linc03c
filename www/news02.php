<?
$_REQUEST["bo_table"] = "event_info";
$bo_table = "event_info";

include_once('./_common.php');


$data_sub = "show";
$data_visit = "4";

include_once(G5_PATH.'/head2.php');



$where = array();

$where[] = " wr_1 = '1' ";

if(!$is_admin)
{
    $where[] = " mb_id != 'test' ";
    $where[] = " mb_id != 'test2' ";
    $where[] = " mb_id != 'monq' ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sort == "") $sql_order = " order by wr_id desc ";

$qstr = "ca_name=".$ca_name;

$sql_common = " from g5_write_event_info $sql_search ";

$sql = " select count(wr_id) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page_rows = 12;

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함


$list = array();
$i = 0;


$sql = " select * $sql_common ";
$sql .= " {$sql_order} ";

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);

$categories = explode("|", $board['bo_category_list']); // 구분자가 | 로 되어 있음


while ($row = sql_fetch_array($result))
{
    $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    $list[$i]['is_notice'] = false;
    $list[$i]['href'] = "/news02detail.php?wr_id=".$list[$i]["wr_id"];
    
    $i++;
    
}   



$write_pages = get_paging2(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page=", "", "board");

add_stylesheet('<link rel="stylesheet" href="/css/news.css">', 0);

?>

<div class="list-contents">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">행사 모아보기</a>
            </div>
        </div>
        <div class="board--title">
            <div class="board--title-text01">행사 모아보기</div>
            <div class="board--title-text02">👉&nbsp;채널 링크3.0 행사들을 만나보세요.</div>
        </div>
        <div class="board--otherLink">
            <a href="/news.php">소식지</a>
            <a class="on" href="/news02.php">행사안내</a>
        </div>
        <div class="board--list-wrap">
            <div class="board--list board--list2">

                <!-- 
                    board--listItem 의 요소에 아이템정보가 담기도록 부탁드립니다.
                    참고 : 최대 출력 수는 페이지 당 12개 입니다.
                -->
                <?php for ($i=0; $i<count($list); $i++) {?>

                <?php
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 414, 416, false, true);
                ?>

                <div class="board--listItem">
                    <!-- board--listItem-thumb 클릭 시 해당 이벤트 글로 이동 부탁드립니다.-->
                    <div class="board--listItem-thumb">
                        <a href="<?php echo $list[$i]['href'] ?>">
                        <div class="board--listItem-thumbImg" style="background-image:url(<?=$thumb["src"]?>)"></div>
                        </a>
                    </div>
                    <div class="board--listItem-text">
                        <!--<div class="board--listItem-text04">{#소식지태그}</div>-->
                        <div class="board--listItem-text03"><?=$list[$i]['subject']?></div>
                        <div class="board--listItem-text02">
                            <?=$list[$i]['wr_6']?> ~ <?=$list[$i]['wr_7']?>
                            <!-- <span class="material-symbols-outlined">schedule</span><p><?=get_board_date($list[$i]['wr_datetime'])?></p> -->
                        </div>
                    </div>
                </div>

                <?}?>
            </div>
        </div>
        <?=$write_pages?>
    </div>
</div>

<script src="./js/event.js"></script>

<?php
include_once(G5_PATH.'/tail2.php');
?>
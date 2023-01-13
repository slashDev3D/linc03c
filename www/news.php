<?


$_REQUEST["bo_table"] = "biz_news";
$bo_table = "biz_news";

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

if($ca_name)
{
    $where[] = " ca_name = '".$ca_name."' ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sort == "") $sql_order = " order by wr_id desc ";

$qstr = "ca_name=".$ca_name;

$sql_common = " from g5_write_biz_news $sql_search ";

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
    $list[$i]['href'] = "/newsdetail.php?wr_id=".$list[$i]["wr_id"];
    
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
                <a href="">소식 모아보기</a>
            </div>
        </div>
        <div class="board--title">
            <div class="board--title-text01">소식 모아보기</div>
            <div class="board--title-text02">👉&nbsp;채널 링크3.0 소식들을 만나보세요.</div>
        </div>
        <div class="board--otherLink">
            <a class="on" href="">소식지</a>
            <a href="/news02.php">행사안내</a>
        </div>
        <div class="board--list-wrap">
            <div class="board--sort">
                <!-- 
                    각 옵션은 소식지의 옵션값들이 나타납니다(취업, 창업 ...)
                    (첫 번 째 옵션은 전체를 출력해주는 옵션입니다.)
                    각 버튼 클릭 시 해당 옵션값으로 재정렬되도록 부탁드립니다.
                    -->
                <a class="board--sort-option <?if($ca_name=="") echo "on";?>" href="/news.php">전체</a>
                <?for ($i=0; $i<count($categories); $i++) {?>
                    <?php
                    $category = trim($categories[$i]);
                    ?>
                    <a class="board--sort-option <?if($ca_name==$category) echo "on";?>" href="/news.php?ca_name=<?=$category?>"><?=$category?></a>
                <?}?>
            </div>
            <div class="board--list">

                <!-- 
                    board--listItem2 의 요소에 아이템정보가 담기도록 부탁드립니다.
                    참고 : 최대 출력 수는 페이지 당 12개 입니다.
                -->
                <?php for ($i=0; $i<count($list); $i++) {?>

                <?php
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 306, 182, false, true);
                ?>

                <div class="board--listItem2">
                    <!-- board--listItem-thumb 클릭 시 해당 이벤트 글로 이동 부탁드립니다.-->
                    <div class="board--listItem-thumb">
                        <a href="<?php echo $list[$i]['href'] ?>">
                        <div class="board--listItem-thumbImg2" style="background-image:url(<?=$thumb["src"]?>)"></div>
                        </a>
                    </div>
                    <div class="board--listItem-text">
                        <!--<div class="board--listItem-text04">{#소식지태그}</div>-->
                        <div class="board--listItem-text03"><?=$list[$i]['subject']?></div>
                        <div class="board--listItem-text02">
                            <span class="material-symbols-outlined">schedule</span><p><?=get_board_date($list[$i]['wr_datetime'])?></p>
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
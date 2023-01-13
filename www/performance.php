<?
include_once('./_common.php');


$data_sub = "show";
$data_visit = "2";

include_once(G5_PATH.'/head2.php');

$q = isset($_GET['q']) ? get_search_string($_GET['q']) : '';

$where = array();

$where[] = " a.vi_open = '1' ";

if(!$is_admin)
{
    $where[] = " b.mb_id != 'test' ";
    $where[] = " b.mb_id != 'test2' ";
    $where[] = " b.mb_id != 'monq' ";
}

$mb_1_name = "유형 전체";
$mb_2_name = "권역 전체";

if($mb_1)
{
    $where[] = " b.mb_1 = '".$_r_mb_1[$mb_1]."' ";
    $mb_1_name = $_r_mb_1[$mb_1];
}

if($mb_2)
{
    $where[] = " b.mb_2 = '".$_r_mb_2[$mb_2]."' ";
    $mb_2_name = $_r_mb_2[$mb_2];
    /*if($mb_2 == 2)
    {
        $mb_2_name = "대경/강원권";
    }else if($mb_2 == 5)
    {
        $mb_2_name = "호남/제주권";
    }*/
}

if ($q != "") {
    $where[] = " (b.mb_nick like '%$q%' or a.vi_title like '%$q%') ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sort == "") $sql_order = " order by a.vi_reg_date desc ";
if ($sort == "old") $sql_order = " order by a.vi_reg_date asc ";
if ($sort == "hit") $sql_order = " order by a.vi_hit desc ";


$qstr = "mb_1=".$mb_1."&amp;mb_2=".$mb_2."&amp;sort=".$sort."&amp;q=".$q;

$qstr1 = "mb_2=".$mb_2."&amp;sort=".$sort."&amp;q=".$q;
$qstr2 = "mb_1=".$mb_1."&amp;sort=".$sort."&amp;q=".$q;
$qstr3 = "mb_1=".$mb_1."&amp;mb_2=".$mb_2."&amp;q=".$q;

$sql_common = " from g5_video a left outer join g5_member b on a.mb_id = b.mb_id $sql_search ";


$sql = " select count(a.vi_id) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$page_rows = 12;

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함


$list = array();
$i = 0;


$sql = " select a.*, b.* $sql_common ";
$sql .= " {$sql_order} limit {$from_record}, {$page_rows}";

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);

$open_cnt = 0;
$not_open_cnt = 0;

while ($row = sql_fetch_array($result))
{

    $list[$i] = $row;
    $i++;
    
    if($row["vi_open"] == "1")
    {
        $open_cnt++;
    }
    else{
        $not_open_cnt++;
    }
}   

for ($i=0; $i<count($list); $i++) {

    $list[$i]['href'] = "/bbs/video_view.php?vi_id=".$list[$i]["vi_id"];
}

$write_pages = get_paging2(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page=", "", "perf");

add_stylesheet('<link rel="stylesheet" href="/css/performance.css">', 0);

?>

<style>

</style>

<div class="list-contents">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">성과영상</a>
            </div>
        </div>
        <div class="perf--title">
            <div class="perf--title-text01">성과영상</div>
            <div class="perf--title-text02">👉&nbsp;링크3.0 사업의 다양한 성과영상을 지금 만나보세요.</div>
        </div>
        <div class="perf--sort">
            <div class="perf--sort-01">
                <div class="perf--sort-02">
                    <div class="perf--sort-selectBox">
                        <div class="perf--sort-selectBox-view">
                            <p><?=$mb_1_name?></p>
                            <span class="material-symbols-outlined">expand_more</span>
                        </div>
                        <div class="perf--sort-selectBox-option">
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr1?>">유형 전체</a>
                            <?foreach ($_r_mb_1 as $key => $value) {?>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr1?>&amp;mb_1=<?=$key?>"><?=$value?></a>
                            <?}?>
                        </div>
                    </div>
                    <div class="perf--sort-selectBox">
                        <div class="perf--sort-selectBox-view">
                            <p><?=$mb_2_name?></p>
                            <span class="material-symbols-outlined">expand_more</span>
                        </div>
                        <div class="perf--sort-selectBox-option">
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>">권역 전체</a>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>&amp;mb_2=1">수도권</a>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>&amp;mb_2=2">대경권</a>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>&amp;mb_2=3">동남권</a>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>&amp;mb_2=4">충청/강원권</a>
                            <a class="perf--sort-selectBox-optionItem" href="/performance.php?<?=$qstr2?>&amp;mb_2=5">호남/제주권</a>
                        </div>
                    </div>
                </div>
                <div class="perf--sort-02">
                    <div class="perf--sort-checkBox">
                        <div class="perf--sort-option">
                            <!--
                                div.perf--sort-optionValue요소기 sorting 옵션값입니다.
                                옵션값은 중복되지 않습니다.
                                최초옵션값은 최신등록 순(첫번째 옵션값)입니다.
                                버튼 클릭 시 페이지 이동 없이 해당 페이지 내에서 아이템 정렬을 부탁드립니다.
                            -->
                            <div class="perf--sort-optionValue <?if($sort == "") echo 'checked'?>">
                                <div class="perf--sort-optionState">
                                    <span class="perf--sort-optionValue-off"></span>
                                    <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                                </div>
                                <a class="perf--sort-optionName" href="/performance.php?<?=$qstr3?>">최신등록 순</a>
                            </div>
                            <div class="perf--sort-optionValue <?if($sort == "old") echo 'checked'?>">
                                <div class="perf--sort-optionState">
                                    <span class="perf--sort-optionValue-off"></span>
                                    <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                                </div>
                                <a class="perf--sort-optionName" href="/performance.php?<?=$qstr3?>&amp;sort=old">오래된 순</a>
                            </div>
                            <div class="perf--sort-optionValue <?if($sort == "hit") echo 'checked'?>">
                                <div class="perf--sort-optionState">
                                    <span class="perf--sort-optionValue-off"></span>
                                    <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                                </div>
                                <a class="perf--sort-optionName" href="/performance.php?<?=$qstr3?>&amp;sort=hit">조회 순</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="perf--sort-01">
                <form>
                <input type="hidden" name="mb_1" value="<?php echo $mb_1; ?>">
                <input type="hidden" name="mb_2" value="<?php echo $mb_2; ?>">
                <input type="hidden" name="sort" value="<?php echo $sort; ?>">
                <div class="perf--sort-searchBox">
                        <button type="submit"><img src="/img/icon_search_blue.png" alt=""></button>
                        <input type="text" placeholder="검색어를 입력해주세요." name="q" value="<?php echo $q; ?>">
                    </div>
                </form>
            </div>
        </div>
        <div class="perf--list">

            <!-- 
                perf--listItem 의 요소에 아이템정보가 담기도록 부탁드립니다.
                참고 : 최대 출력 수는 페이지 당 12개 입니다.
            -->
            <?php for ($i=0; $i<count($list); $i++) {?>
            <div class="perf--listItem">
                <!-- board--listItem-thumb 클릭 시 해당 이벤트 글로 이동 부탁드립니다.-->
                <a href="/performancedetail.php?vi_id=<?=$list[$i]["vi_id"]?>">
                <div class="perf--listItem-thumb">
                    <div class="perf--listItem-thumbImg" style="background-image:url(<?=$list[$i]["vi_thumb"]?>)"></div>
                </div>
                </a>
                <div class="perf--listItem-text">
                    <div class="perf--listItem-text01">
                        <span><?=$list[$i]['mb_nick']?></span>
                        <span><?=$list[$i]['mb_2']?></span>
                        <span><?=$list[$i]['mb_1']?></span>
                    </div>
                    <div class="perf--listItem-text02"><?=$list[$i]['vi_title']?></div>
                    <div class="perf--listItem-text03">
                        <span class="material-symbols-outlined">schedule</span><p><?=get_board_date($list[$i]['vi_reg_date'])?></p>
                    </div>
                </div>
            </div>
            <?}?>
        </div>
        <?php echo $write_pages; ?>
        <?if(1==0){?>
        <div class="perf--index">
            <div class="perf--index-wrap">
                <!-- 
                    더블 애로우는 각각 맨 끝, 맨 시작으로 페이지 이동 부탁드립니다.
                    최초 이 페이지 방문 시,  keyboard_double_arrow_left와 keyboard_arrow_left는 출력되지 않습니다.
                    마지막 인덱스를 볼 시,  keyboard_double_arrow_right와 keyboard_arrow_right는 출력되지 않습니다.
                    아래의 숫자 인덱스는 예시이며 방문중인 인덱스 소속의 board--index-button에는 "on"클래스가 부여되어야 합니다.
                -->
                <div class="perf--index-button"><span class="material-symbols-outlined">keyboard_double_arrow_left</span></div>
                <div class="perf--index-button"><span class="material-symbols-outlined">keyboard_arrow_left</span></div>
                <div class="perf--index-button on"><span>1</span></div>
                <div class="perf--index-button"><span>2</span></div>
                <div class="perf--index-button"><span>3</span></div>
                <div class="perf--index-button"><span>4</span></div>
                <div class="perf--index-button"><span>5</span></div>
                <div class="perf--index-button"><span class="material-symbols-outlined">keyboard_arrow_right</span></div>
                <div class="perf--index-button"><span class="material-symbols-outlined">keyboard_double_arrow_right</span></div>
            </div>
        </div>
        <?}?>
    </div>
</div>
<script src="./js/performance.js"></script>
<?php
include_once(G5_PATH.'/tail2.php');
?>
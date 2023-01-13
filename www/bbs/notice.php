<?php

$_REQUEST["bo_table"] = "notice";
$bo_table = "notice";

include_once('./_common.php');

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';

// 분류 사용 여부
$is_category = false;
$category_option = '';

//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;
$sql_search = "";

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;

$sql_order = " order by wr_id desc ";

$sql_where = "";

$sql = " select * from {$write_table} where wr_is_comment = 0 {$sql_where} ";
$sql .= " {$sql_order} ";

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);
$total_count = sql_num_rows($result);

$k = 0;



while ($row = sql_fetch_array($result))
{

    $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    $list[$i]['is_notice'] = false;
    $list[$i]['href'] = "/bbs/notice_view.php?wr_id=".$list[$i]["wr_id"];

    $i++;
    $k++;

}


g5_latest_cache_data($board['bo_table'], $list);


include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_notice = true;



?>
<style>
.member--container{
    margin-top:0;
}

.member03--sort-selectBox-item{
    display:block;
}
</style>

<div class="member--container public--wrap member03">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title">
              <div class="member--title-text">
                <div class="member--title-text01">📢&nbsp;관리 안내 공지</div>
                <div class="member--title-text02">사업단 관리 관련 안내 공지를 확인해보세요.</div>
              </div>
            </div>
            <form action="">
                <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title member03--figureItem-title">
                            <p>공지 모아보기</p>
                            <div class="member03--figureItem-props">
                                <!--
                                    하단의 {Num}에는 각각 아이템의 갯수를 조건에 맞게 출력 부탁드립니다.
                                    총 게시물 : 아이템 총 total count
                                    노출 : 노출상태의 아이템 total count
                                    비노출 : 비노출상태의 아이템 total count
                                -->
                                <div class="member03--figureItem-totalItems">📄 총 게시물 :<span><?php echo number_format($total_count) ?></span></div>
                            </div>
                        </div>
                        <div class="member06--figureItem-boardList">

                            <!-- 해당 아이템 클릭 시 해당 게시글로 이동합니다 -->
                            <?php for ($i=0; $i<count($list); $i++) {?>
                            <?php
                                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 196, 198, false, true);
                                $content = strip_tags($list[$i]['wr_content']);
                                $content = get_text($content, 1);
                                $content = strip_tags($content);
                                $content = str_replace('&nbsp;', '', $content);
                                $content = cut_str($content, 300, "…");
                            ?>

                            <div class="member06--figureItem-boardItem">
                                <div class="member06--figureItem-boardItem-thumb">
                                    <div class="member06--figureItem-boardItem-thumbImg" style="background-image: url(<?=$thumb["src"]?>);"></div>
                                </div>
                                <div class="member06--figureItem-boardItem-text">
                                    <div class="member06--figureItem-boardItem-text-row">
                                        <a href="<?php echo $list[$i]['href'] ?>">
                                        <div class="member06--figureItem-boardItem-text01"><?=$list[$i]['subject']?></div>
                                        <div class="member06--figureItem-boardItem-text02"><?=$content?></div>
                                        </a>
                                    </div>
                                    <div class="member06--figureItem-boardItem-text03">
                                        <span class="material-symbols-outlined">schedule</span>
                                        <p><?=get_board_date($list[$i]['wr_datetime'])?></p>
                                    </div>
                                </div>

                            </div>
                            <?}?>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/js/member03.js"></script>
<?
include_once(G5_PATH.'/tail2.php');

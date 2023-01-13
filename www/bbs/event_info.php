<?php

$_REQUEST["bo_table"] = "event_info";
$bo_table = "event_info";

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

if($wr_1 != "")
{
    $sql_where = " and wr_1 = '".$wr_1."' ";
}

$sql = " select * from {$write_table} where wr_is_comment = 0 and mb_id = '".$member["mb_id"]."' {$sql_where} ";
$sql .= " {$sql_order} ";

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);
$total_count = sql_num_rows($result);

$k = 0;
$open_cnt = 0;
$not_open_cnt = 0;

while ($row = sql_fetch_array($result))
{
    
    $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    $list[$i]['is_notice'] = false;
    $list[$i]['href'] = "/bbs/event_info_view.php?wr_id=".$list[$i]["wr_id"];
    
    $i++;
    $k++;

    if($row["wr_1"] == "1")
    {
        $open_cnt++;
    }
    else{
        $not_open_cnt++;
    }
}   


g5_latest_cache_data($board['bo_table'], $list);


include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_event = true;

$open_text = "전체 행사";

if($wr_1 == "1")
{
    $open_text = "노출";
}else if($wr_1 == "0")
{
    $open_text = "비노출";
}

?>
<style>
.member--container{
    margin-top:0;
}

.member04--sort-selectBox-item{
    display:block;
}

</style>

<div class="member--container public--wrap member04">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title member--title-member04">
                <div class="member--title-text">
                    <div class="member--title-text01">🥳&nbsp;행사안내</div>
                    <div class="member--title-text02">본사업단의 행사를 알려주세요.</div>
                </div>
            </div>
            <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title member04--figureItem-title">
                            <p>행사 모아보기</p>
                        </div>
                        <div class="member--figureItem-contents member04--figureItem-contents">
                            <div class="member04--sort">
                                <div class="member04--sort-selectBox">
                                    <div class="member04--sort-selectBox-val"><p><?=$open_text?></p><span class="material-symbols-outlined">expand_more</span></div>
                                    <div class="member04--sort-selectBox-itemList">
                                        <!-- 아래의 아이템 중 하나를 선택 시, .member04--itemList를 조건에 맞게 재정렬되도록 부탁드립니다. -->
                                        <a href="/bbs/event_info.php" class="member04--sort-selectBox-item">전체 행사</a>
                                        <a href="/bbs/event_info.php?wr_1=1" class="member04--sort-selectBox-item">노출</a>
                                        <a href="/bbs/event_info.php?wr_1=0" class="member04--sort-selectBox-item">비노출</a>
                                    </div>
                                </div>
                                <div class="member04--sort-menu">
                                    <!-- 
                                        member04--item마다 member04--item-thumbCheck 요소가 있습니다.
                                        해당 요소에는 checked클래스가 토글됩니다.
                                        member04--sort-menuItem 클릭 시 confirm창이 뜨고 확인버튼을 누를 경우
                                        checked된 아이템들을 일괄 처리 부탁드립니다.
                                        member04--item-thumbCheck 몇 개 체크 후 member04--sort-menuItem 클릭하면
                                        confirm "해당 아이템들을 (삭제/숨기기 처리/노출 처리) 하시겠습니까?", 확인 버튼 클릭 시 처리(confirm 멘트는 예시입니다. 별도로 지정해주셔도 좋습니다.).
                                        -->
                                    <div class="member04--sort-menuItem" id="event_list_del_btn">삭제</div>
                                    <div class="member04--sort-menuItem event_list_open_btn" data-wr_1="0">숨기기</div>
                                    <div class="member04--sort-menuItem event_list_open_btn" data-wr_1="1">노출</div>
                                </div>
                            </div>
                            <div class="member04--itemList">
                                <?php for ($i=0; $i<count($list); $i++) {?>
                                <?php
                                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 282, 167, false, true);
                                ?>
                                <div class="member04--item">
                                    <!-- member04--item-thumbImg 클릭 시 마이페이지전용 해당아이템 상세(member04detail.html)로 이동합니다. -->
                                    <a href="<?php echo $list[$i]['href'] ?>">
                                    <div class="member04--item-thumb">
                                        <div class="member04--item-thumbImg" style="background-image: url(<?=$thumb["src"]?>);"></div>
                                        <div class="member04--item-thumb-isShow">
                                            <!-- 노출상태인 경우 isShow--true를 출력, 숨기기(비노출)상태의 경우 isShow--false를 출력 부탁드립니다. -->
                                            <?if($list[$i]["wr_1"] == "1"){?>
                                            <p class="isShow--true">노출</p>
                                            <?}else{?>
                                            <p class="isShow--false">비노출</p>
                                            <?}?>
                                        </div>
                                        <div class="member04--item-thumbCheck" data-wr_id="<?=$list[$i]["wr_id"]?>"></div>
                                    </div>
                                    </a>
                                    <div class="member04--item-text">
                                        <!--<div class="member04--item-text01">{태그값}</div>-->
                                        <div class="member04--item-text02"><?=$list[$i]['subject']?></div>
                                        <div class="member04--item-text03">
                                            <span class="material-symbols-outlined">schedule</span>
                                            <p><?=get_board_date($list[$i]['wr_datetime'])?></p>
                                            &nbsp;&nbsp;&nbsp;
                                            <span class="material-symbols-outlined">location_on</span>
                                            <p><?=$list[$i]['wr_2']?></p>
                                        </div>
                                    </div>
                                </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="member--submit member04--submit">
                <!-- 해당 버튼 클릭 시 사업단 소식 게시글 작성 페이지로 넘어갑니다. -->
                <a href="/bbs/event_info_write.php" class="member--goToWrite"><p>작성하기</p></a>
            </div>
        </div>
    </div>
</div>
<script src="/js/member04.js"></script>
<?
include_once(G5_PATH.'/tail2.php');